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
    private UserRepository $userRepository;
    private JsonView $view;

    /**
     * @param AuthorRepository $authorRepository
     * @param UserRepository $userRepository
     * @param JsonView $view
     */
    public function __construct(AuthorRepository $authorRepository, UserRepository $userRepository, JsonView $view)
    {
        $this->authorRepository = $authorRepository;
        $this->userRepository = $userRepository;
        $this->view = $view;
    }

    public function getList(Route $route, Request $request) : Response
    {
        $authorModels = $this->authorRepository->getListOfAuthors();
        $authorDtos = array_map(fn($author) => $this->hydrateAuthorDto($author), $authorModels);
        usort($authorDtos, fn($a, $b) => strcmp($a->getFullName(), $b->getFullName()));
        $authors = array_map(fn($author) => $author->toArray(), $authorDtos);
        return $this->view->render($authors);
    }

    private function hydrateAuthorDto(Author $author) : AuthorDto
    {
        $user = $this->userRepository->findById($author->getUserId());
        $authorArray = $author->toArray();
        $userArray = $user->toArray();
        $dtoArray = [];
        $dtoArray['fullName'] = $userArray['fullName'];
        $dtoArray['birthDate'] = $userArray['birthDate'];
        $dtoArray['gender'] = $userArray['gender'];
        $dtoArray['posts'] = $authorArray['posts'];
        $dtoArray['likes'] = $authorArray['likes'];
        $dtoArray['created'] = $userArray['createTime'];
        return AuthorDto::fromArray($dtoArray);
    }


}