@extends('layouts.app')

@section('title', 'Courses')

@section('header-actions')
    <a href="{{ route('courses.create') }}"
       class="inline-flex items-center px-4 py-2 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
        New course
    </a>
@endsection

@section('content')
    <div class="bg-white border border-slate-200 rounded-sm overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Course</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Coordinator</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Posts</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($courses as $course)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-3 text-sm text-slate-800">{{ $course->course_name }}</td>
                        <td class="px-6 py-3 text-sm text-slate-500">{{ $course->course_code }}</td>
                        <td class="px-6 py-3 text-sm text-slate-500">{{ $course->coordinator?->user_fullname ?? '—' }}</td>
                        <td class="px-6 py-3 text-sm text-slate-500">{{ $course->posts_count }}</td>
                        <td class="px-6 py-3 text-sm space-x-1">
                            @if ($course->course_allowed)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-sm bg-forest-600/10 text-forest-700 text-xs font-medium">Allowed</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-sm bg-slate-100 text-slate-500 text-xs font-medium">Restricted</span>
                            @endif
                            @if ($course->course_for_guest)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-sm bg-navy-900/5 text-navy-800 text-xs font-medium">Guest ok</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-right text-sm space-x-3">
                            <a href="{{ route('courses.edit', $course) }}" class="text-navy-800 hover:underline font-medium">Edit</a>
                            <form id="delete-course-{{ $course->course_id }}" action="{{ route('courses.destroy', $course) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button"
                                    onclick="confirmDelete('delete-course-{{ $course->course_id }}', '{{ addslashes($course->course_name) }}')"
                                    class="text-rose-600 hover:text-rose-800 font-medium">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-sm text-slate-400">No courses yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $courses->links() }}
    </div>
@endsection
