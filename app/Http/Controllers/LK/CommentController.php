<?php

namespace App\Http\Controllers\LK;

use App\Http\Controllers\Base\PaginateController;
use App\Http\Controllers\Base\SortController;
use App\Http\Controllers\Controller;
use App\Http\Requests\LK\CommentFormRequest;
use App\Models\Comment;
use App\Models\Post;
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
        $userId = $request->user()->id;

        $comments = Comment::where('user_id', $userId)
            ->orderBy($this->sort->getSort($request), $this->sort->getOrder($request))
            ->paginate(3, ['*'], 'page', $this->paginate->getPage($request))
            ->withQueryString();

        return view('lk.comments.index', ["comments" => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $posts = Post::pluck('title', 'id')->all();

        return view("lk.comments.edit", [
            "comment" => $comment,
            "posts" => $posts
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentFormRequest $request, Comment $comment)
    {
        $data = $request->validated();

        $comment->update($data);

        return redirect(route("lk.comments.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect(route("lk.comments.index"));
    }
}
