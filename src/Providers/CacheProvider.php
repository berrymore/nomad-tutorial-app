<?php

declare(strict_types=1);

namespace App\Providers;

use Memcached;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Psr\SimpleCache\CacheInterface;
use Sabre\Cache\Memcached as Cache;

final class CacheProvider implements ServiceProviderInterface
{
    public function register(Container $pimple): void
    {
        $pimple[CacheInterface::class] = static function () {
            $memcached = new Memcached();

            $memcached->addServer($_ENV['MEMCACHE_HOST'], (int) $_ENV['MEMCACHE_PORT']);

            return new Cache($memcached);
        };
    }
}
