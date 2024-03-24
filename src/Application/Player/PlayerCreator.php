<?php

declare(strict_types=1);

namespace TableCreator\Application\Player;

use TableCreator\Domain\Player\Player;
use TableCreator\Domain\Player\PlayerRepositoryInterface;
use TableCreator\Infrastructure\Uuid;

final class PlayerCreator
{
    public function __construct(
        private readonly PlayerRepositoryInterface $playerRepository,
        private readonly Uuid $uuid
    ) {}

    public function __invoke(
        string $name,
        string $surname,
        string $number,
        int $category_id,
    ): Player
    {
        $newUuid = $this->uuid->makeUuid();
        $player = new Player($newUuid, $name, $surname, $number, $category_id);
        $this->playerRepository->saveObject($player);

        return $player;
    }
}