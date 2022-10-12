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
        return User::where('email', $email)->first();
    }

    /**
     * @param $userUuid
     * @return mixed
     */
    public function getUserByUuid(string $userUuid): mixed
    {
        return User::where('uuid', $userUuid)->first();
    }

    /**
     * Get Posts by specific options.
     *
     * @param array $options
     *
     * @return mixed
     *
     */
    public function getAllByOptions(array $options = []): mixed
    {
        $query = User::query();

        //PAGINATION
        return $query->paginate($options['perPage'] ?? 10);
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
        if (array_key_exists('name', $data)) {
            $user->name = $data['name'];
        }

        if (array_key_exists('email', $data)) {
            $user->email = $data['email'];
        }

        if (array_key_exists('password', $data)) {
            $user->password = Hash::make($data['password']);
        }

        if (array_key_exists('role_id', $data)) {
            $user->role_id = $data['role_id'];
        }

        if ($user->isDirty())
            $user->save();

        return $user;
    }

    /**
     * Delete User model.
     *
     * @param User $user
     *
     * @return bool
     *
     */
    public function delete(User $user): bool
    {
        $user->delete();
        return true;
    }
}
