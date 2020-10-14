<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegistrationController extends Controller
{
    public function users()
    {
        return response()->json(User::all());
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'), true)){
            return response()->json(Auth::user());
        }
        return response()->json('Unauthenticated');
    }

    public function registration(UserRequest $request)
    {
        $data = $request->only('name', 'email');
        $data['password'] = Hash::make($request->get('password'));
        User::create($data);
        return response()->json('Registered Successful');
    }

    public function logout()
    {
        Auth::logout();
        return response()->json('Log Out');
    }
}
