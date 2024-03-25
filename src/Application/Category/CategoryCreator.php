<?php

declare(strict_types=1);

namespace TableDragon\Application\Category;

use TableDragon\Domain\Category\Category;
use TableDragon\Domain\Category\CategoryRepositoryInterface;
use TableDragon\Infrastructure\Shared\Uuid;

final class CategoryCreator
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly Uuid $uuid
    ) {}

    public function __invoke(
        string $name,
        string $description,
    ): Category
    {
        $category = new Category($name, $description);
        $this->categoryRepository->saveObject($category);

        return $category;
    }
}