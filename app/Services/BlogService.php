<?php


namespace App\Services;


use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogService
{
    public function getAllData()
    {
        return Blog::with('user')->orderBy('id', 'desc')->get();
    }

    public function getDataByUser()
    {
        return Blog::where('user_id', Auth::id())->get();
    }

    public function getData($id)
    {
        return Blog::with('user')->findOrFail($id);
    }

    public function deleteData($id)
    {
        Blog::findOrFail($id)->delete();
        return 'Deleted';
    }

    public function create(Request $request)
    {
        $data = $request->except('id');
        $data['user_id'] = Auth::id();
        $data['status'] = 'Pending';
        Blog::create($data);
        return 'Created';
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('id');
        Blog::findOrFail($id)->update($data);
        return 'Updated';
    }
}
