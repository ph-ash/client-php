# client-php
Client library for pushing data to a Phash instance

It is designed to use either a PSR-7/PSR-17/PSR-18 compatible library or Guzzle.

# Configuration

## Symfony

Add a service definition with the configuration to your application.

* PSR version:

```yaml
    _defaults:
        autowire: true

    Phash\Client:
        class: Phash\ClientPSR
        arguments:
            $baseUri: "http://localhost"
            $apiToken: "someToken"
```

* Guzzle version:

```yaml
    _defaults:
        autowire: true

    GuzzleHttp\Client:
        class: GuzzleHttp\Client
        arguments:
            $config:
                base_uri: "http://localhost"

    Phash\Client:
        class: Phash\ClientGuzzle
        arguments:
            $apiToken: "someToken"
```

## Plain PHP

Instantiate the client class and pass the configuration as parameters:

* PSR version:

```php
    $requestFactory = ...; // instanceof Psr\Http\Message\RequestFactoryInterface
    $uriFactory = ...; // instanceof Psr\Http\Message\UriFactoryInterface
    $streamFactory = ...; // instanceof Psr\Http\Message\StreamFactoryInterface
    $client = ...; // instanceof Psr\Http\Client\ClientInterface
    $client = new Phash\ClientPSR('http://localhost', 'someToken', $requestFactory, $uriFactory, $streamFactory, $client);
```

* Guzzle version:

```php
    $guzzleClient = new GuzzleHttp\Client(['base_uri' => 'http://localhost']);
    $client = new Phash\ClientGuzzle('someToken', $guzzleClient);
```

# Usage

* Create a DTO (see [the payload documentation](https://github.com/ph-ash/documentation#payload-format)):

```php
    $data = new Phash\MonitoringData(
        'monitoring id',
        'ok',
        'this detail message will be displayed if a tile is clicked by a user',
        60,
        1,
        new \DateTimeImmutable(),
        'path.for.tree' // can be `null` for a flat display
    );

    // optional data
    $data->setTileExpansionIntervalCount(2);
    $data->setTileExpansionGrowthExpression('+ 4');
```

* Push data to the server:

```php
    $client->push($data);
```
