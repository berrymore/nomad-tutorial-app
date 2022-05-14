<?php

error_reporting(E_ALL ^ E_DEPRECATED);

use Pimple\Container;
use Pimple\Psr11\Container as PsrContainer;
use Slim\Factory\AppFactory;
use Slim\Handlers\Strategies\RequestHandler;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();
$app       = AppFactory::createFromContainer(new PsrContainer($container));

foreach (include __DIR__ . '/providers.php' as $provider) {
    $container->register(new $provider());
}

$app->getRouteCollector()->setDefaultInvocationStrategy(new RequestHandler());

return $app;
