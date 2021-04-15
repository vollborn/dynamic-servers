<?php

namespace App\Rules;

use App\Models\NotificationChannel;
use Illuminate\Contracts\Validation\Rule;

class NotificationChannelType implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return in_array((int) $value, NotificationChannel::getAvailable(), true);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'This notification channel type does not exist.';
    }
}
