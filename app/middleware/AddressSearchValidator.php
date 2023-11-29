<?php

namespace app\middleware;

use app\repository\AddressRepository;
use core\http\Request;
use core\http\Response;
use core\middleware\Validator;
use core\Route;

class AddressSearchValidator extends Validator
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
        $id = $request->getQueryParam('parentObjectId');
        if ($id !== null and !$this->checkExistById($id)) {
            $this->errors[] = sprintf('address with %s id does not exist', $id);
            return;
        }
    }

    private function checkExistById(int $id) : bool
    {
        return $this->repository->getById($id) !== null;
    }

    protected function renderErrors(array $errors): Response
    {
        $response = new Response(json_encode(['errors' => $errors]), 404);
        $response->addHeader('Content-Type', 'application/json');
        return $response;
    }
}