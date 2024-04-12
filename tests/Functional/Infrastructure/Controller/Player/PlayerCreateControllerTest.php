<?php

namespace TableDragon\Tests\Functional\Infrastructure\Controller\Player;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\Logger;
use TableDragon\Infrastructure\Persistence\CategoryRepository;
use TableDragon\Infrastructure\Persistence\Fixtures\PlayerFixtures;
use TableDragon\Infrastructure\Persistence\PlayerRepository;
use TableDragon\Tests\Functional\Infrastructure\Controller\BaseControllerTest;

class PlayerCreateControllerTest extends BaseControllerTest
{
    public function test_create_player(): void
    {
        $payload = json_decode($this->getTestFile('Player/player_post.json'));
        $result = $this->makePOSTRequest(
            '/players/',
            json_encode($payload)
        );

        $response = json_decode($result->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(201, $result->getStatusCode());
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

    /*
     * TODO Fix validation bypass
     * For some reason the symfony WebTestCase client is not resolving the PlayerCreateRequest used in this controller and thus bypassing validations
     *
     * public function test_create_player_fails_on_empty_name(): void
    {
        $payload = json_decode($this->getTestFile('Player/player_post.json'), true);
        $payload['name'] = '';
        $result = $this->makePOSTRequest(
            '/players/',
            json_encode($payload)
        );

        $response = json_decode($result->getContent(), true);
        $this->assertResponseStatusCodeSame(422);
        $this->assertArrayHasKey('errors', $response);

        $this->assertArrayHasKey('property', $response['errors'][0]);
        $this->assertArrayHasKey('value', $response['errors'][0]);
        $this->assertArrayHasKey('message', $response['errors'][0]);

        $this->assertEquals('name', $response['errors'][0]['property']);
        $this->assertEquals('Name field must not be empty', $response['errors'][0]['message']);
        $this->assertEquals('', $response['errors'][0]['value']);
    }

    public function test_create_player_fails_on_bad_params(): void
    {
        $payload = json_decode($this->getTestFile('Player/player_post.json'), true);
        $payload['category_id'] = -9; // negative category
        $result = $this->makePOSTRequest(
            '/players/',
            json_encode($payload)
        );

        $response = json_decode($result->getContent(), true);
        $this->assertResponseStatusCodeSame(422);
        $this->assertArrayHasKey('errors', $response);

        $this->assertArrayHasKey('property', $response['errors'][0]);
        $this->assertArrayHasKey('value', $response['errors'][0]);
        $this->assertArrayHasKey('message', $response['errors'][0]);

        $this->assertEquals('category_id', $response['errors'][0]['property']);
        $this->assertEquals('This value should be positive.', $response['errors'][0]['message']);
        $this->assertEquals(-9, $response['errors'][0]['value']);
    }*/
}