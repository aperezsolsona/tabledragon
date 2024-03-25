<?php

declare(strict_types=1);

namespace TableDragon\Infrastructure\Transformer;

use TableDragon\Domain\Player\Player;

final class PlayerTransformer
{

    public static function fromDomainToArray(Player $player): array
    {
        return [
            'id' => $player->id,
            'name' => $player->name,
            'surname' => $player->surname,
            'number' => $player->number,
            'category' => CategoryTransformer::fromDomainToArray($player->category)
        ];
    }
}