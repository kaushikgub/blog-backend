<?php


namespace App\Services;


use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function getAllData()
    {
        return Post::with('user')->orderBy('id', 'desc')->get();
    }

    public function getDataByUser()
    {
        return Post::where('user_id', Auth::id())->get();
    }

    public function getData($id)
    {
        return Post::with('user.posts')->findOrFail($id);
    }

    public function deleteData($id)
    {
        Post::findOrFail($id)->delete();
        return 'Deleted';
    }

    public function create(Request $request)
    {
        $data = $request->except('id');
        $data['user_id'] = Auth::id();
        Post::create($data);
        return 'Created';
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('id');
        Post::findOrFail($id)->update($data);
        return 'Updated';
    }
}
