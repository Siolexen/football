<?php

namespace App\Services\User;

class UserVerifyEmailService
{
    /**
     * @param $data
     * @param $user
     *
     * @return false|mixed
     */
    public function verifyEmail($data, $user): mixed
    {
        if (sha1($user->email) == $data['hash'] && $data['expires'] > now()->timestamp) {
            return $user->markEmailAsVerified();
        }

        return false;
    }
}
