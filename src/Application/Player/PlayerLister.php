<?php

namespace TableDragon\Application\Player;

use TableDragon\Domain\Player\PlayerRepositoryInterface;

class PlayerLister
{
    public function __construct(
        public readonly PlayerRepositoryInterface $playerRepository
    ){}

    public function __invoke(array $filters): array
    {
        return $this->playerRepository->all();
    }
}