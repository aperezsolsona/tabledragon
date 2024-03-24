<?php

declare(strict_types=1);

namespace TableDragon\Domain\Category;

interface CategoryRepositoryInterface
{
    public function findOneBy(array $criteria): ?object;

    public function findAll(): array;

    public function saveObject(Category $category): void;
}