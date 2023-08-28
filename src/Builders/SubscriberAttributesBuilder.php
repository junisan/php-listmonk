<?php

namespace Junisan\ListmonkApi\Builders;

use Junisan\ListmonkApi\Models\SubscriberAttributesModel;

class SubscriberAttributesBuilder
{
    public function __invoke(array $attribs): SubscriberAttributesModel
    {
        $attribsModel = new SubscriberAttributesModel();
        foreach ($attribs as $key => $value) {
            $attribsModel->set($key, $value);
        }

        return $attribsModel;
    }
}