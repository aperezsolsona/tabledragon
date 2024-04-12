<?php

declare(strict_types=1);

namespace TableDragon\Infrastructure\Controller\Player;

use Symfony\Component\HttpFoundation\Response;
use TableDragon\Application\Player\PlayerCreator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PlayerCreateController extends AbstractController
{
    public function __construct(
        private readonly PlayerCreator $playerCreator,
    ) {}

    public function __invoke(PlayerCreateRequest $request): JsonResponse
    {
        $playerDTO = $request->getDTO();
        $player = $this->playerCreator->__invoke($playerDTO);

        return new JsonResponse(
            ['message' => 'Player '.$player->id.' was created successfully'],
            Response::HTTP_CREATED
        );
    }
}