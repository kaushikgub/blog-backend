<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\BlogController;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/registration', [LoginController::class, 'registration']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::resource('/posts', BlogController::class);