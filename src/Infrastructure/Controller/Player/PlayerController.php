<?php

declare(strict_types=1);

namespace TableDragon\Infrastructure\Controller\Player;

use Symfony\Component\HttpFoundation\Response;
use TableDragon\Application\Player\PlayerCreator;
use TableDragon\Application\Player\PlayerFinder;
use TableDragon\Application\Player\PlayerLister;
use TableDragon\Domain\Player\PlayerSearchCriteria;
use TableDragon\Infrastructure\Transformer\PlayerTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PlayerController extends AbstractController
{
    public function __construct(
        private readonly PlayerFinder $playerFinder,
        private readonly PlayerLister $playerLister,
        private readonly PlayerCreator $playerCreator,
    ) {}

    public function show(Request $request, string $player_id): JsonResponse
    {
        $player = $this->playerFinder->__invoke($player_id);

        return new JsonResponse(PlayerTransformer::fromDomainToArray($player));
    }

    public function index(Request $request): JsonResponse
    {
        return $this->playerLister->__invoke($this->getSearchCriteria($request));
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

    public function create(PlayerPostRequest $request): JsonResponse
    {
        $playerDTO = $request->getDTO();
        $player = $this->playerCreator->__invoke($playerDTO);

        return new JsonResponse(
            ['message' => 'Player '.$player->id.' was created successfully'],
            Response::HTTP_CREATED
        );
    }
}