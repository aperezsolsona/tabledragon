<?php

declare(strict_types=1);

namespace TableDragon\Infrastructure\Controller\Player;

use TableDragon\Application\Player\PlayerFinder;
use TableDragon\Domain\Player\Player;
use TableDragon\Infrastructure\Transformer\PlayerTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PlayerController extends AbstractController
{
    public function __construct(
        private readonly PlayerFinder $playerFinder
    ) {}

    public function show(Request $request, string $player_id): JsonResponse
    {
        $player = $this->playerFinder->__invoke($player_id);

        return new JsonResponse(PlayerTransformer::fromDomainToArray($player));
    }
}