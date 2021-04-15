<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * @return JsonResponse|Response
     */
    public function login()
    {
        $data = request()->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if (!Auth::attempt($data)) {
            return response(null, Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        Log::error($user);

        if ($user->disabled_at) {
            return response()->json([
                'message' => __('auth.user.disabled')
            ], Response::HTTP_CONFLICT);
        }

        $user->forceFill([
            'api_token' => Str::random(80)
        ]);
        $user->save();

        return response()->json([
            'user' => new AuthResource($user)
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function getAuth(): JsonResponse
    {
        return response()->json([
            'user' => new AuthResource(Auth::user())
        ]);
    }

    /**
     * @return Response
     */
    public function logout(): Response
    {
        $user = Auth::user();
        $user->forceFill([
            'api_token' => null
        ]);
        $user->save();

        return response(null, Response::HTTP_OK);
    }
}