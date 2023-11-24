<?php

namespace app\controller;

use app\dto\CommunityDto;
use app\dto\CommunityFullDto;
use app\dto\CommunityUserDto;
use app\dto\ResponseDto;
use app\dto\UserDto;
use app\model\Community;
use app\model\Subscribe;
use app\model\User;
use app\repository\CommunityRepository;
use app\repository\SubscribeRepository;
use app\repository\UserRepository;
use app\service\TokenService;
use core\http\Request;
use core\http\Response;
use core\Route;
use core\view\JsonView;
use core\view\View;

class CommunityController
{
    private CommunityRepository $repository;
    private UserRepository $userRepository;
    private SubscribeRepository $subscribeRepository;
    private TokenService $tokenService;
    private JsonView $view;
    private int $pageCount;

    private const USER_ROLE_ADMIN = 'Administrator';
    private const USER_ROLE_SUB = 'Subscriber';

    /**
     * @param CommunityRepository $repository
     * @param UserRepository $userRepository
     * @param SubscribeRepository $subscribeRepository
     * @param TokenService $tokenService
     * @param JsonView $view
     * @param int $pageCount
     */
    public function __construct(CommunityRepository $repository, UserRepository $userRepository, SubscribeRepository $subscribeRepository, TokenService $tokenService, JsonView $view, int $pageCount)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->subscribeRepository = $subscribeRepository;
        $this->tokenService = $tokenService;
        $this->view = $view;
        $this->pageCount = $pageCount;
    }


    public function list(Route $route, Request $request) : Response
    {
        $listCommunities = array_map(
            fn($community) => $this->hydrateCommunityDto($community)->toArray(),
            $this->repository->getListOfCommunity()
        );
        return $this->view->render($listCommunities);
    }

    public function single(Route $route, Request $request) : Response
    {
        $community = $this->repository->getCommunity($route->getParam(0));
        $administrators = array_map(
            fn($admin) => $this->hydrateUserDto($admin)->toArray(),
            $this->userRepository->getListByIds($this->repository->getAdministratorIds($community->getId()))
        );
        $dto = $this->hydrateCommunityFullDto($community, $administrators);
        //var_export($dto); die;
        return $this->view->render($dto->toArray());
    }

    public function my(Route $route, Request $request) : Response
    {
        $userId = $this->tokenService->getCurrentUserId();
        $subscribes = $this->subscribeRepository->getSubscribesOfUser($userId);
        $admins =$this->repository->getAdminRolesOfUser($userId);
        $array = $this->getArrayOfCommunityUserDto($userId, $subscribes, $admins);
        return $this->view->render(array_map(fn($dto) => $dto->toArray(), $array));
    }

    public function role(Route $route, Request $request) : Response
    {
        $userId = $this->tokenService->getCurrentUserId();
        $communityId = $route->getParam(0);
        $role = $this->getRoleOfUser($userId, $communityId);
        if ($role === null) {
            $dto = new ResponseDto('Error', 'Sequence contains no elements');
            return $this->view->render($dto->toArray());
        }
        return $this->view->render([$role]);
    }

    public function subscribe(Route $route, Request $request) : Response
    {
        $communityId = $route->getParam(0);
        $userId = $this->tokenService->getCurrentUserId();
        //var_export($userId); die;
        $sub = new Subscribe(null, $userId, $communityId);
        $this->subscribeRepository->subscribe($sub);
        return $this->view->render([]);
    }

    public function unsubscribe(Route $route, Request $request) : Response
    {
        $communityId = $route->getParam(0);
        $userId = $this->tokenService->getCurrentUserId();
        $sub = $this->subscribeRepository->findByUserIdCommunityId($userId, $communityId);
        $this->subscribeRepository->unsubscribe($sub);
        return $this->view->render([]);
    }

    private function getRoleOfUser(string $userId, string $communityId) : ?string
    {
        if ($this->repository->findAdminByUserIdCommunityId($userId, $communityId) === null) {
            if ($this->subscribeRepository->findByUserIdCommunityId($userId, $communityId) === null) {
                return null;
            }
            return self::USER_ROLE_SUB;
        }
        return self::USER_ROLE_ADMIN;
    }

    private function getArrayOfCommunityUserDto(string $userId, array $subscribes, array $admins) : array
    {
        $arrayOfDtos = [];
        foreach ($subscribes as $subCommunityId) {
            $arrayOfDtos[$subCommunityId] = $this->hydrateCommunityUserDto($userId, $subCommunityId, self::USER_ROLE_SUB);
        }
        foreach ($admins as $adminCommunityId) {
            $arrayOfDtos[$adminCommunityId] = $this->hydrateCommunityUserDto($userId, $adminCommunityId, self::USER_ROLE_ADMIN);
        }
        return array_values($arrayOfDtos);
    }

    private function hydrateCommunityDto(?Community $community) : ?CommunityDto
    {
        if ($community === null) {
            return null;
        }
        return CommunityDto::fromArray($community->toArray());
    }

    private function hydrateCommunityUserDto(string $userId, string $communityId, string $role) : CommunityUserDto
    {
        return new CommunityUserDto($userId, $communityId, $role);
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
        $communityArray = $community->toArray();
        $result = CommunityFullDto::fromArray($communityArray);
        $result->setAdministrators($administrators);
        return $result;
    }


    private function hydrateUserDto(?User $user) : ?UserDto
    {
        if ($user === null) {
            return null;
        }
        $userArray = $user->toArray();
        unset($userArray['password']);
        return UserDto::fromArray($userArray);
    }
}