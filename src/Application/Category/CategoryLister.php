<?php

namespace TableDragon\Application\Category;

use TableDragon\Domain\Category\CategoryRepositoryInterface;

class CategoryLister
{
    public function __construct(
        public readonly CategoryRepositoryInterface $categoryRepository
    ){}

    public function __invoke(array $filters): array
    {
        return $this->categoryRepository->all();
    }
}