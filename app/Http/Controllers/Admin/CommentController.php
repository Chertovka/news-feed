<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\PaginateController;
use App\Http\Controllers\Base\SortController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommentFormRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $paginate;
    protected $sort;

    public function __construct(PaginateController $paginate, SortController $sort)
    {
        $this->paginate = $paginate;
        $this->sort = $sort;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Comment::query();

        $comments = $query
            ->orderBy(
                $this->sort->getSort($request),
                $this->sort->getOrder($request))
            ->paginate(3, ['*'], 'page', $this->paginate->getPage($request))
            ->withQueryString();

        return view('admin.comments.index', ["comments" => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::pluck('name', 'id')->all();
        $posts = Post::pluck('title', 'id')->all();

        return view('admin.comments.create', ["users" => $users, "posts" => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentFormRequest $request)
    {
        $data = $request->validated();

        $comment = new Comment($data);

        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;

        $comment->save();

        return redirect(route("admin.comments.index", ["comment" => $comment]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $users = User::pluck('name', 'id')->all();
        $posts = Post::pluck('title', 'id')->all();

        return view("admin.comments.create", [
            "comment" => $comment,
            "users" => $users,
            "posts" => $posts
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentFormRequest $request, string $id)
    {
        $comment = Comment::findOrFail($id);

        $data = $request->validated();

        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;

        $comment->update($data);

        return redirect(route("admin.comments.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect(route("admin.comments.index"));
    }
}
