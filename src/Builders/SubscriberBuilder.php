<?php

namespace Junisan\ListmonkApi\Builders;

use DateTime;
use Junisan\ListmonkApi\Models\SubscriberModel;

class SubscriberBuilder
{
    private SubscriberAttributesBuilder $attributesBuilder;
    private ListBuilder $listSubscriptionBuilder;

    public function __construct(SubscriberAttributesBuilder $attributesBuilder, ListBuilder $listSubscriptionBuilder)
    {
        $this->attributesBuilder = $attributesBuilder;
        $this->listSubscriptionBuilder = $listSubscriptionBuilder;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(array $subscriber): SubscriberModel
    {
        $created = new DateTime($subscriber['created_at']);
        $updated = new DateTime($subscriber['updated_at']);

        $lists = array_map(function($listData) {
            //If $listData is an array with more info, build list with builder.
            if (is_array($listData)) {
                return $this->listSubscriptionBuilder->__invoke($listData);
            }
            //Else, if only number, returns number
            return $listData;
        }, $subscriber['lists']);

        return (new SubscriberModel())
            ->setId($subscriber['id'])
            ->setName($subscriber['name'])
            ->setEmail($subscriber['email'])
            ->setStatus($subscriber['status'])
            ->setCreatedAt($created)
            ->setUpdatedAt($updated)
            ->setUuid($subscriber['uuid'])
            ->setAttributes($this->attributesBuilder->__invoke($subscriber['attribs'] ?? []))
            ->setLists($lists)
            ;
    }
}