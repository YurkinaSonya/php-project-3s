<?php

namespace app\controller;

use app\dto\TagDto;
use app\model\Tag;
use app\repository\TagRepository;
use core\http\Request;
use core\http\Response;
use core\Route;
use core\view\JsonView;

class PostController
{
    private TagRepository $tagRepository;
    private JsonView $view;

    /**
     * @param TagRepository $tagRepository
     * @param JsonView $view
     */
    public function __construct(TagRepository $tagRepository, JsonView $view)
    {
        $this->tagRepository = $tagRepository;
        $this->view = $view;
    }

    public function listOfPosts(Route $route, Request $request) : Response
    {
        return $this->view->render([]);
    }


    public function listOfTags(Route $route, Request $request) : Response
    {
        $listCommunities = array_map(
            fn($tag) => $this->hydrateTagDto($tag)->toArray(),
            $this->tagRepository->getList()
        );
        return $this->view->render($listCommunities);
    }

    private function hydrateTagDto(Tag $model) : TagDto
    {
        return TagDto::fromArray($model->toArray());
    }
}