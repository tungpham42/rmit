@extends('layouts.app')

@section('content')
    <div class="mb-6 bg-white border border-slate-200 rounded-xl p-6">
        <h1 class="text-xl font-bold text-slate-900">Global Week {{ $week }} Discussions</h1>
    </div>

    <x-ask-question :week="$week" />

    <div id="feeds">
        @forelse($posts as $post)
            <x-post-card :post="$post" />
        @empty
            <div class="bg-white rounded-xl border border-slate-200 p-8 text-center text-slate-500">
                No activity recorded for Week {{ $week }} across all courses.
            </div>
        @endforelse

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
