<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\Voting\PostVoteService;
use Illuminate\Http\Request;

class PostVoteController extends Controller
{
    public function __construct(private readonly PostVoteService $votes)
    {
    }

    public function like(Request $request, Post $post)
    {
        $this->votes->like($post->post_id, $request->user()->user_id);

        return $this->noContent();
    }

    public function dislike(Request $request, Post $post)
    {
        $this->votes->dislike($post->post_id, $request->user()->user_id);

        return $this->noContent();
    }

    public function destroy(Request $request, Post $post)
    {
        $this->votes->clear($post->post_id, $request->user()->user_id);

        return $this->noContent();
    }
}
