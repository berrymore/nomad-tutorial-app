<?php

declare(strict_types=1);

namespace App\Service\ExchangeRate;

class ExchangeRateImpl implements ExchangeRate
{
    private const URL = 'https://api.exchangerate.host/latest';

    /**
     * @throws \JsonException
     */
    public function get(string $base, string $symbol): string
    {
        $response = file_get_contents(sprintf('%s?base=%s&symbols=%s', self::URL, $base, $symbol));
        $data     = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        if (isset($data['success'], $data['rates'][$symbol])) {
            return (string) $data['rates'][$symbol];
        }

        return 'N/A';
    }
}
