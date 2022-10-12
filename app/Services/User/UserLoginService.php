<?php

namespace App\Services\User;

/**
 * Class UserCreateTokenService
 * @package App\Services\User
 */
class UserLoginService
{
    /**
     * @param $user
     * @return mixed
     */
    public function createToken($user)
    {
        return $user->createToken('authToken')->plainTextToken;
    }
}
