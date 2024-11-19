<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth',
    'controller' => AuthController::class,
], function () {
    Route::post('login', 'login');
    Route::get('check', 'check')->middleware('auth:api');
    Route::get('logout', 'logout')->middleware('auth:api');
});
