<?php

namespace Junisan\ListmonkApi;

use Junisan\ListmonkApi\API\ListmonkApi;
use Junisan\ListmonkApi\API\ListmonkCampaignsApi;
use Junisan\ListmonkApi\API\ListmonkListsApi;
use Junisan\ListmonkApi\API\ListmonkSubscriberApi;
use Psr\Http\Client\ClientInterface;

class ListmonkPHP
{
    private ListmonkApi $api;
    private ListmonkSubscriberApi $subscriberApi;
    private ListmonkListsApi $listsApi;
    private ListmonkCampaignsApi $campaignsApi;

    public function __construct(string $url, array $credentials = [], ClientInterface $client = null)
    {
        $username = $credentials['username'] ?? null;
        $password = $credentials['password'] ?? null;

        $this->api = new ListmonkApi($url, $username, $password, $client);
        $this->subscriberApi = new ListmonkSubscriberApi($this->api);
        $this->listsApi = new ListmonkListsApi($this->api);
        $this->campaignsApi = new ListmonkCampaignsApi($this->api);
    }

    public function getSubscribersApi(): ListmonkSubscriberApi
    {
        return $this->subscriberApi;
    }

    public function getListsApi(): ListmonkListsApi
    {
        return $this->listsApi;
    }

    public function getCampaignsApi(): ListmonkCampaignsApi
    {
        return $this->campaignsApi;
    }
}