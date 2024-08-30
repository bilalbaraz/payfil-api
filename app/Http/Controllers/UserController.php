<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTokenRequest;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createToken(CreateTokenRequest $request)
    {
        $data = $request->validated();
        $user = $this->userService->getUserByEmail($data['email']);

        if (! $user || ! Hash::check($request->get('password'), $user->password)) {
            return ['success' => false, 'error' => 'Invalid credentials'];
        }

        $token = $this->userService->createTokenByUser($user, ['order:list', 'order:checkout'], Carbon::now()->addHour());

        return ['token' => $token->plainTextToken];
    }
}
