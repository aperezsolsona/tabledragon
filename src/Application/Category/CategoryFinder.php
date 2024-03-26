<?php

namespace TableDragon\Application\Category;

use TableDragon\Domain\Category\Category;
use TableDragon\Domain\Category\CategoryRepositoryInterface;
use TableDragon\Domain\Category\Exception\CategoryNotFound;

class CategoryFinder
{
    public function __construct(
        public readonly CategoryRepositoryInterface $categoryRepository
    ){}

    public function __invoke(int $categoryId): ?Category
    {
        /** @var Category $player */
        $category = $this->categoryRepository->findOneBy(['id' => $categoryId]);
        if (empty($category)) {
            throw new CategoryNotFound($categoryId);
        }

        return $category;
    }
}