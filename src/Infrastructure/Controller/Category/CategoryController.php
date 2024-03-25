<?php

namespace TableDragon\Infrastructure\Controller\Category;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use TableDragon\Application\Category\CategoryLister;
use TableDragon\Infrastructure\Transformer\CategoriesTransformer;

class CategoryController extends AbstractController
{
    public function __construct(
        private readonly CategoryLister $categoryLister
    ) {}

    public function index(Request $request): JsonResponse
    {
        $categories = $this->categoryLister->__invoke($this->parseFilters($request));

        return new JsonResponse(CategoriesTransformer::fromDomainToArray($categories));
    }

    private function parseFilters(Request $request)
    {
        // todo implement pagination, limit...
        return [];
    }
}