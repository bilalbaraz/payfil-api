<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/tokens/create', [UserController::class, 'createToken']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'orders', 'as' => 'order.', 'middleware' => ['auth:sanctum']], function () {
    Route::get('', [OrderController::class, 'index'])->name('index')->middleware('ability:order:list');
    Route::post('checkout', [OrderController::class, 'checkout'])->name('checkout')->middleware('ability:order:checkout');
});
