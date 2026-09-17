<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostRateService;
use Illuminate\Http\Request;

class PostRateController extends Controller
{
    public function __construct(private readonly PostRateService $rates)
    {
    }

    public function store(Request $request, Post $post)
    {
        $validated = $request->validate(['value' => ['required', 'boolean']]);

        $this->rates->rate($post->post_id, $request->user()->user_id, (bool) $validated['value']);

        return $this->noContent();
    }

    public function destroy(Request $request, Post $post)
    {
        $this->rates->clear($post->post_id, $request->user()->user_id);

        return $this->noContent();
    }
}
