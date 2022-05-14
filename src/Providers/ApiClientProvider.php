<?php

declare(strict_types=1);

namespace App\Providers;

use App\Service\ApiClient\ApiClient;
use App\Service\ApiClient\ApiClientImpl;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

final class ApiClientProvider implements ServiceProviderInterface
{
    public function register(Container $pimple): void
    {
        $pimple[ApiClient::class] = static fn(Container $c) => new ApiClientImpl();
    }
}
