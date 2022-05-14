<?php

declare(strict_types=1);

namespace App\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Slim\Psr7\Factory\RequestFactory;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\StreamFactory;

final class PsrProvider implements ServiceProviderInterface
{
    public function register(Container $pimple): void
    {
        $pimple[RequestFactoryInterface::class]  = static fn() => new RequestFactory();
        $pimple[StreamFactoryInterface::class]   = static fn() => new StreamFactory();
        $pimple[ResponseFactoryInterface::class] = static fn() => new ResponseFactory();
    }
}
