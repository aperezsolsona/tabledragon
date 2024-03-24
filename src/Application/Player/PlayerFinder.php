<?php

declare(strict_types=1);

namespace TableDragon\Application\Player;

use TableDragon\Domain\Player\Player;
use TableDragon\Domain\Player\PlayerRepositoryInterface;
use TableDragon\Domain\Player\Exception\PlayerNotFound;

final class PlayerFinder
{
    public function __construct(
        public readonly PlayerRepositoryInterface $playerRepository
    ){}

    public function __invoke(string $playerId): ?Player
    {
        /** @var Player $player */
        $player = $this->playerRepository->findOneBy(['id' => $playerId]);
        
        if (empty($player)) {
            throw new PlayerNotFound($playerId);
        }

        return $player;
    }
}