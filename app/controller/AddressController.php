<?php

namespace app\controller;

use app\dto\SearchAddressDto;
use app\enum\ObjectLevel;
use app\model\Address;
use app\repository\AddressRepository;
use core\http\Request;
use core\http\Response;
use core\Route;
use core\view\JsonView;

class AddressController
{
    private AddressRepository $repository;
    private JsonView $view;

    /**
     * @param AddressRepository $repository
     * @param JsonView $view
     */
    public function __construct(AddressRepository $repository, JsonView $view)
    {
        $this->repository = $repository;
        $this->view = $view;
    }

    /**
     * @param AddressRepository $repository
     */


    public function search(Route $route, Request $request) : Response
    {
        $id = $request->getQueryParam('parentObjId');
        $query = $request->getQueryParam('query');
        $arrayOfModels = $this->repository->findByParentAndQuery($id, $query);
        $arrayOfDtos = array_map(fn($model) => $this->hydrateSearchAddressDto($model), $arrayOfModels);
        return $this->view->render(array_map(fn($dto) => $dto->toArray(), $arrayOfDtos));
    }

    public function chain(Route $route, Request $request) : Response
    {
        $guid = $request->getQueryParam('objectGuid');
        if ($guid === null) {
            return $this->view->render([]);
        }
        $arrayOfModels = $this->repository->parentsByGuid($guid);
        $arrayOfDtos = array_map(fn($model) => $this->hydrateSearchAddressDto($model), $arrayOfModels);
        return $this->view->render(array_map(fn($dto) => $dto->toArray(), $arrayOfDtos));
    }

    private function hydrateSearchAddressDto(Address $address) : SearchAddressDto
    {
        $array = $address->toArray();
        $ind = $array['level'] - 1;
        return new SearchAddressDto($array['objectId'], $array['id'], $array['text'], ObjectLevel::cases()[$ind]->name, ObjectLevel::cases()[$ind]->value);
    }


}