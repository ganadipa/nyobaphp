<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}

class PostController extends Controller
{
    public function index()
    {
        // Mengambil semua post dengan relasi category dan menggunakan pagination
        $posts = Post::with('category')->paginate(10);
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        // Membuat post baru
        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    public function show(Post $post)
    {
        // Menampilkan detail post dengan relasi category
        return response()->json($post->load('category'));
    }

    public function update(Request $request, Post $post)
    {
        // Memperbarui post
        $post->update($request->all());
        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        // Menghapus post
        $post->delete();
        return response()->json(null, 204);
    }
}
