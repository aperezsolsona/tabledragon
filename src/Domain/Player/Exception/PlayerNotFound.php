<?php

declare(strict_types=1);

namespace TableDragon\Domain\Player\Exception;

use TableDragon\Domain\DomainError;

final class PlayerNotFound extends DomainError
{
    private string $playerId;

    public function __construct(string $playerId)
    {
        $this->playerId = $playerId;
        parent::__construct();
    }

    protected function errorMessage(): string
    {
        return sprintf('The player <%s> was not found', $this->playerId);
    }
}
