<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Authenticate extends Middleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param string[] ...$guards
     * @return mixed|null
     */
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            $this->authenticate($request, $guards);
        } catch (Exception $exception) {
            return response()->json([
                'message' => __('auth.user.unauthorized')
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
