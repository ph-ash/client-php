<?php

declare(strict_types=1);

namespace Phash;

use Exception;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use RuntimeException;

class ClientImplementation implements Client
{
    private $apiUri;
    private $apiToken;
    private $requestFactory;
    private $client;
    private $streamFactory;

    /**
     * @throws Exception
     */
    public function __construct(
        string $baseUri,
        string $apiToken,
        RequestFactoryInterface $requestFactory,
        UriFactoryInterface $uriFactory,
        StreamFactoryInterface $streamFactory,
        ClientInterface $client
    ) {
        $this->apiToken = sprintf('Bearer %s', $apiToken);
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->client = $client;

        $this->apiUri = $uriFactory->createUri(sprintf('%s/api/monitoring/data', $baseUri));
    }

    public function push(MonitoringData $monitoringData): void
    {
        $request = $this->requestFactory->createRequest('POST', $this->apiUri)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->withHeader('Authorization', $this->apiToken)
            ->withBody($this->streamFactory->createStream(json_encode($monitoringData)));

        try {
            $response = $this->client->sendRequest($request);

            if ($response->getStatusCode() !== 201) {
                throw new RuntimeException(
                    sprintf(
                        'server did respond with a failure: HTTP %d / %s',
                        $response->getStatusCode(),
                        $response->getBody()->getContents()
                    )
                );
            }
        } catch (ClientExceptionInterface $exception) {
            throw new RuntimeException($exception->getMessage(), 0, $exception);
        }
    }
}
