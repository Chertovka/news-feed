<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\PaginateController;
use App\Http\Requests\CommentForm;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $paginate;

    public function __construct(PaginateController $paginate)
    {
        $this->paginate = $paginate;
    }

    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at', 'DESC')
            ->paginate(3, ['*'], 'page', $this->paginate->getPage($request));

        return view('posts.index', ["posts" => $posts]);
    }

    public function show($id)
    {
        $post = Post::with("comments.user")->findOrFail($id);

        return view('posts.show', ["post" => $post]);
    }

    public function comment($id, CommentForm $request)
    {
        $post = Post::findOrFail($id);

        $post->comments()->create($request->validated());

        return redirect(route("posts.show", $id));
    }
}
