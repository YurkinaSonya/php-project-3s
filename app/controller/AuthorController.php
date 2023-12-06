<?php

namespace app\controller;

use app\dto\AuthorDto;
use app\model\Author;
use app\repository\AuthorRepository;
use app\repository\UserRepository;
use core\http\Request;
use core\http\Response;
use core\Route;
use core\view\JsonView;

class AuthorController
{
    private AuthorRepository $authorRepository;
    private JsonView $view;

    /**
     * @param AuthorRepository $authorRepository
     * @param JsonView $view
     */
    public function __construct(AuthorRepository $authorRepository, JsonView $view)
    {
        $this->authorRepository = $authorRepository;
        $this->view = $view;
    }

    public function getList(Route $route, Request $request) : Response
    {
        $authorModels = $this->authorRepository->getListOfAuthors();
        $authors = array_map(fn($author) => $this->hydrateAuthorDto($author)->toArray(), $authorModels);
        return $this->view->render($authors);
    }

    private function hydrateAuthorDto(Author $author) : AuthorDto
    {
        $authorArray = $author->toArray();
        unset($authorArray['id']);
        return AuthorDto::fromArray($authorArray);
    }


}