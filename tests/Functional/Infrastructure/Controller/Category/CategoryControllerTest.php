<?php

namespace Functional\Infrastructure\Controller\Category;

use TableDragon\Tests\Functional\Infrastructure\Controller\BaseControllerTest;

class CategoryControllerTest extends BaseControllerTest
{
    public function test_index_categories(): void
    {
        $result = $this->makeGETRequest('/categories/');

        $response = json_decode($result->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($response);
        $this->assertCount(7, $response);
    }
}