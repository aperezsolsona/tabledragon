<?php

namespace TableDragon\Tests\Functional\Infrastructure\Controller\Player;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\Logger;
use TableDragon\Infrastructure\Persistence\CategoryRepository;
use TableDragon\Infrastructure\Persistence\Fixtures\PlayerFixtures;
use TableDragon\Infrastructure\Persistence\PlayerRepository;
use TableDragon\Tests\Functional\Infrastructure\Controller\BaseControllerTest;

class PlayerControllerTest extends BaseControllerTest
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
    }

    public function test_show_players(): void
    {
        $result = $this->makeGETRequest('/players/962f24fc-36e0-4b9d-8ff7-09450a45b767');

        $response = json_decode($result->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($response);
        $this->assertEquals('TestName1', $response['name']);
        $this->assertEquals('TestSurname1', $response['surname']);
        $this->assertEquals('P1234', $response['number']);
    }
    public function test_create_player(): void
    {
        $payload = json_decode($this->getTestFile('Player/player_post.json'));
        $result = $this->makePOSTRequest(
            '/players/',
            json_encode($payload)
        );

        $response = json_decode($result->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(200, $result->getStatusCode());
    }

    public function test_create_player_fails_on_bad_category(): void
    {
        $payload = json_decode($this->getTestFile('Player/player_post.json'), true);
        $payload['category_id'] = 99999; // nonexistent category in initial fixtures, setting 99999 for test safety space
        $result = $this->makePOSTRequest(
            '/players/',
            json_encode($payload)
        );

        $response = json_decode($result->getContent(), true);
        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
        $this->assertArrayHasKey('error', $response);
        $this->assertStringContainsString('The category with id ', $response['error']);
        $this->assertStringContainsString(' was not found', $response['error']);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->playerFixtures->deleteFixture($this->entityManager);
    }
}