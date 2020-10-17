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
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        if (! $user || ! Hash::check($request->get('password'), $user->password)) {
            return response([
                'message' => 'The provided credentials are incorrect.'
            ]);
        }
        return response([
            'token' => $user->createToken('token')->plainTextToken,
            'userId' => $user['id']
        ]);
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

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return response()->json('Log Out');
    }
}
