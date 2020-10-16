<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerifyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email/verify/{id}/{token}', [VerifyController::class, 'verifyEmail']);
Route::get('/password/reset/{id}/{token}', [VerifyController::class, 'changePassword']);

Route::post('/change/password', [VerifyController::class, 'change']);
