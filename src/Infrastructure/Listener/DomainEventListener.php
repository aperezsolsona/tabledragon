<?php

namespace TableDragon\Infrastructure\Listener;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\EventDispatcher\Event;
use TableDragon\Domain\Player\Event\PlayerCreated;

class DomainEventListener implements EventSubscriberInterface
{
    public function __construct(private readonly LoggerInterface $logger){}

    public static function getSubscribedEvents(): array
    {
        return [
            PlayerCreated::class => 'onPlayerCreated',
        ];
    }

    public function onPlayerCreated(PlayerCreated $event): void
    {
        $this->logEvent("A new player was created with id ".$event->id, $event);
    }

    private function logEvent(string $message, Event $event)
    {
        $this->logger->info($this->getClassName($event)." handled: ".$message);
    }

    private function getClassName(Event $event):string
    {
        $namespace = explode("\\", $event::class);
        return end($namespace);
    }
}