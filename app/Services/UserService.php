<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Laravel\Sanctum\NewAccessToken;

class UserService
{
    private User $user;
    private Carbon $carbon;

    public function __construct(User $user, Carbon $carbon)
    {
        $this->user = $user;
        $this->carbon = $carbon;
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->user->where('email', $email)->first();
    }

    public function createTokenByUser(User $user, array $abilities, Carbon $expiresAt): NewAccessToken
    {
        return $user->createToken('token_' . $this->carbon::now()->format('dmY'), $abilities, $expiresAt);
    }
}
