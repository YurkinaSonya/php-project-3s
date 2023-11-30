<?php

namespace app\controller;

use app\dto\PageInfoDto;
use app\dto\PostDto;
use app\dto\TagDto;
use app\model\Post;
use app\model\Tag;
use app\repository\PostRepository;
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
    private TokenService $tokenService;
    private JsonView $view;
    private int $pageCount;

    /**
     * @param PostRepository $postRepository
     * @param TagRepository $tagRepository
     * @param TokenService $tokenService
     * @param JsonView $view
     * @param int $pageCount
     */
    public function __construct(PostRepository $postRepository, TagRepository $tagRepository, TokenService $tokenService, JsonView $view, int $pageCount)
    {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
        $this->tokenService = $tokenService;
        $this->view = $view;
        $this->pageCount = $pageCount;
    }


    public function listOfPosts(Route $route, Request $request) : Response
    {
        $userId = $this->tokenService->getCurrentUserId();
        $pageSize = $request->getQueryParam('size', $this->pageCount);
        $currentPage = $request->getQueryParam('page', 1);
        $whereTerms = $this->generateWhereTerms($request);
        $order = null;
        if ($request->getQueryParam('sorting')) {
            $order = ' ORDER BY ';
            switch ($request->getQueryParam('sorting')) {
                case 'CreateDesc':
                    $order .= 'create_time Desc ';
                    break;
                case 'CreateAsc':
                    $order .= 'create_time Asc ';
                    break;
                case 'LikeDesc':
                    $order .= 'likes Desc ';
                    break;
                case 'LikeAsc':
                    $order .= 'likes Asc ';
                    break;
            }
        }
        $posts = array_map(
            fn($post) => $this->hydratePostDto($post)->toArray(),
            $this->postRepository->getList(
                $pageSize * ($currentPage - 1),
                $pageSize,
                $whereTerms,
                $order
            )
        );
        $total = $this->postRepository->getTotalCount($whereTerms);
        $pageInfo = new PageInfoDto($pageSize, ceil($total/$pageSize), $currentPage);
        return $this->view->render([$posts, $pageInfo->toArray()]);
    }

    private function generateWhereTerms(Request $request) : array
    {
        /**
        $onlyMyCommunities = $request->getQueryParam('onlyMyCommunities');
         */
        $whereTerms = [];
        if ($request->getQueryParam('tags')) {
            $tags = '("' . implode('","', $request->getQueryParam('tags')) .'")';
            $whereTerms[] = ' JOIN post_tags ON post.id = post_tags.post_id WHERE post_tags.tag_id in ' . $tags;
        }
        if ($request->getQueryParam('author')) {
            $whereTerms[] = '  WHERE author_name LIKE "%' . $request->getQueryParam('author') . '%"';
        }
        if ($request->getQueryParam('min')) {
            $whereTerms[] = '  WHERE reading_time >= ' . $request->getQueryParam('min');
        }
        if ($request->getQueryParam('max')) {
            $whereTerms[] = '  WHERE reading_time <= ' . $request->getQueryParam('max');
        }
        return $whereTerms;
    }


    public function listOfTags(Route $route, Request $request) : Response
    {
        $listCommunities = array_map(
            fn($tag) => $this->hydrateTagDto($tag)->toArray(),
            $this->tagRepository->getList()
        );
        return $this->view->render($listCommunities);
    }

    private function hydratePostDto(?Post $post) : ?PostDto
    {
        if ($post === null) {
            return null;
        }
        $tags = array_map(
            fn($tag) => $this->hydrateTagDto($tag),
            $this->tagRepository->getPostTags($post->getId())
        );
        $arrayOfTags = array_map(fn($tag) => $tag->toArray(),$tags);
        $dto = PostDto::fromArray($post->toArray());
        $dto->setTags($arrayOfTags);
        return $dto;
    }

    private function hydrateTagDto(Tag $model) : TagDto
    {
        return TagDto::fromArray($model->toArray());
    }
}