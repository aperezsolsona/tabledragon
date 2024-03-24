<?php

declare(strict_types=1);

namespace TableDragon\Infrastructure\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use TableDragon\Domain\DomainError;
use TableDragon\Domain\Player\PlayerNotFound;

final class ExceptionListener
{
    private const DEFAULT_HTTP_ERROR_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;

    private const CUSTOM_HTTP_ERROR_CODES = [
        PlayerNotFound::class          => Response::HTTP_NOT_FOUND,
    ];

    public function onException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $request   = $event->getRequest();

        if ($exception instanceof DomainError) {
            $event->setResponse(
                new JsonResponse(
                    ['error' => $exception->getMessage()], 
                    self::statusCodeFor(get_class($exception))
                )
            );
        }
    }

    public static function statusCodeFor(string $exceptionClass): int
    {
        return self::CUSTOM_HTTP_ERROR_CODES[$exceptionClass] ?? self::DEFAULT_HTTP_ERROR_CODE;
    }
}
