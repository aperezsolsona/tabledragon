<?php

declare(strict_types=1);

namespace TableDragon\Infrastructure\Controller\Player;

use TableDragon\Application\Player\PlayerFinder;
use TableDragon\Infrastructure\Controller\ResourceSuccessResponse;
use TableDragon\Infrastructure\Transformer\PlayerTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PlayerShowController extends AbstractController
{
    public function __construct(
        private readonly PlayerFinder $playerFinder,
    ) {}

    public function __invoke(Request $request, string $player_id): JsonResponse
    {
        $player = $this->playerFinder->__invoke($player_id);

        return new ResourceSuccessResponse(PlayerTransformer::fromDomainToArray($player));
    }
}