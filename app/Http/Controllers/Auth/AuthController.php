<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Notifications\AccountCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function users()
    {
        return response()->json(User::all());
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(
            [
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'is_verified' => true
            ]
            , true)) {
            return response()->json(Auth::user());
        }
        return response()->json('Unauthenticated');
    }

    public function registration(UserRequest $request)
    {
        $token = Str::random(50);
        $data = $request->only('name', 'email');
        $data['password'] = Hash::make($request->get('password'));
        $data['token'] = $token;
        $data['is_verified'] = false;
        $user = User::create($data);
        Notification::send($user, new AccountCreated($user));
        return response()->json('Registered Successful');
    }

    public function logout()
    {
        Auth::logout();
        return response()->json('Log Out');
    }
}
