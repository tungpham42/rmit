@extends('layouts.app')

@section('content')
    <div x-data="{
        following: {{ $isFollowing ? 'true' : 'false' }},
        toggleFollowUser() {
            fetch('/api/users/{{ $profileUser->id }}/follow', { method: 'POST', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'} })
                .then(res => res.json())
                .then(data => { this.following = data.following; });
        }
    }" class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <img class="w-16 h-16 rounded-full object-cover border border-slate-200" src="{{ $profileUser->avatar_url }}" alt="{{ $profileUser->name }}">
                <div>
                    <h1 class="text-xl font-bold text-slate-900">{{ $profileUser->user_fullname ?? $profileUser->name }}</h1>
                    <p class="text-xs text-slate-500">@ {{ $profileUser->name }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                @if(auth()->id() !== $profileUser->id)
                    <button @click="toggleFollowUser()"
                            :class="following ? 'bg-slate-100 text-slate-700 hover:bg-slate-200' : 'bg-brand-600 text-white hover:bg-brand-700'"
                            class="px-4 py-2 rounded-lg text-xs font-semibold transition">
                        <span x-text="following ? 'Following' : 'Follow User'"></span>
                    </button>
                @endif
                <a href="{{ route('profile.follows', $profileUser->username) }}" class="px-4 py-2 rounded-lg border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                    Following Posts
                </a>
            </div>
        </div>
    </div>

    <div id="feeds">
        @forelse($posts as $post)
            <x-post-card :post="$post" />
        @empty
            <div class="bg-white rounded-xl border border-slate-200 p-8 text-center text-slate-500">
                This user has not authored any posts yet.
            </div>
        @endforelse

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
