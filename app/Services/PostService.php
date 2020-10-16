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

    public function getAllData(Request $request)
    {
        $posts = Post::query();
        if ($request->get('search')){
            $posts->where('title',  'like', '%' . $request->get('search') . '%');
            $posts->orWhereHas('user', function ($query) use ($request){
                $query->where('name',  'like', '%' . $request->get('search') . '%');
            });
        }
        return $posts->with('user')->where('status', 'Publish')->orderBy('id', 'desc')->paginate(5);
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
        $data = $request->only('title', 'content', 'status');
        $data['user_id'] = Auth::id();
        Post::create($data);
        return 'Created';
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('title', 'content', 'status');
        Post::findOrFail($id)->update($data);
        return 'Updated';
    }
}
