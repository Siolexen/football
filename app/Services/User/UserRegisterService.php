<?php

namespace App\Services\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Repositories\User\UserRepository;

class UserRegisterService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    /**
     * Rgister new User.
     *
     * @param mixed $data
     *
     * @return User
     *
     */
    public function register(array $data): User
    {
        $role = Role::where('name', Role::ROLE_USER)->first();
        $data['role_id'] = $role->id;

        $user = $this->userRepository->create($data);
       
        event(new Registered($user));
        return $user;
    }
}
