<?php

namespace TableDragon\Application\Player;

readonly class PlayerListerResponseDTO
{
    public function __construct(
        public array $data,
        public int   $page,
        public int   $limit,
        public int   $totalResults
    ){}
}