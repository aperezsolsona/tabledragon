<?php

namespace TableDragon\Domain\Player\Event;

use TableDragon\Domain\DomainEvent;

class PlayerCreated extends DomainEvent
{
    public function __construct(public readonly string $id){}
}