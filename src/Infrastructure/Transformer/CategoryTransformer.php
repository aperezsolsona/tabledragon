<?php

namespace TableDragon\Infrastructure\Transformer;

use TableDragon\Domain\Category\Category;

final class CategoryTransformer
{
    public static function fromDomainToArray(Category $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'description' => $category->description
        ];
    }
}