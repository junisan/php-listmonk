<?php

namespace Junisan\ListmonkApi\Builders;

use DateTime;
use Junisan\ListmonkApi\Models\CampaignModel;

class CampaignBuilder
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $data): CampaignModel
    {
        $created = new DateTime($data['created_at']);
        $updated = new DateTime($data['updated_at']);
        $startedAt = !!$data['started_at'] ? new DateTime($data['started_at']) : null ;
        $sendAt = !!$data['send_at'] ? new DateTime($data['send_at']) : null ;
        $listsIds = array_map(fn(array $listData) => $listData['id'], $data['lists']);

        return (new CampaignModel())
            ->setId($data['id'])
            ->setUuid($data['uuid'])
            ->setStatus($data['status'])
            ->setType($data['type'])
            ->setContentType($data['content_type'])
            ->setListIds($listsIds)
            ->setFromEmail($data['from_email'])
            ->setTags($data['tags'])
            ->setTemplateId($data['template_id'])
            ->setName($data['name'])
            ->setSubject($data['subject'])
            ->setBody($data['body'])
            ->setAltBody($data['altbody'])
            ->setSendAt($sendAt)
            ->setToSend($data['to_send'])
            ->setSent($data['sent'])
            ->setStartedAt($startedAt)
            ->setViews($data['views'])
            ->setClicks($data['clicks'])
            ->setBounces($data['bounces'])
            ->setCreatedAt($created)
            ->setUpdatedAt($updated)
            ;
    }
}