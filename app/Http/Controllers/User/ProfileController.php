<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $postService;
    private $profileService;

    public function __construct(PostService $postService, ProfileService $profileService)
    {
        $this->middleware('auth:sanctum');
        $this->postService = $postService;
        $this->profileService = $profileService;
    }

    public function index()
    {
        return response()->json($this->profileService->getUserWithPosts());
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
