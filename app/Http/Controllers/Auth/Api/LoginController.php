<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\AuthController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\Traits\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

class LoginController extends AuthController
{
    use AuthenticatesUsers;

    /**
     * Handle a login request to the application.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(LoginRequest $request)
    {
        $token = $this->attemptLogin($this->credentials($request), false, true);
        if (!$token) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param $token
     *
     * @return \App\Http\Resources\UserResource
     */
    protected function respondWithToken($token)
    {
        $user = $this->guard()->user();

        if (empty($user)) {
            abort(401);
        }

        return (new UserResource($user))
            ->withToken($token, $this->guard()->factory()->getTTL() * config('jwt.refresh_ttl'));
    }
}
