<?php

declare(strict_types=1);

namespace TableDragon\Application\Player;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use TableDragon\Application\Category\CategoryFinder;
use TableDragon\Domain\Player\Event\PlayerCreated;
use TableDragon\Domain\Player\Player;
use TableDragon\Domain\Player\PlayerRepositoryInterface;
use TableDragon\Infrastructure\Shared\Uuid;

final readonly class PlayerCreator
{
    public function __construct(
        private PlayerRepositoryInterface $playerRepository,
        private CategoryFinder            $categoryFinder,
        private Uuid                      $uuid,
        private EventDispatcherInterface  $dispatcher
    ) {}

    public function __invoke(PlayerDTO $playerDTO): Player
    {
        $category = $this->categoryFinder->__invoke($playerDTO->categoryId);
        $newUuid = $this->uuid->makeUuid();
        $player = new Player($newUuid, $playerDTO->name, $playerDTO->surname, $playerDTO->number, $category);
        $this->playerRepository->saveObject($player);

        $this->dispatcher->dispatch(new PlayerCreated($player->id));

        return $player;
    }
}