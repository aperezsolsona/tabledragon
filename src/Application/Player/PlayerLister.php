<?php

namespace TableDragon\Application\Player;

use TableDragon\Domain\Player\PlayerRepositoryInterface;
use TableDragon\Domain\Player\PlayerSearchCriteria;
use TableDragon\Infrastructure\Controller\PaginatedSuccessResponse;
use TableDragon\Infrastructure\Transformer\PlayersTransformer;

readonly class PlayerLister
{
    public function __construct(
        public PlayerRepositoryInterface $playerRepository
    ){}

    public function __invoke(PlayerSearchCriteria $criteria): PaginatedSuccessResponse
    {
        $data = $this->playerRepository->search($criteria);
        $totalResults = $this->playerRepository->totalResults($criteria);

        return new PaginatedSuccessResponse(
            PlayersTransformer::fromDomainToArray($data),
            $criteria->getPage(),
            $criteria->getPerPage(),
            $totalResults
        );
    }
}