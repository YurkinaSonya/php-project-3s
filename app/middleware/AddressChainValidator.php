<?php

namespace app\middleware;

use app\repository\AddressRepository;
use core\http\Request;
use core\http\Response;
use core\middleware\Validator;
use core\Route;

class AddressChainValidator extends Validator
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
        $guid = $request->getQueryParam('objectGuid');
        if ($guid !== null and !$this->checkExistByGuid($guid)) {
            $this->errors[] = sprintf('address with %s guid does not exist', $guid);
            return;
        }
    }

    private function checkExistByGuid(string $guid) : bool
    {
        return $this->repository->getByGuid($guid) !== null;
    }

    protected function renderErrors(array $errors): Response
    {
        $response = new Response(json_encode(['errors' => $errors]), 404);
        $response->addHeader('Content-Type', 'application/json');
        return $response;
    }

}