<?php

namespace app\controller;

use app\dto\CommentDto;
use app\dto\CreateCommentDto;
use app\dto\PageInfoDto;
use app\dto\PostDto;
use app\dto\PostFullDto;
use app\dto\ResponseDto;
use app\dto\TagDto;
use app\dto\UpdateCommentDto;
use app\model\Comment;
use app\model\Like;
use app\model\Post;
use app\model\Tag;
use app\repository\AdministratorRepository;
use app\repository\CommentRepository;
use app\repository\LikeRepository;
use app\repository\PostRepository;
use app\repository\SubscribeRepository;
use app\repository\TagRepository;
use app\service\AccessService;
use app\service\TokenService;
use core\http\Request;
use core\http\Response;
use core\Route;
use core\view\JsonView;

class PostController
{
    private PostRepository $postRepository;
    private TagRepository $tagRepository;
    private LikeRepository $likeRepository;
    private CommentRepository $commentRepository;
    private TokenService $tokenService;
    private AccessService $accessService;
    private JsonView $view;
    private int $pageCount;

    /**
     * @param PostRepository $postRepository
     * @param TagRepository $tagRepository
     * @param LikeRepository $likeRepository
     * @param CommentRepository $commentRepository
     * @param TokenService $tokenService
     * @param AccessService $accessService
     * @param JsonView $view
     * @param int $pageCount
     */
    public function __construct(PostRepository $postRepository, TagRepository $tagRepository, LikeRepository $likeRepository, CommentRepository $commentRepository, TokenService $tokenService, AccessService $accessService, JsonView $view, int $pageCount)
    {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
        $this->likeRepository = $likeRepository;
        $this->commentRepository = $commentRepository;
        $this->tokenService = $tokenService;
        $this->accessService = $accessService;
        $this->view = $view;
        $this->pageCount = $pageCount;
    }


    public function listOfPosts(Route $route, Request $request) : Response
    {
        $userId = $this->tokenService->getCurrentUserId();
        $pageSize = $request->getQueryParam('size', $this->pageCount);
        $currentPage = $request->getQueryParam('page', 1);
        $myCommunityIds = ($userId !== null) ? $this->accessService->getMyCommunityIds($userId) : null;
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
                $myCommunityIds,
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
            $myCommunityIds,
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
        $children = array_filter($children);
        $children = array_values($children);
        $children = array_map(fn($comment) => $this->hydrateCommentDto($comment)->toArray(),$children);
        return $this->view->render($children);
    }

    public function createComment(Route $route, Request $request) : Response
    {
        $postId = $route->getParam(0);
        $userId = $this->tokenService->getCurrentUserId();
        $createDto = CreateCommentDto::fromArray($request->getBodyJson());
        $dtoArray = $createDto->toArray();
        $dtoArray['postId'] = $postId;
        $dtoArray['authorId'] = $userId;
        $dtoArray['deleteTime'] = null;
        $dtoArray['modifiedTime'] = null;
        $comment = Comment::fromArray($dtoArray);
        $commentId = $this->commentRepository->createComment($comment);
        return $this->view->render(['id' => $commentId]);
    }

    public function updateComment(Route $route, Request $request) : Response
    {
        $editDto = UpdateCommentDto::fromArray($request->getBodyJson());
        $comment = $this->commentRepository->getComment($route->getParam(0));
        $comment = $comment->outsideUpdateFromDto($editDto);
        $commentId = $this->commentRepository->updateComment($comment);
        return $this->view->render(['id' => $commentId]);
    }

    public function deleteComment(Route $route, Request $request) : Response
    {
        $comment = $this->commentRepository->getComment($route->getParam(0));
        $commentId = $this->commentRepository->deleteComment($comment);
        return $this->view->render(['id' => $commentId]);
    }


    public function setLike(Route $route, Request $request) : Response
    {
        $postId = $route->getParam(0);
        $userId = $this->tokenService->getCurrentUserId();
        $likeId = $this->likeRepository->addLike(new Like(null, $userId, $postId, null));
        return $this->view->render([$likeId]);
    }

    public function removeLike(Route $route, Request $request) : Response
    {
        $postId = $route->getParam(0);
        $userId = $this->tokenService->getCurrentUserId();
        $this->likeRepository->removeLike($this->likeRepository->getLike($userId, $postId));
        $resp = new ResponseDto(null, 'like was removed');
        return $this->view->render($resp->toArray());
    }

    public function listOfTags(Route $route, Request $request) : Response
    {
        $listCommunities = array_map(
            fn($tag) => $this->hydrateTagDto($tag)->toArray(),
            $this->tagRepository->getList()
        );
        return $this->view->render($listCommunities);
    }


    private function generateChildren(string $commentId, array & $allChildren) : void
    {
        $children = $this->commentRepository->getChildren($commentId);
        foreach ($children as $child) {
            $allChildren[] = $child;
            $this->generateChildren($child->getId(), $allChildren);
        }
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
        $comments = array_filter($comments);
        $comments = array_values($comments);
        $dto->setComments(array_map(fn($comment) => $comment->toArray(),$comments));
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

    private function hydrateCommentDto(Comment $model) : ?CommentDto
    {
        $commentArray = $model->toArray();
        unset($commentArray['postId']);
        unset($commentArray['parentId']);
        $commentArray['subComments'] = $this->commentRepository->getSubCommentsCount($commentArray['id']);
        if($commentArray['deleteTime'] !== null) {
            if ($commentArray['subComments'] === 0) {
                return null;
            }
            $commentArray['authorId'] = '';
            $commentArray['author'] = '[Комментарий удален]';
            $commentArray['content'] = '[Комментарий удален]';
        }
        return CommentDto::fromArray($commentArray);
    }

    private function hydrateTagDto(Tag $model) : TagDto
    {
        return TagDto::fromArray($model->toArray());
    }
}