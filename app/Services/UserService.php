<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class UserService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->user->where('email', $email)->first();
    }

    public function createTokenByUser(User $user, array $abilities, Carbon $expiresAt)
    {
        return $user->createToken('personal_access_token', $abilities, $expiresAt);
    }
}
