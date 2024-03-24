<?php

namespace TableDragon\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HealthController extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        return $this->json(['message' => 'TableDragon is up and running!']);
    }
}