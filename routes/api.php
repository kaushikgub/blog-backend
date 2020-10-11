<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\LoginRegistrationController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\ProfileController;

Route::post('/login', [LoginRegistrationController::class, 'login']);
Route::post('/registration', [LoginRegistrationController::class, 'registration']);
Route::get('/logout', [LoginRegistrationController::class, 'logout']);

Route::get('/posts/recent', [PostController::class, 'recentPosts']);
Route::resource('/posts', PostController::class);

Route::resource('/profiles', ProfileController::class);
