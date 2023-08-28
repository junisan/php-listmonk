<?php

namespace Junisan\ListmonkApi\API;

use Junisan\ListmonkApi\Builders\CampaignBuilder;
use Junisan\ListmonkApi\Models\CampaignModel;
use Junisan\ListmonkApi\Models\PaginatorModel;
use Junisan\ListmonkApi\UseCases\Campaigns\ChangeCampaignStatus;
use Junisan\ListmonkApi\UseCases\Campaigns\CreateCampaign;
use Junisan\ListmonkApi\UseCases\Campaigns\GetAllCampaigns;
use Junisan\ListmonkApi\UseCases\Campaigns\PreviewCampaign;

class ListmonkCampaignsApi
{
    private ListmonkApi $api;
    private CampaignBuilder $campaignBuilder;

    public function __construct(ListmonkApi $api, CampaignBuilder $campaignBuilder = null)
    {
        $this->api = $api;
        $this->campaignBuilder = $campaignBuilder ?? new CampaignBuilder();
    }

    public function createCampaign(CampaignModel $campaign): CampaignModel
    {
        $useCase = new CreateCampaign($this->api, $this->campaignBuilder);
        return $useCase->__invoke($campaign);
    }

    public function getAllCampaigns(): PaginatorModel
    {
        $useCase = new GetAllCampaigns($this->api, $this->campaignBuilder);
        return $useCase->__invoke();
    }

    public function changeCampaignStatus(int $id, string $newStatus): CampaignModel
    {
        $useCase = new ChangeCampaignStatus($this->api, $this->campaignBuilder);
        return $useCase->__invoke($id, $newStatus);
    }

    public function previewCampaign(int $campaignId): ?string
    {
        $useCase = new PreviewCampaign($this->api);
        return $useCase->__invoke($campaignId);
    }
}