<?php

namespace TableDragon\Domain\Player;

class PlayerSearchCriteria
{
    private ?string $keyword = null;
    private int $page = 1;
    private int $perPage = 10;
    private string $orderBy = 'number';
    private string $orderDirection = 'ASC';

    public function __construct(
        ?string $keyword = null,
        int $page = null,
        int $perPage = null,
        string $orderBy = null,
        string $orderDirection = null
    ) {
        if (!empty($keyword)){
            $this->keyword = $keyword;
        }
        if (!empty($page)){
            $this->page = $page;
        }
        if (!empty($perPage)){
            $this->perPage = $perPage;
        }
        if (!empty($orderBy)){
            $this->orderBy = $orderBy;
        }
        if (!empty($orderDirection)){
            $this->orderDirection = $orderDirection;
        }
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    public function getOrderDirection(): string
    {
        return $this->orderDirection;
    }
}