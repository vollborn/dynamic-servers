<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Locale
{
    protected array $allowedLocales = [
        'en',
        'de'
    ];

    /**
     * @param Request $request
     * @param $next
     * @return mixed
     */
    public function handle(Request $request, $next)
    {
        $locale = $request->header('Accept-Language');

        if ($locale) {
            if ($this->checkAllowed($locale)) {
                App::setLocale($locale);
            } elseif (Str::contains($locale, ',')) {
                $exploded = explode(',', $locale);
                if ($this->checkAllowed($exploded[0])) {
                    App::setLocale($exploded[0]);
                }
            }
        }

        return $next($request);
    }

    /**
     * @param string $locale
     * @return bool
     */
    protected function checkAllowed(string $locale): bool
    {
        return in_array($locale, $this->allowedLocales, true);
    }
}