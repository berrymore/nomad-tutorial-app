<?php

declare(strict_types=1);

namespace App\Service\ApiClient;

class ApiClientImpl implements ApiClient
{
    public function getRate(string $symbol): string
    {
        return file_get_contents(sprintf('http://%s:%s/quote?symbol=%s', $_ENV['API_HOST'], $_ENV['API_PORT'], $symbol));
    }
}
