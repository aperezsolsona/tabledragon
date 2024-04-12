<?php

namespace TableDragon\Application\Player;

use TableDragon\Domain\Player\PlayerRepositoryInterface;
use TableDragon\Domain\Player\PlayerSearchCriteria;

readonly class PlayerLister
{
    public function __construct(
        public PlayerRepositoryInterface $playerRepository
    ){}

    public function __invoke(PlayerSearchCriteria $criteria): PlayerListerResponseDTO
    {
        $players = $this->playerRepository->search($criteria);
        $totalResults = $this->playerRepository->totalResults($criteria);

        return new PlayerListerResponseDTO(
            $players,
            $criteria->getPage(),
            $criteria->getPerPage(),
            $totalResults
        );
    }
}