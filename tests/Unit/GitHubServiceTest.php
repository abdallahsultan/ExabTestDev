<?php

namespace Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use App\Services\GitHubService;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

class GitHubServiceTest extends TestCase
{
    private GitHubService $gitHubService;

    public function setUp(): void
    {
        $this->gitHubService = new GitHubService();
    }

    /**
     * Tests the fetchRepositories method.
     *
     * @return void
     * @throws GuzzleException
     */
    public function testFetchRepositoriesError(): void
    {
        $this->expectException(ClientException::class);
        $result = $this->gitHubService->fetchRepositories([]);
    }

    public function testFetchRepositoriesSuccess()
    {
        $parameters = [
            'q' => 'created:>2023-10-10',
            'per_page' => 10
        ];
        $result = $this->gitHubService->fetchRepositories($parameters);

        $this->assertArrayHasKey('items', $result);
        $this->assertArrayHasKey('total_count', $result);
        $this->assertCount($parameters['per_page'], $result['items'] );

        $parameters['per_page'] = 50;

        $result = $this->gitHubService->fetchRepositories($parameters);
        $this->assertCount($parameters['per_page'], $result['items'] );


    }
}
