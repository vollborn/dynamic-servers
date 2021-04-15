<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserDisabled
{
    public function handle(Request $request, $next)
    {
        $user = Auth::user();
        if ($user && $user->disabled_at) {
            return response()->json([
                'message' => __('auth.user.disabled')
            ], Response::HTTP_CONFLICT);
        }

        return $next($request);
    }
}