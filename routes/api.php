<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Auth\VerifyController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/registration', [AuthController::class, 'registration']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/forgot/password', [VerifyController::class, 'forgotPassword']);

Route::get('/posts/recent', [PostController::class, 'recentPosts']);
Route::resource('/posts', PostController::class);

Route::resource('/profiles', ProfileController::class);
