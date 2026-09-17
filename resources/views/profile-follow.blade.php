@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-lg font-bold text-slate-900">Posts Followed by {{ $profileUser->fullname ?? $profileUser->username }}</h1>
        <a href="{{ route('profile.show', $profileUser->username) }}" class="text-xs font-medium text-brand-600 hover:underline">
            &larr; Back to profile
        </a>
    </div>

    <div id="feeds">
        @forelse($posts as $post)
            <x-post-card :post="$post" />
        @empty
            <div class="bg-white rounded-xl border border-slate-200 p-8 text-center text-slate-500">
                This user is not following any posts.
            </div>
        @endforelse

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
