<?php

namespace TableDragon\Tests\Functional\Infrastructure\Controller\Player;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\Logger;
use TableDragon\Infrastructure\Persistence\CategoryRepository;
use TableDragon\Infrastructure\Persistence\Fixtures\PlayerFixtures;
use TableDragon\Infrastructure\Persistence\PlayerRepository;
use TableDragon\Tests\Functional\Infrastructure\Controller\BaseControllerTest;

class PlayerIndexControllerTest extends BaseControllerTest
{
    private PlayerFixtures $playerFixtures;

    public function setUp(): void
    {
        parent::setUp();

        $logger = $this->createMock(Logger::class);

        $playerRepository = new PlayerRepository($this->entityManager, $logger);
        $categoryRepository = new CategoryRepository($this->entityManager, $logger);

        // Load the fixtures
        $this->playerFixtures = new PlayerFixtures($playerRepository, $categoryRepository);
        $this->playerFixtures->load($this->entityManager);
    }

    public function test_index_players(): void
    {
        $result = $this->makeGETRequest('/players/');

        $response = json_decode($result->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($response);
        $this->assertIsArray($response['data']);
    }

    public function test_index_players_with_keyword_filter(): void
    {
        $result = $this->makeGETRequest('/players/?keyword=test');

        $response = json_decode($result->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($response);
        $this->assertIsArray($response['data']);
        // should return at least two players created in the fixtures:
        $this->assertGreaterThan(1, count($response['data']));
    }

    public function test_index_players_with_limit_filter(): void
    {
        $result = $this->makeGETRequest('/players/?limit=1');

        $response = json_decode($result->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($response);
        $this->assertIsArray($response['data']);
        $this->assertCount(1, $response['data']);

        $result = $this->makeGETRequest('/players/?limit=2');

        $response = json_decode($result->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($response['data']);
        $this->assertCount(2, $response['data']);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->playerFixtures->deleteFixture($this->entityManager);
    }
}