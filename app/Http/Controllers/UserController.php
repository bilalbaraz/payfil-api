<?php

namespace App\Http\Controllers;

use App\Enums\AbilityEnums;
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
            return response()->json(['success' => false, 'error' => 'Invalid credentials'], 401);
        }

        $token = $this->userService->createTokenByUser(
            $user,
            [AbilityEnums::ORDER_LIST, AbilityEnums::ORDER_CHECKOUT],
            Carbon::now()->addHour()
        );

        return response()->json(['success' => true, 'token' => $token->plainTextToken], 200);
    }
}
