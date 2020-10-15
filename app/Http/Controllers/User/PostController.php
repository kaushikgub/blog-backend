<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->middleware('auth:sanctum', ['except' => [
            'index', 'recentPosts', 'show'
        ]]);
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        return response()->json($this->postService->getAllData($request));
    }

    public function create()
    {
        //
    }

    public function store(PostRequest $request)
    {
        return response()->json($this->postService->create($request));
    }

    public function show($id)
    {
        return response()->json($this->postService->getDataWithRelatedPost($id));
    }


    public function edit($id)
    {
        return response()->json($this->postService->getData($id));
    }


    public function update(PostRequest $request, $id)
    {
        return response()->json($this->postService->update($request, $id));
    }

    public function destroy($id)
    {
        //
    }

    public function recentPosts()
    {
        return response()->json($this->postService->getRecentPosts());
    }
}
