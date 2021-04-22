<?php

namespace App\Rules;

use Exception;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class CustomLabels implements Rule
{
    protected array $allowedLabels = [
        'title',
        'subtitle',
        'text'
    ];

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (!$value) {
            return false;
        }

        try {
            $decoded = json_decode($value, true, 512, JSON_THROW_ON_ERROR);
        } catch (Exception $exception) {
            return false;
        }

        $keys = array_keys($decoded);
        if (array_diff($keys, $this->allowedLabels)) {
            return false;
        }

        foreach ($this->allowedLabels as $key) {
            if (Str::length($decoded[$key]) > config('servers.custom_labels.maxlength.' . $key)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The custom labels are not valid.';
    }
}
