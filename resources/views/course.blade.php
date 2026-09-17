@extends('layouts.app')

@section('content')
    <div class="mb-6 bg-white border border-slate-200 rounded-xl p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">{{ $course->code }}</h1>
                <p class="text-sm text-slate-600 mt-1">{{ $course->name }}</p>
            </div>
            <span class="text-xs bg-brand-50 text-brand-700 px-3 py-1 rounded-full font-medium">
                {{ $posts->total() }} Questions
            </span>
        </div>
    </div>

    @if($isAllowedToAsk)
        <x-ask-question :courseId="$course->id" />
    @endif

    <div id="feeds">
        @forelse($posts as $post)
            <x-post-card :post="$post" />
        @empty
            <div class="bg-white rounded-xl border border-slate-200 p-12 text-center">
                <h3 class="text-slate-700 font-medium">This course has no posts yet.</h3>
                <p class="text-xs text-slate-400 mt-1">Be the first to ask a question!</p>
            </div>
        @endforelse

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
