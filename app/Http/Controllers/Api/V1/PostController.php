<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        // Get posts with 10 posts per page
    $posts = Post::with('category')->paginate(10);

    return response()->json($posts, 200);
    }

    public function store(Request $request)
    {
        // Membuat post baru
        $post = Post::create($request->all());

        return response()->json($post, 201);
    }

    public function show(Post $post)
    {
        // Menampilkan detail post
        return $post->load('category');
    }

    public function update(Request $request, Post $post)
    {
        // Memperbarui post
        $post->update($request->all());

        return response()->json($post, 200);
    }

    public function destroy(Post $post)
    {
        // Menghapus post
        $post->delete();

        return response()->json(null, 204);
    }
}
