<!-- resources/views/components/post-card.blade.php -->
@props(['post'])

<div x-data="{
    likesCount: {{ $post->likes_count ?? 0 }},
    dislikesCount: {{ $post->dislikes_count ?? 0 }},
    followsCount: {{ $post->follows_count ?? 0 }},
    isLiked: {{ json_encode($post->is_liked_by_user ?? false) }},
    isDisliked: {{ json_encode($post->is_disliked_by_user ?? false) }},
    isFollowed: {{ json_encode($post->is_followed_by_user ?? false) }},
    showComments: false,
    userRating: {{ $post->user_rating ?? 0 }},
    avgRating: {{ $post->avg_rating ?? 0 }},

    toggleLike() {
        @guest
            Swal.fire('Authentication Required', 'Please log in to like posts.', 'info');
            return;
        @endguest
        fetch(`/posts/{{ $post->id }}/like`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
            .then(res => res.json())
            .then(data => {
                this.likesCount = data.likesCount;
                this.dislikesCount = data.dislikesCount;
                this.isLiked = data.isLiked;
                this.isDisliked = data.isDisliked;
            });
    },
    toggleDislike() {
        @guest
            Swal.fire('Authentication Required', 'Please log in to dislike posts.', 'info');
            return;
        @endguest
        fetch(`/posts/{{ $post->id }}/dislike`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
            .then(res => res.json())
            .then(data => {
                this.likesCount = data.likesCount;
                this.dislikesCount = data.dislikesCount;
                this.isLiked = data.isLiked;
                this.isDisliked = data.isDisliked;
            });
    },
    toggleFollow() {
        @guest
            Swal.fire('Authentication Required', 'Please log in to follow posts.', 'info');
            return;
        @endguest
        fetch(`/posts/{{ $post->id }}/follow`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
            .then(res => res.json())
            .then(data => {
                this.followsCount = data.followsCount;
                this.isFollowed = data.isFollowed;
            });
    },
    confirmDelete() {
        Swal.fire({
            title: 'Delete Question?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Yes, delete it'
        }).then((result) => {
            if (result.isConfirmed) {
                $refs.deleteForm.submit();
            }
        });
    }
}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 mb-4 hover:border-slate-300 transition">

    <!-- Post Header -->
    <div class="flex items-start justify-between gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ $post->is_anonymous ? '#' : route('profile.show', $post->user->username) }}">
                <img src="{{ $post->is_anonymous ? asset('images/avatar.jpg') : $post->user->avatar_url }}"
                     alt="Avatar" class="w-10 h-10 rounded-full object-cover border border-slate-100">
            </a>
            <div>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-sm {{ optional($post->user)->role_id == 3 ? 'text-amber-600 font-bold' : 'text-slate-900' }}">
                        {{ $post->is_anonymous ? 'Anonymous' : ($post->user->fullname ?? $post->user->username) }}
                    </span>
                    @if(optional($post->user)->role_id == 3)
                        <span class="bg-amber-50 text-amber-700 text-xs px-2 py-0.5 rounded-full border border-amber-200">Lecturer</span>
                    @endif
                </div>
                <div class="text-xs text-slate-500 flex items-center gap-1 mt-0.5">
                    <a href="{{ route('course.show', $post->course->code) }}" class="font-medium text-brand-600 hover:underline">{{ $post->course->code }}</a>
                    <span>&bull;</span>
                    <a href="{{ route('course.week', ['code' => $post->course->code, 'week' => $post->week]) }}" class="hover:underline">Week {{ $post->week }}</a>
                    <span>&bull;</span>
                    <span>{{ $post->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        <!-- Role Action Menu (Edit / Delete) -->
        @can('update', $post)
            <div class="flex items-center gap-2">
                <a href="{{ route('post.edit', $post->id) }}" class="p-1 text-slate-400 hover:text-brand-600 rounded">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </a>
                <form x-ref="deleteForm" action="{{ route('post.destroy', $post->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" @click="confirmDelete()" class="p-1 text-slate-400 hover:text-red-600 rounded">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </form>
            </div>
        @endcan
    </div>

    <!-- Post Body -->
    <div class="mt-3">
        <h3 class="text-base font-bold text-slate-900 leading-snug">
            <a href="{{ route('post.show', $post->url) }}" class="hover:text-brand-600 transition">{{ $post->title }}</a>
        </h3>
        <div class="mt-2 text-sm text-slate-700 leading-relaxed space-y-2">
            {!! nl2br(e($post->question)) !!}
        </div>
    </div>

    <!-- Answer Box (if present) -->
    @if(!empty($post->answer))
        <div class="mt-4 p-4 bg-emerald-50/60 border border-emerald-100 rounded-lg">
            <div class="text-xs font-semibold text-emerald-800 uppercase tracking-wider mb-1 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Answer
            </div>
            <div class="text-sm text-slate-800">
                {!! nl2br(e($post->answer)) !!}
            </div>
        </div>
    @endif

    <!-- Interactive Footer Bar -->
    <div class="mt-5 pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3 text-xs">
        <div class="flex items-center gap-2">
            <!-- Like Button -->
            <button @click="toggleLike()"
                    :class="isLiked ? 'bg-brand-50 text-brand-600 border-brand-200' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100'"
                    class="px-3 py-1.5 rounded-full border font-medium flex items-center gap-1.5 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                <span x-text="likesCount"></span> Likes
            </button>

            <!-- Dislike Button -->
            <button @click="toggleDislike()"
                    :class="isDisliked ? 'bg-red-50 text-red-600 border-red-200' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100'"
                    class="px-3 py-1.5 rounded-full border font-medium flex items-center gap-1.5 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018c.163 0 .326.02.485.06L17 4m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5"/></svg>
                <span x-text="dislikesCount"></span> Dislikes
            </button>

            <!-- Follow Button -->
            <button @click="toggleFollow()"
                    :class="isFollowed ? 'bg-amber-50 text-amber-600 border-amber-200' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100'"
                    class="px-3 py-1.5 rounded-full border font-medium flex items-center gap-1.5 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                <span x-text="isFollowed ? 'Followed' : 'Follow'"></span> (<span x-text="followsCount"></span>)
            </button>
        </div>

        <!-- Comment Drawer Toggle Button -->
        <button @click="showComments = !showComments" class="text-slate-500 hover:text-slate-800 font-medium flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
            <span>{{ $post->comments_count ?? $post->comments->count() }} Comments</span>
        </button>
    </div>

    <!-- Inline Comments Drawer -->
    <div x-show="showComments" x-collapse x-cloak class="mt-4 pt-4 border-t border-slate-100">
        <div class="space-y-3">
            @forelse($post->comments as $comment)
                <div class="bg-slate-50 rounded-lg p-3 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-slate-900">{{ $comment->user->fullname ?? $comment->user->username }}</span>
                        <span class="text-slate-400">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="mt-1 text-slate-700">{{ $comment->content }}</p>
                </div>
            @empty
                <p class="text-xs text-slate-400 italic">No comments yet.</p>
            @endforelse
        </div>

        <!-- Add Comment Form -->
        @auth
            <form action="{{ route('comment.store', $post->id) }}" method="POST" class="mt-3 flex gap-2">
                @csrf
                <input type="text" name="content" required placeholder="Write a comment..." class="flex-grow bg-slate-100 border-0 rounded-lg px-3 py-1.5 text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white">
                <button type="submit" class="px-3 py-1.5 bg-brand-600 text-white rounded-lg text-xs font-medium hover:bg-brand-700">Reply</button>
            </form>
        @endauth
    </div>
</div>
