<?php

declare(strict_types=1);

namespace App\Providers;

use League\Plates\Engine;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

final class PlatesProvider implements ServiceProviderInterface
{
    public function register(Container $pimple): void
    {
        $pimple[Engine::class] = static fn() => new Engine(__DIR__ . '/../../resources/templates');
    }
}
