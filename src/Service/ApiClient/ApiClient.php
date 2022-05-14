<?php

declare(strict_types=1);

namespace App\Service\ApiClient;

interface ApiClient
{
    /**
     * @param  string  $symbol
     *
     * @return string
     */
    public function getRate(string $symbol): string;
}
