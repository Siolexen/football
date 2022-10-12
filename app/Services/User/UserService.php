<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    /**
     * Create $user model.
     *
     * @param array $data
     *
     * @return User
     *
     */
    public function create(array $data): User
    {
        return $this->userRepository->create($data);
    }

    /**
     * Update $user model.
     *
     * @param array $data
     * @param User $user
     *
     * @return User
     *
     */
    public function update(array $data, User $user): User
    {
        return $this->userRepository->update($data, $user);
    }

    /**
     * Delete $user model.
     *
     * @param User $user
     *
     * @return User
     *
     */
    public function delete(User $user)
    {
        return $this->userRepository->delete($user);
    }
}
