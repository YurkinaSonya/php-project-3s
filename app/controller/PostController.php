<?php

namespace app\controller;

use app\dto\CommentDto;
use app\dto\PageInfoDto;
use app\dto\PostDto;
use app\dto\PostFullDto;
use app\dto\TagDto;
use app\model\Comment;
use app\model\Post;
use app\model\Tag;
use app\repository\AdministratorRepository;
use app\repository\CommentRepository;
use app\repository\LikeRepository;
use app\repository\PostRepository;
use app\repository\SubscribeRepository;
use app\repository\TagRepository;
use app\service\TokenService;
use core\http\Request;
use core\http\Response;
use core\Route;
use core\view\JsonView;

class PostController
{
    private PostRepository $postRepository;
    private TagRepository $tagRepository;
    private SubscribeRepository $subscribeRepository;
    private AdministratorRepository $administratorRepository;
    private LikeRepository $likeRepository;
    private CommentRepository $commentRepository;
    private TokenService $tokenService;
    private JsonView $view;
    private int $pageCount;

    /**
     * @param PostRepository $postRepository
     * @param TagRepository $tagRepository
     * @param SubscribeRepository $subscribeRepository
     * @param AdministratorRepository $administratorRepository
     * @param LikeRepository $likeRepository
     * @param CommentRepository $commentRepository
     * @param TokenService $tokenService
     * @param JsonView $view
     * @param int $pageCount
     */
    public function __construct(PostRepository $postRepository, TagRepository $tagRepository, SubscribeRepository $subscribeRepository, AdministratorRepository $administratorRepository, LikeRepository $likeRepository, CommentRepository $commentRepository, TokenService $tokenService, JsonView $view, int $pageCount)
    {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
        $this->subscribeRepository = $subscribeRepository;
        $this->administratorRepository = $administratorRepository;
        $this->likeRepository = $likeRepository;
        $this->commentRepository = $commentRepository;
        $this->tokenService = $tokenService;
        $this->view = $view;
        $this->pageCount = $pageCount;
    }


    public function listOfPosts(Route $route, Request $request) : Response
    {
        $userId = $this->tokenService->getCurrentUserId();
        $pageSize = $request->getQueryParam('size', $this->pageCount);
        $currentPage = $request->getQueryParam('page', 1);
        $posts = array_map(
            fn($post) => $this->hydratePostDto($post, $userId)->toArray(),
            $this->postRepository->getList(
                $pageSize * ($currentPage - 1),
                $pageSize,
                $request->getQueryParam('tags'),
                $request->getQueryParam('author'),
                $request->getQueryParam('min'),
                $request->getQueryParam('max'),
                $request->getQueryParam('onlyMyCommunities') === 'true',
                $userId,
                ($userId !== null) ? $this->getMyCommunityIds($userId) : null,
                $request->getQueryParam('sorting'),
                $route->getParam(0)
            )
        );
        $total = $this->postRepository->getTotalCount(
            $request->getQueryParam('tags'),
            $request->getQueryParam('author'),
            $request->getQueryParam('min'),
            $request->getQueryParam('max'),
            $request->getQueryParam('onlyMyCommunities') === 'true',
            $userId,
            ($userId !== null) ? $this->getMyCommunityIds($userId) : null,
            $route->getParam(0)
        );
        $pageInfo = new PageInfoDto($pageSize, ceil($total/$pageSize), $currentPage);
        return $this->view->render(["posts" => $posts, "pagination" => $pageInfo->toArray()]);
    }

    public function concretePost(Route $route, Request $request) : Response
    {
        $postId = $route->getParam(0);
        $userId = $this->tokenService->getCurrentUserId();
        $post = $this->postRepository->getPost($postId);
        $dto = $this->hydratePostFullDto($post, $userId);
        return $this->view->render($dto->toArray());
    }

    public function getNestedComments(Route $route, Request $request) : Response
    {
        $children = [];
        $this->generateChildren($route->getParam(0), $children);
        $children = array_map(fn($comment) => $this->hydrateCommentDto($comment)->toArray(),$children);
        return $this->view->render($children);
    }

    private function generateChildren(string $commentId, array & $allChildren) : void
    {
        $children = $this->commentRepository->getChildren($commentId);
        foreach ($children as $child) {
            $allChildren[] = $child;
            $this->generateChildren($child->getId(), $allChildren);
        }
    }


    public function listOfTags(Route $route, Request $request) : Response
    {
        $listCommunities = array_map(
            fn($tag) => $this->hydrateTagDto($tag)->toArray(),
            $this->tagRepository->getList()
        );
        return $this->view->render($listCommunities);
    }

    private function hydratePostFullDto(?Post $post, ?string $userId) : ?PostFullDto
    {
        if ($post === null) {
            return null;
        }
        $dto = PostFullDto::fromArray($this->getArrayForPostDto($post,$userId));
        $comments = array_map(
            fn($comment) => $this->hydrateCommentDto($comment),
            $this->commentRepository->getCommentsOfPost($post->getId())
        );
        $dto->setComments(array_map(fn($comment) => $comment->toArray(),$comments));
        //var_export($dto); die;
        return $dto;
    }

    private function hydratePostDto(?Post $post, ?string $userId) : ?PostDto
    {
        if ($post === null) {
            return null;
        }
        return PostDto::fromArray($this->getArrayForPostDto($post,$userId));
    }

    private function getArrayForPostDto(?Post $post, ?string $userId) : ?array
    {
        $postArray = $post->toArray();
        $postArray['hasLike'] = $userId !== null && $this->likeRepository->checkHasLike($userId ,$postArray['id']);
        $tags = array_map(
            fn($tag) => $this->hydrateTagDto($tag),
            $this->tagRepository->getPostTags($post->getId())
        );
        $postArray['tags'] = array_map(fn($tag) => $tag->toArray(),$tags);
        return $postArray;
    }

    private function hydrateCommentDto(Comment $model) : CommentDto
    {
        $commentArray = $model->toArray();
        unset($commentArray['postId']);
        unset($commentArray['parentId']);
        $commentArray['subComments'] = $this->commentRepository->getSubComments($commentArray['id']);
        return CommentDto::fromArray($commentArray);
    }

    private function hydrateTagDto(Tag $model) : TagDto
    {
        return TagDto::fromArray($model->toArray());
    }

    protected function getMyCommunityIds(string $userId) : array
    {
        $subscribes = $this->subscribeRepository->getSubscribesOfUser($userId);
        $admins = $this->administratorRepository->getAdminRolesOfUser($userId);
        return array_merge($subscribes ?: [], $admins ?: []);
    }
}