<?php


namespace App\Services;


use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function getData($id)
    {
        return Post::findOrFail($id);
    }

    public function getAllData()
    {
        return Post::with('user')->orderBy('id', 'desc')->paginate(5);
    }

    public function getDataWithRelatedPost($id)
    {
        return Post::with('user.posts')->findOrFail($id);
    }

    public function getRecentPosts()
    {
        return Post::orderBy('id', 'desc')->take(10)->get();
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
