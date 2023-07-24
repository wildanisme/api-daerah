<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts  =   Post::all();

        return new PostResource(true, 'lList Semua Post', $posts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,jpg,png,svg|max:2048',
            'title'     => 'required',
            'content'   => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image  = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        $post   = Post::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        return new PostResource(true, 'Data berhasil ditambahkan', $post);
    }

    public function show(int $id)
    {
        $post   =   Post::findOrFail($id);

        return new PostResource(true, 'Post', $post);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = Post::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/posts/', $image->hashName());

            Storage::delete('public/posts/' . basename($post->image));

            $post->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        } else {
            $post->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        }

        return new PostResource(true, 'Data berhasil diubah', $post);
    }

    public function destroy(int $id)
    {
        $post = Post::find($id);
        $post->delete();
        Storage::delete('public/posts/' . basename($post->image));

        return new PostResource(true, 'Data Berhasil dihapus', null);
    }
}
