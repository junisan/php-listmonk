<?php

namespace Junisan\ListmonkApi\UseCases\Subscribers;

use Junisan\ListmonkApi\Builders\SubscriberBuilder;
use Junisan\ListmonkApi\API\ListmonkApi;
use Junisan\ListmonkApi\Models\SubscriberModel;

class CreateSubscriber
{
    private ListmonkApi $api;
    private SubscriberBuilder $builder;

    public function __construct(ListmonkApi $api, SubscriberBuilder $builder)
    {
        $this->api = $api;
        $this->builder = $builder;
    }

    public function __invoke(SubscriberModel $subscriber, bool $preconfirmedSubscriptions = false): SubscriberModel
    {
        $data = [
            'email' => $subscriber->getEmail(),
            'name' => $subscriber->getName(),
            'status' => $subscriber->getStatus(),
            'lists' => $subscriber->getLists(),
            'preconfirm_subscriptions' => $preconfirmedSubscriptions
        ];

        if($subscriber->getAttributes()->count()) {
            $data['attribs'] = $subscriber->getAttributes()->getAll();
        }

        $dataResponse = $this->api->post('/subscribers', $data);
        return $this->builder->__invoke($dataResponse);
    }
}