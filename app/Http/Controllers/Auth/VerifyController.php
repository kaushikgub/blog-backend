<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class VerifyController extends Controller
{
    public function verifyEmail($id, $token)
    {
        User::where('id', $id)->where('token', $token)->update([
            'is_verified' => true,
            'token' => Str::random(10)
        ]);
        return 'Email Verification Successful';
    }

    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        if ($user){
            $token = Str::random(200);
            $user->update([
                'token' => $token
            ]);
            Notification::send($user, new ForgotPassword($user['id'], $token));
            return response()->json([
                'message'=> 'Check Your Email',
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'message'=> 'Invalid Email',
                'status' => 'error'
            ]);
        }
    }

    public function changePassword($id, $token)
    {
        return view('auth.password-change', with([
            'id' => $id,
            'token' => $token
        ]));
    }

    public function change(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'token' => 'required',
            'password' => 'required|confirmed|min:3'
        ]);
        $data = $request->only('id', 'token');
        User::where($data)->update([
            'password' => Hash::make($request->get('password')),
            'token' => Str::random(10)
        ]);
        return redirect('http://localhost:3000/login');
    }
}
