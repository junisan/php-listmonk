<?php

namespace Junisan\ListmonkApi\Builders;

use DateTime;
use Junisan\ListmonkApi\Models\ListModel;
use Junisan\ListmonkApi\Models\ListSubscriptionModel;

class ListBuilder
{
    public function __invoke(array $list): ListModel
    {
        $created = new DateTime($list['created_at']);
        $updated = new DateTime($list['updated_at']);
        $isPublic = $list['type'] === 'public';
        $isOptinSimple = $list['optin'] === 'single';

        $objectBase = array_key_exists('subscription_status', $list)
            ? new ListSubscriptionModel() : new ListModel();

        $object = $objectBase
            ->setUuid($list['uuid'])
            ->setName($list['name'])
            ->setId($list['id'])
            ->setDescription($list['description'])
            ->setTags($list['tags'])
            ->setIsPublic($isPublic)
            ->setOptinSimple($isOptinSimple)
            ->setCreatedAt($created)
            ->setUpdatedAt($updated)
            ;

        if ($object instanceof ListSubscriptionModel) {
            $created = new DateTime($list['subscription_created_at']);
            $updated = new DateTime($list['subscription_updated_at']);

            $object
                ->setSubscriptionStatus($list['subscription_status'])
                ->setSubscriptionCreatedAt($created)
                ->setSubscriptionUpdatedAt($updated)
                ;
        }

        return $object;
    }
}