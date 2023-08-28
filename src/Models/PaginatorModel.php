<?php

namespace Junisan\ListmonkApi\Models;

class PaginatorModel
{
    /** @var SubscriberModel[]|ListModel[]|CampaignModel[] */
    private array $results;

    private int $total;
    private int $perPage;
    private int $page;

    public function __construct(array $results, int $total, int $perPage, int $page) {
        $this->results = $results;
        $this->total = $total;
        $this->perPage = $perPage;
        $this->page = $page;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getPage(): int
    {
        return $this->page;
    }
    public function getResults(): array
    {
        return $this->results;
    }

    public function hasNextPage(): bool
    {
        $maxPages = ceil($this->total / $this->perPage);
        return $this->page < $maxPages;
    }
}