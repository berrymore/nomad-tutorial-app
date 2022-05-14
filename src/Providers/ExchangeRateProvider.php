<?php

declare(strict_types=1);

namespace App\Providers;

use App\Service\ExchangeRate\ExchangeRate;
use App\Service\ExchangeRate\ExchangeRateImpl;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

final class ExchangeRateProvider implements ServiceProviderInterface
{
    public function register(Container $pimple): void
    {
        $pimple[ExchangeRate::class] = static fn() => new ExchangeRateImpl();
    }
}
