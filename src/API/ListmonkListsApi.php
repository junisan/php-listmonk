<?php

namespace Junisan\ListmonkApi\API;

use Junisan\ListmonkApi\Builders\ListBuilder;
use Junisan\ListmonkApi\Models\ListModel;
use Junisan\ListmonkApi\Models\PaginatorModel;
use Junisan\ListmonkApi\UseCases\Lists\GetAllLists;
use Junisan\ListmonkApi\UseCases\Lists\GetListById;

class ListmonkListsApi
{
    private ListmonkApi $api;
    private ListBuilder $listBuilder;

    public function __construct(ListmonkApi $api, ListBuilder $listBuilder = null)
    {
        $this->api = $api;
        $this->listBuilder = $listBuilder ?? new ListBuilder();
    }

    public function getAllLists(int $page = 1, int $perPage = 100): PaginatorModel
    {
        $useCase = new GetAllLists($this->api, $this->listBuilder);
        return $useCase->__invoke($page, $perPage);
    }

    public function getListById(int $id): ?ListModel
    {
        $useCase = new GetListById($this->api, $this->listBuilder);
        return $useCase->__invoke($id);
    }
}