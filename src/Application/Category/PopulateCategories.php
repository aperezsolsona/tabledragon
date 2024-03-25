<?php

namespace TableDragon\Application\Category;

use TableDragon\Domain\Category\Category;
use TableDragon\Domain\Category\CategoryRepositoryInterface;

class PopulateCategories
{
    private const TABLEDRAGON_CATEGORIES = [
        [
            'name' => '0*',
            'description' => 'Absolute Beginners or category undefined',
        ],
        [
            'name' => '1*',
            'description' => 'Absolute Beginners',
        ],
        [
            'name' => '2*',
            'description' => 'Beginners with some level',
        ],
        [
            'name' => '2+*',
            'description' => 'Beginner/Intermediate Level',
        ],
        [
            'name' => '3*',
            'description' => 'Intermediate Level',
        ],
        [
            'name' => '4*',
            'description' => 'Intermediate/Advanced Level',
        ],
        [
            'name' => '5*',
            'description' => 'Advance/Pro Level',
        ],
    ];

    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository
    ){}

    public function __invoke(): void
    {
        $categories = self::TABLEDRAGON_CATEGORIES;
        array_walk($categories, function (array $category) {
            $categoryObj = new Category($category['name'], $category['description']);
            $this->categoryRepository->saveObject($categoryObj);
        });
    }
}