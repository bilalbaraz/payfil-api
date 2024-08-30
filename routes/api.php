<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::post('/tokens/create', function (Request $request) {
    $user = User::query()->where('email', $request->get('email'))->first();

    if (! $user || ! Hash::check($request->get('password'), $user->password)) {
        return ['success' => false, 'error' => 'Invalid credentials'];
    }

    $token = $user->createToken('personal_access_token', ['*'], Carbon::now()->addHour());

    return ['token' => $token->plainTextToken];
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
