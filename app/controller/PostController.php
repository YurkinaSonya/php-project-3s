<?php

namespace app\controller;

use app\dto\PageInfoDto;
use app\dto\PostDto;
use app\dto\TagDto;
use app\model\Post;
use app\model\Tag;
use app\repository\AdministratorRepository;
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
    private TokenService $tokenService;
    private JsonView $view;
    private int $pageCount;

    /**
     * @param PostRepository $postRepository
     * @param TagRepository $tagRepository
     * @param SubscribeRepository $subscribeRepository
     * @param AdministratorRepository $administratorRepository
     * @param LikeRepository $likeRepository
     * @param TokenService $tokenService
     * @param JsonView $view
     * @param int $pageCount
     */
    public function __construct(PostRepository $postRepository, TagRepository $tagRepository, SubscribeRepository $subscribeRepository, AdministratorRepository $administratorRepository, LikeRepository $likeRepository, TokenService $tokenService, JsonView $view, int $pageCount)
    {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
        $this->subscribeRepository = $subscribeRepository;
        $this->administratorRepository = $administratorRepository;
        $this->likeRepository = $likeRepository;
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
                $request->getQueryParam('sorting')
            )
        );
        $total = $this->postRepository->getTotalCount(
            $request->getQueryParam('tags'),
            $request->getQueryParam('author'),
            $request->getQueryParam('min'),
            $request->getQueryParam('max'),
            $request->getQueryParam('onlyMyCommunities') === 'true',
            $userId,
            ($userId !== null) ? $this->getMyCommunityIds($userId) : null
        );
        $pageInfo = new PageInfoDto($pageSize, ceil($total/$pageSize), $currentPage);
        return $this->view->render(["posts" => $posts, "pagination" => $pageInfo->toArray()]);
    }


    public function listOfTags(Route $route, Request $request) : Response
    {
        $listCommunities = array_map(
            fn($tag) => $this->hydrateTagDto($tag)->toArray(),
            $this->tagRepository->getList()
        );
        return $this->view->render($listCommunities);
    }

    private function hydratePostDto(?Post $post, ?string $userId) : ?PostDto
    {
        if ($post === null) {
            return null;
        }
        $tags = array_map(
            fn($tag) => $this->hydrateTagDto($tag),
            $this->tagRepository->getPostTags($post->getId())
        );
        $arrayOfTags = array_map(fn($tag) => $tag->toArray(),$tags);
        $postArray = $post->toArray();
        $postArray['hasLike'] = $userId !== null && $this->likeRepository->checkHasLike($userId ,$postArray['id']);
        $dto = PostDto::fromArray($postArray);
        $dto->setTags($arrayOfTags);
        return $dto;
    }

    private function hydrateTagDto(Tag $model) : TagDto
    {
        return TagDto::fromArray($model->toArray());
    }

    protected function getMyCommunityIds(string $userId) : array
    {
        $subscribes = $this->subscribeRepository->getSubscribesOfUser($userId);
        $admins = $this->administratorRepository->getAdminRolesOfUser($userId);
        $myCommunitiesIds = [];
        foreach ($subscribes as $subCommunityId) {
            $myCommunitiesIds[] = $subCommunityId;
        }
        foreach ($admins as $adminCommunityId) {
            if (!in_array($adminCommunityId, $myCommunitiesIds)) {
                $myCommunitiesIds[] = $adminCommunityId;
            }
        }
        return $myCommunitiesIds;
    }
}