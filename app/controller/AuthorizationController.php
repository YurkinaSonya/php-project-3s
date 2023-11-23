<?php

namespace app\controller;

use app\dto\LoginCredentialsDto;
use app\dto\UserDto;
use app\dto\UserEditDto;
use app\dto\UserRegisterDto;
use app\model\User;
use app\repository\TokenRepository;
use app\repository\UserRepository;
use app\service\EncryptService;
use app\service\TokenService;
use core\http\Request;
use core\http\Response;
use core\Route;
use core\view\JsonView;

class AuthorizationController
{
    private UserRepository $userRepository;
    private TokenService $tokenService;

    private EncryptService $encryptService;
    private JsonView $view;

    /**
     * @param UserRepository $userRepository
     * @param TokenService $tokenService
     * @param EncryptService $encryptService
     * @param JsonView $view
     */
    public function __construct(UserRepository $userRepository, TokenService $tokenService, EncryptService $encryptService, JsonView $view)
    {
        $this->userRepository = $userRepository;
        $this->tokenService = $tokenService;
        $this->encryptService = $encryptService;
        $this->view = $view;
    }


    public function register(Route $route, Request $request) : Response
    {
        $registerDto = UserRegisterDto::fromArray($request->getBodyJson());
        $registerDto->setPassword($this->encryptService->encryptPassword($registerDto->getPassword()));
        $dtoArray = $registerDto->toArray();
        $user = User::fromArray($dtoArray);
        $userId = $this->userRepository->createUser($user);
        $token = $this->tokenService->createToken($userId);
        return $this->view->render(['token' => $token]);
    }
    public function login(Route $route, Request $request) : Response
    {
        $loginDto = LoginCredentialsDto::fromArray($request->getBodyJson());
        $loginDto->setPassword($this->encryptService->encryptPassword($loginDto->getPassword()));
        $user = $this->userRepository->findByEmail($loginDto->getEmail());
        $token = $this->tokenService->createToken($user->getId());
        return $this->view->render(['token' => $token]);
    }

    public function profile(Route $route, Request $request) : Response
    {
        $id = $this->tokenService->getCurrentUserId();
        $user = $this->userRepository->findById($id);
        $userDto = $this->hydrateUserDto($user);
        return $this->view->render($userDto->toArray());
    }

    public function edit(Route $route, Request $request) : Response
    {
        $editDto = UserEditDto::fromArray($request->getBodyJson());
        $user = $this->userRepository->findById($this->tokenService->getCurrentUserId());
        $user = $user->outsideUpdateFromDto($editDto);
        $id = $this->userRepository->createUser($user);
        return $this->view->render(['id' => $id]);
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