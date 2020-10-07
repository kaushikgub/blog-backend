<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $blogService;

    public function __construct(PostService $blogService)
    {
        $this->middleware('auth:sanctum');
        $this->blogService = $blogService;
    }

    public function index()
    {
        return response()->json($this->blogService->getAllData());
    }

    public function create()
    {
        //
    }

    public function store(PostRequest $request)
    {
        return response()->json($this->blogService->create($request));
    }

    public function show($id)
    {
        return response()->json($this->blogService->getData($id));
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
