<?php

namespace TableDragon\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PaginatedSuccessResponse extends JsonResponse
{
    public function __construct(
        mixed $data,
        int $page,
        int $limit,
        int $totalResults,
        int $status = Response::HTTP_OK
    ) {
        $response = [
            'metadata' => [
                'page' => $page,
                'limit' => $limit,
                'total_results' => $totalResults,
            ],
            'data' => $data,
        ];

        parent::__construct($response, $status);
    }
}