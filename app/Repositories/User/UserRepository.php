<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail(string $email): mixed
    {
        return User::where('email', '=', $email)->first();
    }

    /**
     * Create User model with specific data.
     *
     * @param array $data
     *
     * @return User
     *
     */
    public function create(array $data): User
    {
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role_id = $data['role_id'];
        $user->save();

        return $user;
    }

    /**
     * Update $user model with specific data.
     *
     * @param array $data
     * @param User $user
     *
     * @return User
     *
     */
    public function update(array $data, User $user): User
    {
        if (isset($data['email'])) $user->email = $data['email'];

        if (array_key_exists('password', $data) && !empty($data['password']))
            $user->password = Hash::make($data['password']);

        if (isset($data['role_id'])) $user->role_id = $data['role_id'];

        if ($user->isDirty())
            $user->save();

        return $user;
    }
}
