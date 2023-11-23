<?php

namespace app\controller;

use app\dto\CommunityDto;
use app\model\Community;
use app\repository\CommunityRepository;
use core\http\Request;
use core\http\Response;
use core\Route;
use core\view\JsonView;

class CommunityController
{
    private CommunityRepository $repository;
    private JsonView $view;
    private int $pageCount;

    public function __construct(CommunityRepository $repository, JsonView $view, int $pageCount)
    {
        $this->repository = $repository;
        $this->view = $view;
        $this->pageCount = $pageCount;
    }

    public function listOfCommunity(Route $route, Request $request) : Response
    {
        $listArrays = array_map(
            fn($community) => $this->hydrateCommunityDto($community)->toArray(),
            $this->repository->getList()
        );
        return $this->view->render($listArrays);

    }

    private function hydrateCommunityDto(?Community $community) : ?CommunityDto
    {
        if ($community === null) {
            return null;
        }
        return CommunityDto::fromArray($community->toArray());
    }

    /**
     * @param Community|null $community
     * @param UserDto[] $administrators
     * @return CommunityFullDto|null
     */
    private function hydrateCommunityFullDto(?Community $community, array $administrators) : ?CommunityFullDto
    {
        if ($community === null) {
            return null;
        }
        $result =  new CommunityFullDto(...array_values(get_object_vars($community)));
        $result->setAuthors($administrators);
        return $result;
    }


}