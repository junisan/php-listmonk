<?php

namespace Junisan\ListmonkApi\API;

use Junisan\ListmonkApi\Builders\ListBuilder;
use Junisan\ListmonkApi\Builders\SubscriberAttributesBuilder;
use Junisan\ListmonkApi\Builders\SubscriberBuilder;
use Junisan\ListmonkApi\Models\PaginatorModel;
use Junisan\ListmonkApi\Models\SubscriberModel;
use Junisan\ListmonkApi\UseCases\Subscribers\CreateSubscriber;
use Junisan\ListmonkApi\UseCases\Subscribers\GetAllSubscribers;
use Junisan\ListmonkApi\UseCases\Subscribers\GetSubscriberByEmail;
use Junisan\ListmonkApi\UseCases\Subscribers\GetSubscriberById;

class ListmonkSubscriberApi
{
    private ListmonkApi $api;
    private SubscriberBuilder $builder;

    public function __construct(
        ListmonkApi $api,
        SubscriberBuilder $builder = null,
        SubscriberAttributesBuilder $attributesBuilder = null,
        ListBuilder $listSubscriptionBuilder = null
    )
    {
        $this->api = $api;
        $attributesBuilder = $attributesBuilder ?? new SubscriberAttributesBuilder();
        $listSubscriptionBuilder = $listSubscriptionBuilder ?? new ListBuilder();
        $this->builder = $builder ?? new SubscriberBuilder($attributesBuilder, $listSubscriptionBuilder);
    }

    public function createSubscriber(SubscriberModel $subscriber, bool $preconfirmedSubscriptions = false): SubscriberModel
    {
        $useCase = new CreateSubscriber($this->api, $this->builder);
        return $useCase->__invoke($subscriber, $preconfirmedSubscriptions);
    }

    public function getAllSubscriber(int $page = 1, int $perPage = 100): PaginatorModel
    {
        $useCase = new GetAllSubscribers($this->api, $this->builder);
        return $useCase->__invoke($page, $perPage);
    }

    /**
     * @throws \Exception
     */
    public function getSubscriberByEmail(string $email): SubscriberModel
    {
        $useCase = new GetSubscriberByEmail($this->api, $this->builder);
        return $useCase->__invoke($email);
    }

    public function getSubscriberById(int $id): SubscriberModel
    {
        $useCase = new GetSubscriberById($this->api, $this->builder);
        return $useCase->__invoke($id);
    }
}