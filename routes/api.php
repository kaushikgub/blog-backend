<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\ProfileController;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/registration', [LoginController::class, 'registration']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/posts/recent', [PostController::class, 'recentPosts']);
Route::resource('/posts', PostController::class);

Route::resource('/profiles', ProfileController::class);
