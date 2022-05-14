<?php

declare(strict_types=1);

namespace App\Service\ExchangeRate;

interface ExchangeRate
{
    /**
     * @param  string  $base
     * @param  string  $symbol
     *
     * @return string
     */
    public function get(string $base, string $symbol): string;
}
