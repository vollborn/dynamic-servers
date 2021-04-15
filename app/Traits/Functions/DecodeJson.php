<?php

namespace App\Traits\Functions;

use Exception;
use Illuminate\Support\Facades\Log;

trait DecodeJson
{
    protected function decodeJson($json)
    {
        if (!$json) {
            return null;
        }

        try {
            return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (Exception $exception) {
            Log::error($exception);
            return null;
        }
    }
}