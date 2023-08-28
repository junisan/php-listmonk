<?php

namespace Junisan\ListmonkApi\UseCases\Campaigns;

use Junisan\ListmonkApi\Builders\CampaignBuilder;
use Junisan\ListmonkApi\API\ListmonkApi;
use Junisan\ListmonkApi\Models\CampaignModel;

class CreateCampaign
{
    private ListmonkApi $api;
    private CampaignBuilder $campaignBuilder;

    public function __construct(ListmonkApi $api, CampaignBuilder $campaignBuilder)
    {
        $this->api = $api;
        $this->campaignBuilder = $campaignBuilder;
    }

    public function __invoke(CampaignModel $campaign): CampaignModel
    {
        $data = [
            'name' => $campaign->getName(),
            'subject' => $campaign->getSubject(),
            'lists' => $campaign->getListIds(),
            'from_email' => $campaign->getFromEmail(),
            'type' => $campaign->getType(),
            'content_type' => $campaign->getContentType(),
            'body' => $campaign->getBody(),
            'altbody' => $campaign->getAltBody(),
            'send_at' => $campaign->getSendAt(),
            'messenger' => 'email', //not implemented
            'template_id' => $campaign->getTemplateId(),
            'tags' => $campaign->getTags()
        ];
        $dataResponse = $this->api->post('/campaigns', $data);
        return $this->campaignBuilder->__invoke($dataResponse);
    }
}