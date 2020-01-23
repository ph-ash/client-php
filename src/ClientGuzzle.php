<?php

declare(strict_types=1);

namespace Phash;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use RuntimeException;

class ClientGuzzle implements Client
{
    private $apiToken;
    private $client;

    public function __construct(string $apiToken, GuzzleClient $client)
    {
        $this->apiToken = $apiToken;
        $this->client = $client;
    }

    public function push(MonitoringData $monitoringData): void
    {
        $options = [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'Authorization' => $this->apiToken
            ],
            RequestOptions::JSON => $monitoringData
        ];

        try {
            $response = $this->client->post(self::API_URI, $options);

            if ($response->getStatusCode() !== 201) {
                throw new RuntimeException(
                    sprintf(
                        'server did respond with a failure: HTTP %d / %s',
                        $response->getStatusCode(),
                        $response->getBody()->getContents()
                    )
                );
            }
        } catch (GuzzleException $exception) {
            throw new RuntimeException($exception->getMessage(), 0, $exception);
        }
    }
}
