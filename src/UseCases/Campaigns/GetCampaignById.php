<?php

namespace Junisan\ListmonkApi\UseCases\Campaigns;

use Junisan\ListmonkApi\API\ListmonkApi;
use Junisan\ListmonkApi\Builders\CampaignBuilder;
use Junisan\ListmonkApi\Exceptions\ApiClientException;
use Junisan\ListmonkApi\Models\CampaignModel;

class GetCampaignById
{
    private ListmonkApi $api;
    private CampaignBuilder $campaignBuilder;

    public function __construct(ListmonkApi $api, CampaignBuilder $campaignBuilder)
    {
        $this->api = $api;
        $this->campaignBuilder = $campaignBuilder;
    }

    public function __invoke(int $id): ?CampaignModel
    {
        try {
            $campaignData = $this->api->get('/campaigns/' . $id);
            return $this->campaignBuilder->__invoke($campaignData);
        } catch (ApiClientException $e) {
            return null;
        }
    }
}