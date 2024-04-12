<?php

declare(strict_types=1);

namespace TableDragon\Infrastructure\Controller\Player;

use TableDragon\Application\Player\PlayerLister;
use TableDragon\Domain\Player\PlayerSearchCriteria;
use TableDragon\Infrastructure\Controller\PaginatedSuccessResponse;
use TableDragon\Infrastructure\Transformer\PlayersTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PlayerIndexController extends AbstractController
{
    public function __construct(
        private readonly PlayerLister $playerLister,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $responseDto = $this->playerLister->__invoke($this->getSearchCriteria($request));

        return new PaginatedSuccessResponse(
            PlayersTransformer::fromDomainToArray($responseDto->data),
            $responseDto->page,
            $responseDto->limit,
            $responseDto->totalResults
        );
    }

    private function getSearchCriteria(Request $request): PlayerSearchCriteria
    {
        $page = intval($request->query->get('page')) ? intval($request->query->get('page')) : null;
        $limit = intval($request->query->get('limit')) ? intval($request->query->get('limit')) : null;
        return new PlayerSearchCriteria(
            $request->query->get('keyword') ?? null,
                $page,
                $limit,
                $request->query->get('order_by') ?? null,
                $request->query->get('order_direction') ?? null
        );
    }
}