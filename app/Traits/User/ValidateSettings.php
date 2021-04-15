<?php

namespace App\Traits\User;

use App\Traits\Functions\DecodeJson;
use App\Traits\Functions\EncodeJson;
use Illuminate\Support\Arr;

trait ValidateSettings
{
    use DecodeJson,
        EncodeJson;

    private array $settingsFields = [
        'theme'  => [
            'light',
            'dark'
        ],
        'locale' => [
            'en',
            'de'
        ]
    ];

    /**
     * @param string $json
     * @param bool $shouldReturnJson
     * @return array|string|null
     */
    protected function validateSettingsJson(string $json, bool $shouldReturnJson = false)
    {
        return $this->validateSettings($this->decodeJson($json), $shouldReturnJson);
    }

    /**
     * @param array $settings
     * @param bool $shouldReturnJson
     * @return array|string|null
     */
    protected function validateSettings(array $settings, bool $shouldReturnJson = false)
    {
        $return = [];

        if (!Arr::has($settings, array_keys($this->settingsFields))) {
            foreach ($this->settingsFields as $key => $allowed) {
                $return[$key] = $allowed[0];
            }
            return $return;
        }

        foreach ($this->settingsFields as $key => $allowed) {
            if (in_array($settings[$key], $allowed)) {
                $return[$key] = $settings[$key];
            } else {
                $return[$key] = $allowed[0];
            }
        }

        if ($shouldReturnJson) {
            return $this->encodeJson($return);
        }
        return $return;
    }
}