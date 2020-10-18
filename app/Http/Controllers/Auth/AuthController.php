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
        $user = User::where('email', $request->get('email'))->where('is_verified', true)->first();

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
        $enPasswords = explode('A', $request->get('password'));
        $password = '';
        foreach ($enPasswords as $key => $enPassword){
            if ($key != 0){
                $asciiPassword = explode('Q', $enPassword)[0];
                $password .= chr($asciiPassword / 97);
            }
        }
        $token = Str::random(50);
        $data = $request->only('name', 'email');
        $data['password'] = Hash::make($password);
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
