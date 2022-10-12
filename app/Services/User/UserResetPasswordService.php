<?php

namespace App\Services\User;

use App\Models\User\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class UserResetPasswordService
{
    /**
     * @param $request
     * @return User|false
     */
    public function forgotPassword($request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function resetPassword($request) {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        return $status;
    }
}
