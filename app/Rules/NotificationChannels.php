<?php

namespace App\Rules;

use Exception;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class NotificationChannels implements Rule
{
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
            return true;
        }

        try {
            $decoded = json_decode($value, true, 512, JSON_THROW_ON_ERROR);
        } catch (Exception $exception) {
            return false;
        }

        if (empty($decoded)) {
            return true;
        }

        $keys = array_keys($decoded);

        if (count($keys) > env('MIX_SERVER_NOTIFICATION_CHANNEL_LIMIT')) {
            return false;
        }

        if (!array_filter($keys, 'is_int')) {
            return false;
        }

        foreach ($decoded as $channel) {
            if (!Arr::has($channel, ['notificationChannelTypeId', 'content'])) {
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
        return 'The notification channels are not valid.';
    }
}
