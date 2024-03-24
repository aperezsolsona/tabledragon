<?php

declare(strict_types=1);

namespace TableDragon\Infrastructure\Persistence;

use TableDragon\Domain\Player\Player;
use TableDragon\Domain\Player\PlayerRepositoryInterface;

final class PlayerRepository extends DoctrineBaseRepository implements PlayerRepositoryInterface
{

    public static function getEntity(): string
    {
        return Player::class;
    }
}