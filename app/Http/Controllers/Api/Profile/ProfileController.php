<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Traits\User\ValidateSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use ValidateSettings;

    /**
     * @return UserResource
     */
    public function show(): UserResource
    {
        return new UserResource(Auth::user());
    }

    /**
     * @return JsonResponse
     */
    public function update(): JsonResponse
    {
        $data = request()->validate([
            'firstName'  => 'required|string|max:255',
            'lastName'   => 'required|string|max:255',
            'settings'   => 'required|json',
            'password'   => 'nullable|string'
        ]);

        $user = Auth::user();
        $user->first_name = $data['firstName'];
        $user->last_name = $data['lastName'];
        $user->settings = $this->validateSettingsJson($data['settings'], true);

        if (Arr::has($data, 'password') && $data['password']) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return $this->json(__('controllers.profile.updated'));
    }
}