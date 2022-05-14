<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ApiClient\ApiClient;
use League\Plates\Engine as View;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\SimpleCache\CacheInterface;

final class DashboardController
{
    /** @var \Psr\Http\Message\ResponseFactoryInterface */
    private ResponseFactoryInterface $responseFactory;

    /** @var \Psr\Http\Message\StreamFactoryInterface */
    private StreamFactoryInterface $streamFactory;

    /** @var \Psr\SimpleCache\CacheInterface */
    private CacheInterface $cache;

    /** @var \App\Service\ApiClient\ApiClient */
    private ApiClient $apiClient;

    /** @var \League\Plates\Engine */
    private View $view;

    /**
     * @param  \Psr\Http\Message\ResponseFactoryInterface  $responseFactory
     * @param  \Psr\Http\Message\StreamFactoryInterface    $streamFactory
     * @param  \Psr\SimpleCache\CacheInterface             $cache
     * @param  \App\Service\ApiClient\ApiClient            $apiClient
     * @param  \League\Plates\Engine                       $view
     */
    public function __construct(
        ResponseFactoryInterface $responseFactory,
        StreamFactoryInterface $streamFactory,
        CacheInterface $cache,
        ApiClient $apiClient,
        View $view
    ) {
        $this->responseFactory = $responseFactory;
        $this->streamFactory   = $streamFactory;
        $this->cache           = $cache;
        $this->apiClient       = $apiClient;
        $this->view            = $view;
    }

    /**
     * @param  \Psr\Http\Message\ServerRequestInterface  $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $bag = [];

        if (isset($request->getQueryParams()['symbol'])) {
            $bag['rate'] = $this->apiClient->getRate($request->getQueryParams()['symbol']);
        }

        $bag['cached'] = $this->cache->get('rate', 'N/A');

        return $this->responseFactory
            ->createResponse()
            ->withBody($this->streamFactory->createStream($this->view->render('dashboard', $bag)));
    }
}
