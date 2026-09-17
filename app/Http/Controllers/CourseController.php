<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::with('coordinator')->withCount('posts')->orderBy('course_name')->paginate(15);

        return view('courses.index', compact('courses'));
    }

    public function create(): View
    {
        $users = User::orderBy('user_fullname')->get();

        return view('courses.create', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        Course::create($data);

        return redirect()->route('courses.index')->with('success', 'Course created.');
    }

    public function edit(Course $course): View
    {
        $users = User::orderBy('user_fullname')->get();

        return view('courses.edit', compact('course', 'users'));
    }

    public function update(Request $request, Course $course): RedirectResponse
    {
        $data = $this->validated($request, $course->course_id);

        $course->update($data);

        return redirect()->route('courses.index')->with('success', 'Course updated.');
    }

    public function destroy(Course $course): RedirectResponse
    {
        if ($course->posts()->exists()) {
            return redirect()->route('courses.index')->with('error', 'Cannot delete a course that still has posts.');
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,user_id'],
            'course_name' => ['required', 'string', 'max:255'],
            'course_code' => ['required', 'string', 'max:50', 'unique:courses,course_code,'.$ignoreId.',course_id'],
            'course_allowed' => ['nullable', 'boolean'],
            'course_for_guest' => ['nullable', 'boolean'],
        ]);

        $data['course_allowed'] = $request->boolean('course_allowed');
        $data['course_for_guest'] = $request->boolean('course_for_guest');

        return $data;
    }
}
