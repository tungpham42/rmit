<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\Following\PostFollowService;
use Illuminate\Http\Request;

class PostFollowController extends Controller
{
    public function __construct(private readonly PostFollowService $follows)
    {
    }

    public function store(Request $request, Post $post)
    {
        $this->follows->follow($request->user()->user_id, $post->post_id);

        return $this->noContent();
    }

    public function destroy(Request $request, Post $post)
    {
        $this->follows->unfollow($request->user()->user_id, $post->post_id);

        return $this->noContent();
    }
}
