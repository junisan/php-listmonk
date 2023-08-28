<?php

namespace Junisan\ListmonkApi\UseCases\Lists;

use Junisan\ListmonkApi\Builders\ListBuilder;
use Junisan\ListmonkApi\API\ListmonkApi;
use Junisan\ListmonkApi\Exceptions\ApiClientException;
use Junisan\ListmonkApi\Models\ListModel;

class GetListById
{
    private ListmonkApi $api;
    private ListBuilder $listBuilder;

    public function __construct(ListmonkApi $api, ListBuilder $listBuilder)
    {
        $this->api = $api;
        $this->listBuilder = $listBuilder;
    }

    public function __invoke(int $id): ?ListModel
    {
        try {
            $listData = $this->api->get('/lists/' . $id);
            return $this->listBuilder->__invoke($listData);
        } catch (ApiClientException $e) {
            return null;
        }
    }
}