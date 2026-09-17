@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center justify-between bg-white border border-slate-200 rounded-xl p-6">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('courses.show', $course->code) }}" class="text-sm font-semibold text-brand-600 hover:underline">{{ $course->code }}</a>
                <span class="text-slate-400">•</span>
                <span class="text-sm font-medium text-slate-500">Week {{ $week }}</span>
            </div>
            <h1 class="text-xl font-bold text-slate-900 mt-1">{{ $course->name }} — Week {{ $week }}</h1>
        </div>
    </div>

    @if($isAllowedToAsk)
        <x-ask-question :courseId="$course->id" :week="$week" />
    @endif

    <div id="feeds">
        @forelse($posts as $post)
            <x-post-card :post="$post" />
        @empty
            <div class="bg-white rounded-xl border border-slate-200 p-8 text-center text-slate-500">
                No questions posted for Week {{ $week }} yet.
            </div>
        @endforelse

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
