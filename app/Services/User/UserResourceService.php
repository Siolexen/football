<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;

class UserResourceService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    /**
     * @param string $email
     * @return array|mixed
     */
    public function getUserByEmail(string $email): mixed
    {
        return $this->userRepository->getUserByEmail($email);
    }
}
