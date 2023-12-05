<?php

namespace app\service;

use app\repository\AdministratorRepository;
use app\repository\SubscribeRepository;

class AccessService
{
    private SubscribeRepository $subscribeRepository;
    private AdministratorRepository $administratorRepository;

    /**
     * @param SubscribeRepository $subscribeRepository
     * @param AdministratorRepository $administratorRepository
     */
    public function __construct(SubscribeRepository $subscribeRepository, AdministratorRepository $administratorRepository)
    {
        $this->subscribeRepository = $subscribeRepository;
        $this->administratorRepository = $administratorRepository;
    }


    public function getMyCommunityIds(string $userId) : array
    {
        $subscribes = $this->subscribeRepository->getSubscribesOfUser($userId);
        $admins = $this->administratorRepository->getAdminRolesOfUser($userId);
        return array_merge($subscribes, $admins);
    }
}