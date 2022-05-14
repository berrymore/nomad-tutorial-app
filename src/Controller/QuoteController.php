<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ExchangeRate\ExchangeRate;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\SimpleCache\CacheInterface;

final class QuoteController
{
    /** @var \Psr\Http\Message\ResponseFactoryInterface */
    private ResponseFactoryInterface $responseFactory;

    /** @var \Psr\Http\Message\StreamFactoryInterface */
    private StreamFactoryInterface $streamFactory;

    /** @var \App\Service\ExchangeRate\ExchangeRate */
    private ExchangeRate $exchangeRate;

    /** @var \Psr\SimpleCache\CacheInterface */
    private CacheInterface $cache;

    /**
     * @param  \Psr\Http\Message\ResponseFactoryInterface  $responseFactory
     * @param  \Psr\Http\Message\StreamFactoryInterface    $streamFactory
     * @param  \App\Service\ExchangeRate\ExchangeRate      $exchangeRate
     * @param  \Psr\SimpleCache\CacheInterface             $cache
     */
    public function __construct(
        ResponseFactoryInterface $responseFactory,
        StreamFactoryInterface $streamFactory,
        ExchangeRate $exchangeRate,
        CacheInterface $cache
    ) {
        $this->responseFactory = $responseFactory;
        $this->streamFactory   = $streamFactory;
        $this->exchangeRate    = $exchangeRate;
        $this->cache           = $cache;
    }

    /**
     * @param  \Psr\Http\Message\ServerRequestInterface  $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $rate = $this->exchangeRate->get('EUR', $request->getQueryParams()['symbol'] ?? 'RUB');

        $this->cache->set('rate', $rate);

        return $this->responseFactory
            ->createResponse()
            ->withBody($this->streamFactory->createStream($rate));
    }
}
