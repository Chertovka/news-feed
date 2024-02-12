<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    public function getPost($id)
    {
        $post = Post::query()->find($id);

        if (!$post) {
            return response()->json(['success' => false, 'message' => 'Пост не найден']);
        }

        return response()->json(['success' => true, 'post' => new PostResource($post)]);
    }

    public function getPosts()
    {
        $posts = Post::query()->get();

        return response()->json(['success' => true, 'posts' => new PostCollection($posts)]);
    }
}
