<?php

namespace TableDragon\Tests\Integration\Infrastructure\Persistence;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\Log\Logger;
use TableDragon\Domain\Category\Category;
use TableDragon\Infrastructure\Persistence\CategoryRepository;

class CategoryRepositoryTest extends KernelTestCase
{
    protected CategoryRepository $categoryRepository;
    protected const TEST_CATEGORY_ID = 1; // category with id=1 exists after running fixture commands

    protected function setUp(): void
    {
        parent::setUp();

        /* Mocks */
        $kernel = self::bootKernel();
        $entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        $logger = $this->createMock(Logger::class);

        $this->categoryRepository = new CategoryRepository($entityManager, $logger);
    }

    public function test_find_categories(): void
    {
        $result = $this->categoryRepository->all();

        $this->assertEquals(self::TEST_CATEGORY_ID, $result[0]->id);
    }

    public function test_find_category_by_id(): void
    {
        /** @var Category $category */
        $category = $this->categoryRepository->findOneBy(['id' => self::TEST_CATEGORY_ID]);

        $this->assertEquals(self::TEST_CATEGORY_ID, $category->id);
    }
}