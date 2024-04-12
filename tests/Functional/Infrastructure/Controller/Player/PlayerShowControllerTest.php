<?php

namespace TableDragon\Tests\Functional\Infrastructure\Controller\Player;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\Logger;
use TableDragon\Infrastructure\Persistence\CategoryRepository;
use TableDragon\Infrastructure\Persistence\Fixtures\PlayerFixtures;
use TableDragon\Infrastructure\Persistence\PlayerRepository;
use TableDragon\Tests\Functional\Infrastructure\Controller\BaseControllerTest;

class PlayerShowControllerTest extends BaseControllerTest
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

    public function test_show_players(): void
    {
        $result = $this->makeGETRequest('/players/962f24fc-36e0-4b9d-8ff7-09450a45b767');

        $response = json_decode($result->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($response);
        $this->assertIsArray($response['data']);
        $this->assertEquals('TestName1', $response['data']['name']);
        $this->assertEquals('TestSurname1', $response['data']['surname']);
        $this->assertEquals('P1234', $response['data']['number']);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->playerFixtures->deleteFixture($this->entityManager);
    }
}