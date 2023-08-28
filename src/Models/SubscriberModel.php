<?php

namespace Junisan\ListmonkApi\Models;

use DateTime;
use Junisan\ListmonkApi\Models\Utils\DatesModelTrait;
use Junisan\ListmonkApi\Models\Utils\IdModelTrait;

class SubscriberModel
{
    use IdModelTrait;
    use DatesModelTrait;

    private ?string $name;
    private ?string $email;
    private ?string $status;
    private ?SubscriberAttributesModel $attributes = null;

    /** @var ListSubscriptionModel[]|int[] */
    private array $lists = [];

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): SubscriberModel
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): SubscriberModel
    {
        $this->email = $email;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): SubscriberModel
    {
        $availableStatus = ['enabled','disabled','blocklisted'];
        if (!in_array($status, $availableStatus)) {
            throw new \LogicException('Invalid status');
        }

        $this->status = $status;
        return $this;
    }

    public function getAttributes(): ?SubscriberAttributesModel
    {
        return $this->attributes ?? new SubscriberAttributesModel();
    }

    public function setAttributes(?SubscriberAttributesModel $attributes): SubscriberModel
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function getLists(): array
    {
        return $this->lists;
    }

    public function setLists(array $lists): SubscriberModel
    {
        $this->lists = $lists;
        return $this;
    }



}