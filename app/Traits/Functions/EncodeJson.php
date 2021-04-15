<?php

namespace App\Traits\Functions;

use Exception;
use Illuminate\Support\Facades\Log;

trait EncodeJson
{
    /**
     * @param array|null $array
     * @return string|null
     */
    protected function encodeJson(?array $array): ?string
    {
        if (!$array) {
            return null;
        }

        try {
            return json_encode($array, JSON_THROW_ON_ERROR) ?: null;
        } catch (Exception $exception) {
            Log::error($exception);
            return null;
        }
    }
}