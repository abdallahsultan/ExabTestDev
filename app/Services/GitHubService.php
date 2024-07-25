<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GitHubService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.github.com/',
            'headers'  => [
                'Accept'     => 'application/vnd.github.v3+json',
                'User-Agent' => 'LaravelApp',
            ],
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function fetchRepositories($parameters): array
    {
        $response = $this->client->request('GET', 'search/repositories', [
            'query' => $parameters
        ]);

        $body = json_decode($response->getBody()->getContents(), true);

        return [
            'items' => $body['items'] ?? [],
            'total_count' => $body['total_count'] ?? 0,
        ];
    }
}
