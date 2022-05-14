<?php

declare(strict_types=1);

use App\Controller\QuoteController;

/** @var \Slim\App $app */
$app = require __DIR__ . '/../bootstrap/bootstrap.php';

$app->get('/quote', QuoteController::class);

$app->run();
