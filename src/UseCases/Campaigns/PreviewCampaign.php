<?php

namespace Junisan\ListmonkApi\UseCases\Campaigns;

use Junisan\ListmonkApi\API\ListmonkApi;
use Junisan\ListmonkApi\Exceptions\ApiClientException;

class PreviewCampaign
{
    private ListmonkApi $api;

    public function __construct(ListmonkApi $api)
    {
        $this->api = $api;
    }

    public function __invoke(int $campaignId): ?string
    {
        try {
            $previewContent = $this->api->post('/campaigns/'.$campaignId.'/preview', []);
            return $previewContent['preview'] ?? null;
        } catch (ApiClientException $e) {
            return null;
        }
    }
}