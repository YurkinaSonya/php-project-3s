<?php

namespace app\controller;

use app\dto\PageInfoDto;
use app\dto\PostDto;
use app\dto\TagDto;
use app\model\Post;
use app\model\Tag;
use app\repository\PostRepository;
use app\repository\TagRepository;
use core\http\Request;
use core\http\Response;
use core\Route;
use core\view\JsonView;

class PostController
{
    private PostRepository $postRepository;
    private TagRepository $tagRepository;
    private JsonView $view;
    private int $pageCount;

    /**
     * @param PostRepository $postRepository
     * @param TagRepository $tagRepository
     * @param JsonView $view
     * @param int $pageCount
     */
    public function __construct(PostRepository $postRepository, TagRepository $tagRepository, JsonView $view, int $pageCount)
    {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
        $this->view = $view;
        $this->pageCount = $pageCount;
    }


    public function listOfPosts(Route $route, Request $request) : Response
    {
        $pageSize = $request->getQueryParam('size', $this->pageCount);
        $currentPage = $request->getQueryParam('page', 1);
        $posts = array_map(
            fn($post) => $this->hydratePostDto($post)->toArray(),
            $this->postRepository->getList($pageSize * ($currentPage - 1), $pageSize)
        );
        $total = $this->postRepository->getTotalCount();
        $pageInfo = new PageInfoDto($pageSize, ceil($total/$pageSize), $currentPage);
        return $this->view->render([$posts, $pageInfo->toArray()]);
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