<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public function getUserWithPosts()
    {
        return User::with('posts.user')->findOrFail(Auth::id());
    }
}
