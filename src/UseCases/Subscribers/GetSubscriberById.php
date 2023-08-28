<?php

namespace Junisan\ListmonkApi\UseCases\Subscribers;

use Junisan\ListmonkApi\Builders\SubscriberBuilder;
use Junisan\ListmonkApi\API\ListmonkApi;
use Junisan\ListmonkApi\Exceptions\ApiClientException;
use Junisan\ListmonkApi\Models\SubscriberModel;

class GetSubscriberById
{
    private ListmonkApi $api;
    private SubscriberBuilder $subscriberBuilder;

    public function __construct(ListmonkApi $api, SubscriberBuilder $subscriberBuilder)
    {
        $this->api = $api;
        $this->subscriberBuilder = $subscriberBuilder;
    }

    public function __invoke(int $id): ?SubscriberModel
    {
        try {
            $subscriberData = $this->api->get('/subscribers/' . $id);
            return $this->subscriberBuilder->__invoke($subscriberData);
        } catch (ApiClientException $e) {
            return null;
        }
    }
}