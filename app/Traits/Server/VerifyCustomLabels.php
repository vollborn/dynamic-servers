<?php

namespace App\Traits\Server;

use App\Traits\Functions\DecodeJson;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait VerifyCustomLabels
{
    use DecodeJson;

    protected array $allowed = [
        'title',
        'subtitle',
        'text'
    ];

    /**
     * @param $data
     * @return array|null
     */
    protected function verifyCustomLabels($data): ?array
    {
        $decoded = $this->decodeJson($data['customLabels']);

        if (!Arr::has($decoded,'customLabels')) {
            return null;
        }

        if (!$this->validateDecodedLabels($decoded)) {
            return null;
        }

        return $this->mapLabels($decoded);
    }

    /**
     * @param array|null $labels
     * @return bool
     */
    protected function validateDecodedLabels(?array $labels): bool
    {
        if (!$labels) {
            return false;
        }

        if (!Arr::has($labels, $this->allowed)) {
            return false;
        }

        foreach ($this->allowed as $key) {
            if (Str::length($labels[$key]) > config('servers.custom_labels.maxlength.' . $key)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $decoded
     * @return array
     */
    protected function mapLabels(array $decoded): array
    {
        return [
            'title'    => $decoded['title'],
            'subtitle' => $decoded['subtitle'],
            'text'     => $decoded['text']
        ];
    }
}