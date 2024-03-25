<?php

declare(strict_types=1);

namespace TableDragon\Infrastructure\Persistence;

use TableDragon\Domain\Category\Category;
use TableDragon\Domain\Category\CategoryRepositoryInterface;

final class CategoryRepository extends DoctrineBaseRepository implements CategoryRepositoryInterface
{
    public static function getEntity(): string
    {
        return Category::class;
    }
}