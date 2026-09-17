<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Services\Voting\CommentVoteService;
use Illuminate\Http\Request;

class CommentVoteController extends Controller
{
    public function __construct(private readonly CommentVoteService $votes)
    {
    }

    public function like(Request $request, Comment $comment)
    {
        $this->votes->like($comment->comment_id, $request->user()->user_id);

        return $this->noContent();
    }

    public function dislike(Request $request, Comment $comment)
    {
        $this->votes->dislike($comment->comment_id, $request->user()->user_id);

        return $this->noContent();
    }

    public function destroy(Request $request, Comment $comment)
    {
        $this->votes->clear($comment->comment_id, $request->user()->user_id);

        return $this->noContent();
    }
}
