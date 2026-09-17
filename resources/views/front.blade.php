@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Main Feed Column -->
        <div class="lg:col-span-3">
            <x-ask-question :courses="$courses" />

            <!-- Filter Controls -->
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-lg font-bold text-slate-900">Recent Feed</h1>
                <form method="GET" action="{{ route('home') }}" class="flex items-center gap-2">
                    <label for="filter" class="text-xs font-medium text-slate-500">Filter:</label>
                    <select name="option" onchange="this.form.submit()" class="text-xs border border-slate-300 rounded-lg px-2.5 py-1.5 bg-white focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="all" {{ request('option') == 'all' ? 'selected' : '' }}>All Courses</option>
                        <option value="my_courses" {{ request('option') == 'my_courses' ? 'selected' : '' }}>My Enrolled Courses</option>
                        <option value="unanswered" {{ request('option') == 'unanswered' ? 'selected' : '' }}>Unanswered Questions</option>
                    </select>
                </form>
            </div>

            <!-- Posts Listing -->
            <div id="feeds">
                @forelse($posts as $post)
                    <x-post-card :post="$post" />
                @empty
                    <div class="bg-white rounded-xl border border-slate-200 p-8 text-center text-slate-500">
                        No posts found in the feed.
                    </div>
                @endforelse

                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="bg-white rounded-xl border border-slate-200 p-4">
                <h2 class="text-sm font-bold text-slate-900 mb-3">My Courses</h2>
                <ul class="space-y-2 text-xs">
                    @foreach($courses as $course)
                        <li>
                            <a href="{{ route('courses.show', $course->code) }}" class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 text-slate-700 transition">
                                <span class="font-medium text-brand-600">{{ $course->code }}</span>
                                <span class="truncate max-w-[120px] text-slate-500">{{ $course->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
