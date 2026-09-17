<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function index(): View
    {
        $comments = Comment::with(['post', 'author'])->latest('comment_id')->paginate(15);

        return view('comments.index', compact('comments'));
    }

    public function create(): View
    {
        $posts = Post::orderByDesc('post_id')->get();
        $users = User::orderBy('user_fullname')->get();

        return view('comments.create', compact('posts', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        Comment::create($data);

        return redirect()->route('comments.index')->with('success', 'Comment created.');
    }

    public function edit(Comment $comment): View
    {
        $posts = Post::orderByDesc('post_id')->get();
        $users = User::orderBy('user_fullname')->get();

        return view('comments.edit', compact('comment', 'posts', 'users'));
    }

    public function update(Request $request, Comment $comment): RedirectResponse
    {
        $data = $this->validated($request);

        $comment->update($data);

        return redirect()->route('comments.index')->with('success', 'Comment updated.');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'post_id' => ['required', 'exists:posts,post_id'],
            'user_id' => ['required', 'exists:users,user_id'],
            'comment_body' => ['required', 'string'],
            'comment_hide_name' => ['nullable', 'boolean'],
        ]);

        $data['comment_hide_name'] = $request->boolean('comment_hide_name');

        return $data;
    }
}
