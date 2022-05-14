<?php

declare(strict_types=1);

namespace App\Providers;

use App\Controller\DashboardController;
use App\Controller\QuoteController;
use App\Service\ApiClient\ApiClient;
use App\Service\ExchangeRate\ExchangeRate;
use League\Plates\Engine as View;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\SimpleCache\CacheInterface;

final class ControllerProvider implements ServiceProviderInterface
{
    public function register(Container $pimple): void
    {
        $pimple[QuoteController::class] = static fn(Container $c) => new QuoteController(
            $c[ResponseFactoryInterface::class],
            $c[StreamFactoryInterface::class],
            $c[ExchangeRate::class],
            $c[CacheInterface::class]
        );

        $pimple[DashboardController::class] = static fn(Container $c) => new DashboardController(
            $c[ResponseFactoryInterface::class],
            $c[StreamFactoryInterface::class],
            $c[CacheInterface::class],
            $c[ApiClient::class],
            $c[View::class]
        );
    }
}
