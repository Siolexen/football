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

    /**
     * @param string $userUuid
     * @return array|mixed
     */
    public function getUserByUuid(string $userUuid): mixed
    {
        return $this->userRepository->getUserByUuid($userUuid);
    }

    /**
     * Get Users by specific options.
     *
     * @param array $options
     *
     * @return mixed
     *
     */
    public function getAllByOptions(array $options = [])
    {
        return $this->userRepository->getAllByOptions($options);
    }
}
