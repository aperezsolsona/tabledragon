<?php

namespace TableDragon\Tests\Functional\Infrastructure\Controller;

use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use TableDragon\Kernel;

abstract class BaseControllerTest extends WebTestCase
{
    protected KernelBrowser $client;

    protected ObjectManager $entityManager;

    public function setUp(): void
    {
        parent::setUp();

        self::ensureKernelShutdown();
        $this->client = static::createClient();

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    protected function makeGETRequest(string $path): Response
    {
        $this->client->request('GET', $path, [], [], [
            'CONTENT_TYPE' => 'application/json',
        ]);

        return $this->client->getResponse();
    }

    protected function makePOSTRequest(
        string $path,
               $params
    ): Response {
        $params = is_array($params) ? json_encode($params) : $params;
        $this->client->request('POST', $path, [], [], ['CONTENT_TYPE' => 'application/json'], $params);

        return $this->client->getResponse();
    }

    protected function shouldResponseSuccess(Response $response, int $statusCode = Response::HTTP_OK): void
    {
        $this->assertResponseIsSuccessful();
        $this->assertEquals($statusCode, $response->getStatusCode());
    }

    protected function getTestFile($path): ?string
    {
        return file_get_contents(Kernel::getRootProjectDir()."/tests/Assets/$path");
    }
}