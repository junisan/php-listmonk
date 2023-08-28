<?php

namespace Junisan\ListmonkApi\UseCases\Campaigns;

use Junisan\ListmonkApi\Builders\CampaignBuilder;
use Junisan\ListmonkApi\API\ListmonkApi;
use Junisan\ListmonkApi\Models\CampaignModel;

class ChangeCampaignStatus
{
    private ListmonkApi $api;
    private CampaignBuilder $campaignBuilder;

    public function __construct(ListmonkApi $api, CampaignBuilder $campaignBuilder)
    {
        $this->api = $api;
        $this->campaignBuilder = $campaignBuilder;
    }

    public function __invoke(int $id, string $newStatus): CampaignModel
    {
        $availableStatus = ['scheduled', 'running', 'paused', 'cancelled'];
        if (!in_array($newStatus, $availableStatus)) {
            throw new \LogicException('Invalid campaign status');
        }

        $data = [
            'status' => $newStatus
        ];

        $response = $this->api->put('/campaigns/' . $id . '/status', $data);
        return $this->campaignBuilder->__invoke($response);
    }
}