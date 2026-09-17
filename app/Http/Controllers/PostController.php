<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Main Feed (Maps to front.blade.php)
     */
    public function index(Request $request): View
    {
        $courses = Course::orderBy('course_name')->get();
        $query = Post::with(['author', 'course'])->withCount('comments')->latest('post_id');

        // Handle filtering based on request options
        if ($request->option === 'my_courses') {
            $query->whereIn('course_id', auth()->user()->courses()->pluck('courses.course_id'));
        } elseif ($request->option === 'unanswered') {
            $query->doesntHave('comments');
        }

        $posts = $query->paginate(15);

        return view('front', compact('posts', 'courses'));
    }

    /**
     * Single Post View (Maps to post.blade.php)
     */
    public function show(Post $post): View
    {
        return view('post', compact('post'));
    }

    /**
     * Course Feed (Maps to course.blade.php)
     */
    public function course(Course $course): View
    {
        $posts = Post::where('course_id', $course->course_id)
            ->with(['author'])->withCount('comments')
            ->latest('post_id')
            ->paginate(15);

        $isAllowedToAsk = auth()->check();

        return view('course', compact('course', 'posts', 'isAllowedToAsk'));
    }

    /**
     * Course Week Feed (Maps to course-week.blade.php)
     */
    public function courseWeek(Course $course, int $week): View
    {
        $posts = Post::where('course_id', $course->course_id)
            ->where('post_week', $week)
            ->with(['author'])->withCount('comments')
            ->latest('post_id')
            ->paginate(15);

        $isAllowedToAsk = auth()->check();

        return view('course-week', compact('course', 'week', 'posts', 'isAllowedToAsk'));
    }

    /**
     * Global Week Feed (Maps to week.blade.php)
     */
    public function week(int $week): View
    {
        $posts = Post::where('post_week', $week)
            ->with(['author', 'course'])->withCount('comments')
            ->latest('post_id')
            ->paginate(15);

        return view('week', compact('week', 'posts'));
    }

    /**
     * User Profile Feed (Maps to profile.blade.php)
     */
    public function profile(User $user): View
    {
        $posts = Post::where('user_id', $user->user_id)
            ->with(['course'])->withCount('comments')
            ->latest('post_id')
            ->paginate(15);

        // Example logic: Check if the authenticated user follows this profile
        $isFollowing = auth()->check() ? auth()->user()->isFollowing($user) : false;

        return view('profile', [
            'profileUser' => $user,
            'posts' => $posts,
            'isFollowing' => $isFollowing
        ]);
    }

    /**
     * Followed Posts by User (Maps to profile-follow.blade.php)
     */
    public function profileFollows(User $user): View
    {
        // Requires a relation like 'followedPosts' on the User model
        $posts = $user->followedPosts()
            ->with(['author', 'course'])->withCount('comments')
            ->latest('post_id')
            ->paginate(15);

        return view('profile-follow', [
            'profileUser' => $user,
            'posts' => $posts
        ]);
    }

    /**
     * Search Results (Maps to search.blade.php)
     */
    public function search(Request $request): View
    {
        $query = $request->input('q', '');

        $posts = Post::when($query, function ($q) use ($query) {
            return $q->where('post_title', 'like', "%{$query}%")
                     ->orWhere('post_question', 'like', "%{$query}%");
        })->with(['author', 'course'])->withCount('comments')->latest('post_id')->paginate(15);

        return view('search', compact('query', 'posts'));
    }

    // ----------------------------------------------------------------------
    // Standard Resource Methods (Create, Store, Edit, Update, Destroy)
    // ----------------------------------------------------------------------

    public function create(): View
    {
        $users = User::orderBy('user_fullname')->get();
        $courses = Course::orderBy('course_name')->get();
        $posts = Post::orderByDesc('post_id')->get();

        return view('posts.create', compact('users', 'courses', 'posts'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        Post::create($data);
        return redirect()->route('posts.index')->with('success', 'Post created.');
    }

    public function edit(Post $post): View
    {
        $users = User::orderBy('user_fullname')->get();
        $courses = Course::orderBy('course_name')->get();
        $posts = Post::where('post_id', '!=', $post->post_id)->orderByDesc('post_id')->get();

        return view('posts.edit', compact('post', 'users', 'courses', 'posts'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $this->validated($request, $post->post_id);
        $post->update($data);
        return redirect()->route('posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,user_id'],
            'course_id' => ['required', 'exists:courses,course_id'],
            'repost_id' => ['nullable', 'exists:posts,post_id'],
            'post_week' => ['nullable', 'integer', 'min:1', 'max:52'],
            'post_title' => ['required', 'string', 'max:255'],
            'post_url' => ['nullable', 'url', 'max:2048'],
            'post_question' => ['required', 'string'],
            'post_answer' => ['nullable', 'string'],
            'post_hide_name' => ['nullable', 'boolean'],
            'post_current' => ['nullable', 'boolean'],
        ]);

        $data['post_hide_name'] = $request->boolean('post_hide_name');
        $data['post_current'] = $request->boolean('post_current');

        return $data;
    }
}
