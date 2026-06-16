<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function create(array $data): User
    {
        $user = User::create($data);
        return $user;
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
