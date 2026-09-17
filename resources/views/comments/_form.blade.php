@php $comment = $comment ?? null; @endphp

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Post</label>
    <select name="post_id"
            class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
        <option value="">Select a post</option>
        @foreach ($posts as $post)
            <option value="{{ $post->post_id }}" {{ old('post_id', $comment?->post_id) == $post->post_id ? 'selected' : '' }}>
                #{{ $post->post_id }} — {{ $post->post_title }}
            </option>
        @endforeach
    </select>
    @error('post_id')
        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Author</label>
    <select name="user_id"
            class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
        <option value="">Select an author</option>
        @foreach ($users as $user)
            <option value="{{ $user->user_id }}" {{ old('user_id', $comment?->user_id) == $user->user_id ? 'selected' : '' }}>
                {{ $user->user_fullname }}
            </option>
        @endforeach
    </select>
    @error('user_id')
        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Comment</label>
    <textarea name="comment_body" rows="4"
              class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">{{ old('comment_body', $comment?->comment_body) }}</textarea>
    @error('comment_body')
        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<label class="flex items-center gap-2 text-sm text-slate-700">
    <input type="hidden" name="comment_hide_name" value="0">
    <input type="checkbox" name="comment_hide_name" value="1"
           {{ old('comment_hide_name', $comment?->comment_hide_name) ? 'checked' : '' }}
           class="rounded-sm border-slate-300 text-forest-600 focus:ring-forest-600/40">
    Hide author name
</label>
