<?php

namespace app\middleware;

use app\model\Film;
use app\repository\FilmRepository;
use core\http\Request;
use core\http\Response;
use core\middleware\Validator;
use core\Route;

class ValidateFilm extends Validator
{

    private FilmRepository $repository;

    /**
     * @param FilmRepository $repository
     */
    public function __construct(FilmRepository $repository)
    {
        $this->repository = $repository;
    }


    public function validate(Route $route, Request $request): void
    {
        $data = json_decode($request->getBody(), true);

        $this->checkEmpty(['title' => 'Film title', 'release_year' => 'Release year'], $data);
        if ($this->errors) {
            return;
        }

        $existing = $this->repository->findByTitleAndYear($data['title'], (int)$data['release_year']);

        if ($existing === null) {
            return;
        }

        $currentId = $route->getParam(0);

        if ($currentId === $existing->getId()) {
            return;
        }

        $this->errors[] = sprintf('Film with "%s" title and release year %d already exists', $data['title'], (int)$data['release_year']);
    }

    protected function renderErrors(array $errors): Response
    {
        $response = new Response(json_encode(['errors' => $errors]), 400);
        $response->addHeader('Content-Type', 'application/json');
        return $response;
    }


}