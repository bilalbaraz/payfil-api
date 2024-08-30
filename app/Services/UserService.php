<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Laravel\Sanctum\NewAccessToken;

class UserService
{
    private User $user;

    private Carbon $carbon;

    /**
     * @param User $user
     * @param Carbon $carbon
     */
    public function __construct(User $user, Carbon $carbon)
    {
        $this->user = $user;
        $this->carbon = $carbon;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User
    {
        return $this->user->where('email', $email)->first();
    }

    /**
     * @param User $user
     * @param array $abilities
     * @param Carbon $expiresAt
     * @return NewAccessToken
     */
    public function createTokenByUser(User $user, array $abilities, Carbon $expiresAt): NewAccessToken
    {
        return $user->createToken('token_'.$this->carbon::now()->format('dmY'), $abilities, $expiresAt);
    }
}
