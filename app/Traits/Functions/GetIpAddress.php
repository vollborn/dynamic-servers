<?php

namespace App\Traits\Functions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

trait GetIpAddress
{
    /**
     * @return string
     */
    protected function getIpAddress(): string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    /**
     * @param string $ip
     * @return string|null
     */
    protected function getIpAddressDetails(string $ip): ?string
    {
        if (env('APP_ENV') === 'local') {
            return null;
        }

        $client = new Client(['headers' => ['Accept' => 'application/json']]);
        try {
            $response = $client->request('GET', 'https://ipinfo.io/' . $ip);
            return $response->getBody()->getContents();
        } catch (GuzzleException $exception) {
            Log::error($exception);
        }

        return null;
    }
}
