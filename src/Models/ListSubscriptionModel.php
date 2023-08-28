<?php

namespace Junisan\ListmonkApi\Models;

use DateTime;

class ListSubscriptionModel extends ListModel
{
    private ?string $subscriptionStatus;
    private ?DateTime $subscriptionCreatedAt;
    private ?DateTime $subscriptionUpdatedAt;

    public function getSubscriptionStatus(): ?string
    {
        return $this->subscriptionStatus;
    }

    public function setSubscriptionStatus(?string $subscriptionStatus): ListSubscriptionModel
    {
        $this->subscriptionStatus = $subscriptionStatus;
        return $this;
    }

    public function getSubscriptionCreatedAt(): ?DateTime
    {
        return $this->subscriptionCreatedAt;
    }

    public function setSubscriptionCreatedAt(?DateTime $subscriptionCreatedAt): ListSubscriptionModel
    {
        $this->subscriptionCreatedAt = $subscriptionCreatedAt;
        return $this;
    }

    public function getSubscriptionUpdatedAt(): ?DateTime
    {
        return $this->subscriptionUpdatedAt;
    }

    public function setSubscriptionUpdatedAt(?DateTime $subscriptionUpdatedAt): ListSubscriptionModel
    {
        $this->subscriptionUpdatedAt = $subscriptionUpdatedAt;
        return $this;
    }


}