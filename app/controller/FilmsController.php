<?php

namespace app\controller;


use app\repository\FilmRepository;
use app\view\View;
use core\http\Response;
use core\Route;
use core\http\Request;

//function listObjects($film): array
//{
//    return $film->toArray();
//}

class FilmsController
{
    private FilmRepository $repository;
    private View $view;

    private int $pageCount;

    /**
     * @param FilmRepository $repository
     * @param View $view
     */
    public function __construct(FilmRepository $repository, View $view, int $pageCount)
    {
        $this->repository = $repository;
        $this->view = $view;
        $this->pageCount = $pageCount;
    }


    public function list(Route $route, Request $request): Response //они же не нужны??? Но как бы есть в route, так что вот
    {
        $limit = $request->getQueryParam('limit', $this->pageCount);
        $offset = $request->getQueryParam('offset', 0);

        $listArrays = array_map(
            fn($film): array => $film->toArray(),
            $this->repository->getList($offset, $limit)
        );
        return $this->view->render([
            'offset' => $offset,
            'limit' => $limit,
            'total' => $this->repository->getListTotalCount(),
            'list' => $listArrays,
        ]);
    }
    //Works

    public function listPage(Route $route, Request $request): Response //они же не нужны??? Но как бы есть в route, так что вот
    {
        $page = $route->getParam(0);
        $listArrays = array_map(
            fn($film): array => $film->toArray(),
            $this->repository->getList($page * $this->pageCount,$this->pageCount)
        );
        return $this->view->render($listArrays);
    }

    public function single(Route $route, Request $request): string|Response //request???
    {
        $film = $this->repository->getFilm($route->getParam(0));
        if ($film === null) {
            return new Response('', 404);
        }
        return $this->view->render($film->toArray());
    }

    public function addSingle(Route $route, Request $request): string|Response //request???
    {
        $body = json_decode($request->getBody(), true);

        $id = $this->repository->addFilm($body['title'], (int)$body['release_year']);

        $film = $this->repository->getFilm($id);

        return $this->view->render($film->toArray());
    }

    public function updateSingle(Route $route, Request $request): string|Response //request???
    {
        $body = json_decode($request->getBody(), true);

        $id = $this->repository->updateFilm($route->getParam(0), $body['title'], $body['release_year']);

        $film = $this->repository->getFilm($id);

        return $this->view->render($film->toArray());
    }

    public function deleteSingle(Route $route, Request $request): string|Response //request???
    {
        $this->repository->deleteFilm($route->getParam(0));

        return $this->view->render([true]);
    }

}
