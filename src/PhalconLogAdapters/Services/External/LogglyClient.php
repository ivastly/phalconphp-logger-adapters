<?php

namespace PhalconLogAdapters\Services\External;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class LogglyClient
{
    /** @var ClientInterface */
    private $client;

    private $host;

    /** @var string */
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;

        $this->client = new Client([
                                       'base_uri' => 'http://logs-01.loggly.com',
                                       'timeout'  => 5, // small timeout for non-critical loggly processing
                                   ]
        );

        $this->host = gethostname();
    }

    public function loggly(string $tag, array $data)
    {
        try {
            $response = $this->client->request('POST',
                                               "/inputs/{$this->apiKey}/tag/$tag", [
                                                   'json' => [
                                                       'data'    => $data,
                                                       'host'    => $this->host,
                                                       'request' => $_REQUEST,
                                                   ],
                                               ]
            );
        } catch (GuzzleException $e) {
            // ignore guzzle errors here
        }
    }
}
