<?php

declare(strict_types=1);

namespace PhalconLogAdapters\Services\External;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class LogglyClient
{
	public const BASE_URI = 'http://logs-01.loggly.com';

	/** @var ClientInterface */
	private $client;

	/** @var RequestFactoryInterface */
	private $requestFactory;

	/** @var StreamFactoryInterface */
	private $streamFactory;

	private $host;

	/** @var string */
	private $apiKey;

	public function __construct(
		string $apiKey,
		ClientInterface $client,
		RequestFactoryInterface $requestFactory,
		StreamFactoryInterface $streamFactory
	) {
		$this->apiKey         = $apiKey;
		$this->host           = gethostname();
		$this->client         = $client;
		$this->requestFactory = $requestFactory;
		$this->streamFactory  = $streamFactory;
	}

	public function loggly(string $tag, array $data): void
	{
		$request = $this->requestFactory->createRequest(
			'POST',
			"/inputs/{$this->apiKey}/tag/$tag"
		)->withHeader('Content-Type', 'application/json')
			->withBody(
				$this->streamFactory->createStream(
					json_encode(
						[
							'data'    => $data,
							'host'    => $this->host,
							'request' => $_REQUEST,
						]
					)
				)
			);

		$this->client->sendRequest($request);
	}
}
