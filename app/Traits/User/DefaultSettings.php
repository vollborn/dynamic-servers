<?php

namespace App\Traits\User;

trait DefaultSettings
{
    /**
     * @var array|\string[][]
     */
    private array $settingsFields = [
        'theme'  => [
            'dark',
            'light'
        ],
        'locale' => [
            'en',
            'de'
        ]
    ];

    /**
     * @return array
     */
    protected function getSettingsFields(): array
    {
        return $this->settingsFields;
    }

    /**
     * @return array
     */
    protected function getDefaultSettings(): array
    {
        $return = [];
        foreach ($this->settingsFields as $index => $value) {
            $return[$index] = $value[0];
        }
        return $return;
    }
}