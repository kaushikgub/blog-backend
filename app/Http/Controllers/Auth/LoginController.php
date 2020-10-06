<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function users()
    {
        return response()->json(User::all());
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);
        if (Auth::attempt($request->only('email', 'password'), true)){
            return response()->json('Authenticate');
        }
        return response()->json('Unauthenticated');
    }

    public function registration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);
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
