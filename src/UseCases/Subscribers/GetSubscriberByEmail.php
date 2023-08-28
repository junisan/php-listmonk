<?php

namespace Junisan\ListmonkApi\UseCases\Subscribers;

use Junisan\ListmonkApi\Builders\SubscriberBuilder;
use Junisan\ListmonkApi\API\ListmonkApi;
use Junisan\ListmonkApi\Exceptions\ApiClientException;
use Junisan\ListmonkApi\Models\SubscriberModel;

class GetSubscriberByEmail
{
    private ListmonkApi $api;
    private SubscriberBuilder $subscriberBuilder;

    public function __construct(ListmonkApi $api, SubscriberBuilder $subscriberBuilder)
    {
        $this->api = $api;
        $this->subscriberBuilder = $subscriberBuilder;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(string $email): ?SubscriberModel
    {
        $url = "/subscribers?query=subscribers.email = '$email'";
        try {
            $subscriberData = $this->api->get($url);
            if (!$subscriberData['results'] || count($subscriberData['results'] ) !== 1) {
                throw new ApiClientException('Subscriber not found');
            }

            return $this->subscriberBuilder->__invoke($subscriberData['results'][0]);
        } catch (ApiClientException $e) {
            return null;
        }
    }
}