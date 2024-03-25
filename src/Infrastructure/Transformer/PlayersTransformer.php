<?php

namespace TableDragon\Infrastructure\Transformer;

final class PlayersTransformer
{
    public static function fromDomainToArray(array $players): array
    {
        $playersTransformed = [];
        foreach ($players as $player)
        {
            $playersTransformed[] = PlayerTransformer::fromDomainToArray($player);
        }

        return $playersTransformed;
    }
}