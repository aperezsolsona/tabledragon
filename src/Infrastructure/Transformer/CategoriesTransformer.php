<?php

namespace TableDragon\Infrastructure\Transformer;

use TableDragon\Domain\Category\Category;

final class CategoriesTransformer
{
    public static function fromDomainToArray(array $categories): array
    {
        $categoriesTransformed = [];
        foreach ($categories as $category)
        {
            $categoriesTransformed[] = CategoryTransformer::fromDomainToArray($category);
        }

        return $categoriesTransformed;
    }
}