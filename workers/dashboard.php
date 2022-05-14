<?php

declare(strict_types=1);

use App\Controller\DashboardController;

/** @var \Slim\App $app */
$app = require __DIR__ . '/../bootstrap/bootstrap.php';

$app->get('/', DashboardController::class);

$app->run();
