<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RequestInterval implements Rule
{
    protected int $min;
    protected int $max;

    public function __construct()
    {
        $this->min = config('servers.request_interval_min');
        $this->max = config('servers.request_interval_max');
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (!is_numeric($value)) {
            return false;
        }

        $val = (int)$value;
        if ($val < $this->min || $val > $this->max) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'The request interval must be between ' . $this->min . ' and ' . $this->max . '.';
    }
}
