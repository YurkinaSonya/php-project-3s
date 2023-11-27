<?php

namespace app\middleware;

use app\repository\AddressRepository;
use core\http\Request;
use core\http\Response;
use core\middleware\Validator;
use core\Route;

class AddressValidator extends Validator
{
    private AddressRepository $repository;

    /**
     * @param AddressRepository $repository
     */
    public function __construct(AddressRepository $repository)
    {
        $this->repository = $repository;
    }


    protected function validate(Route $route, Request $request): void
    {
        $id = $request->getQueryParam('parentObjectId', null);
        $guid = $request->getQueryParam('objectGuid', null);
        if ($id !== null and !$this->checkExistById($id)) {
            $this->errors[] = sprintf('address with %s id does not exist', $id);
            return;
        }
        if ($guid !== null and !$this->checkExistByGuid($guid)) {
            $this->errors[] = sprintf('address with %s guid does not exist', $guid);
            return;
        }
    }

    private function checkExistByGuid(string $guid) : bool
    {
        if ($this->repository->getByGuid($guid) === null) {
            return false;
        }
        return true;
    }

    private function checkExistById(int $id) : bool
    {
        if ($this->repository->getById($id) === null) {
            return false;
        }
        return true;
    }

    protected function renderErrors(array $errors): Response
    {
        $response = new Response(json_encode(['errors' => $errors]), 400);
        $response->addHeader('Content-Type', 'application/json');
        return $response;
    }
}