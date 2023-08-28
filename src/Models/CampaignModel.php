<?php

namespace Junisan\ListmonkApi\Models;

use DateTime;
use Junisan\ListmonkApi\Models\Utils\DatesModelTrait;
use Junisan\ListmonkApi\Models\Utils\IdModelTrait;

class CampaignModel
{
    use IdModelTrait;
    use DatesModelTrait;

    //Basic data
    private ?string $status = null;

    //Custom campaign data
    private ?string $type = null;
    private ?string $contentType = null;
    private ?string $name = null;
    private ?string $subject = null;
    private ?string $body = null;
    /** @var string[] */
    private array $tags = [];
    /** @var int[] */
    private array $listIds = [];

    //Advanced campaign data
    private ?DateTime $startedAt = null;
    private ?int $toSend = null;
    private ?int $sent = null;
    private ?string $fromEmail = null;
    private ?string $altBody = null;
    private ?DateTime $sendAt = null;
    private ?int $templateId = null;

    //Stats
    private ?int $views = 0;
    private ?int $clicks = 0;
    private ?int $bounces = 0;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): CampaignModel
    {
        $this->status = $status;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): CampaignModel
    {
        $availableTypes = ['regular','optin'];
        if (!in_array($type, $availableTypes)) {
            throw new \LogicException('Invalid campaign type');
        }

        $this->type = $type;
        return $this;
    }

    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    public function setContentType(?string $contentType): CampaignModel
    {
        $availableContentTypes = ['richtext','html','markdown','plain'];
        if (!in_array($contentType, $availableContentTypes)) {
            throw new \LogicException('Invalid campaign content type');
        }

        $this->contentType = $contentType;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): CampaignModel
    {
        $this->name = $name;
        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): CampaignModel
    {
        $this->subject = $subject;
        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): CampaignModel
    {
        $this->body = $body;
        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): CampaignModel
    {
        $this->tags = $tags;
        return $this;
    }

    public function getListIds(): array
    {
        return $this->listIds;
    }

    public function setListIds(array $listIds): CampaignModel
    {
        $this->listIds = $listIds;
        return $this;
    }

    public function getStartedAt(): ?DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(?DateTime $startedAt): CampaignModel
    {
        $this->startedAt = $startedAt;
        return $this;
    }

    public function getToSend(): ?int
    {
        return $this->toSend;
    }

    public function setToSend(?int $toSend): CampaignModel
    {
        $this->toSend = $toSend;
        return $this;
    }

    public function getSent(): ?int
    {
        return $this->sent;
    }

    public function setSent(?int $sent): CampaignModel
    {
        $this->sent = $sent;
        return $this;
    }

    public function getFromEmail(): ?string
    {
        return $this->fromEmail;
    }

    public function setFromEmail(?string $fromEmail): CampaignModel
    {
        $this->fromEmail = $fromEmail;
        return $this;
    }

    public function getAltBody(): ?string
    {
        return $this->altBody;
    }

    public function setAltBody(?string $altBody): CampaignModel
    {
        $this->altBody = $altBody;
        return $this;
    }

    public function getSendAt(): ?DateTime
    {
        return $this->sendAt;
    }

    public function setSendAt(?DateTime $sendAt): CampaignModel
    {
        $this->sendAt = $sendAt;
        return $this;
    }

    public function getTemplateId(): ?int
    {
        return $this->templateId;
    }

    public function setTemplateId(?int $templateId): CampaignModel
    {
        $this->templateId = $templateId;
        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(?int $views): CampaignModel
    {
        $this->views = $views;
        return $this;
    }

    public function getClicks(): ?int
    {
        return $this->clicks;
    }

    public function setClicks(?int $clicks): CampaignModel
    {
        $this->clicks = $clicks;
        return $this;
    }

    public function getBounces(): ?int
    {
        return $this->bounces;
    }

    public function setBounces(?int $bounces): CampaignModel
    {
        $this->bounces = $bounces;
        return $this;
    }
}