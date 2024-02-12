<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentController extends Controller
{
    public function getComment($id)
    {
        $comment = Comment::query()->find($id);

        if (!$comment) {
            return response()->json(['success' => false, 'message' => 'Комментарий не найден']);
        }

        return response()->json(['success' => true, 'comment' => new CommentResource($comment)]);
    }

    public function getComments()
    {
        $comments = Comment::query()->get();

        return response()->json(['success' => true, 'comments' => new CommentCollection($comments)]);
    }
}
