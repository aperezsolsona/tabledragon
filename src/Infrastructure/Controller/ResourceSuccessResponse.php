<?php

namespace TableDragon\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResourceSuccessResponse extends JsonResponse
{
    public function __construct(
        mixed $data,
        int $status = Response::HTTP_OK
    ) {
        $response = [
            'metadata' => [
            ],
            'data' => $data,
        ];

        parent::__construct($response, $status);
    }
}