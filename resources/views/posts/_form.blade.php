@php $post = $post ?? null; @endphp

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Course</label>
        <select name="course_id"
                class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
            <option value="">Select a course</option>
            @foreach ($courses as $course)
                <option value="{{ $course->course_id }}" {{ old('course_id', $post?->course_id) == $course->course_id ? 'selected' : '' }}>
                    {{ $course->course_code }} — {{ $course->course_name }}
                </option>
            @endforeach
        </select>
        @error('course_id')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Author</label>
        <select name="user_id"
                class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
            <option value="">Select an author</option>
            @foreach ($users as $user)
                <option value="{{ $user->user_id }}" {{ old('user_id', $post?->user_id) == $user->user_id ? 'selected' : '' }}>
                    {{ $user->user_fullname }}
                </option>
            @endforeach
        </select>
        @error('user_id')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Title</label>
    <input type="text" name="post_title" value="{{ old('post_title', $post?->post_title) }}"
           class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
    @error('post_title')
        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Week</label>
        <input type="number" name="post_week" min="1" max="52" value="{{ old('post_week', $post?->post_week) }}"
               class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
        @error('post_week')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Reference URL</label>
        <input type="url" name="post_url" value="{{ old('post_url', $post?->post_url) }}"
               class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
        @error('post_url')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Repost of (optional)</label>
    <select name="repost_id"
            class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
        <option value="">None</option>
        @foreach ($posts as $original)
            <option value="{{ $original->post_id }}" {{ old('repost_id', $post?->repost_id) == $original->post_id ? 'selected' : '' }}>
                #{{ $original->post_id }} — {{ $original->post_title }}
            </option>
        @endforeach
    </select>
    @error('repost_id')
        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Question</label>
    <textarea name="post_question" rows="4"
              class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">{{ old('post_question', $post?->post_question) }}</textarea>
    @error('post_question')
        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Answer (optional)</label>
    <textarea name="post_answer" rows="4"
              class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">{{ old('post_answer', $post?->post_answer) }}</textarea>
    @error('post_answer')
        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="flex flex-col gap-2">
    <label class="flex items-center gap-2 text-sm text-slate-700">
        <input type="hidden" name="post_hide_name" value="0">
        <input type="checkbox" name="post_hide_name" value="1"
               {{ old('post_hide_name', $post?->post_hide_name) ? 'checked' : '' }}
               class="rounded-sm border-slate-300 text-forest-600 focus:ring-forest-600/40">
        Hide author name
    </label>
    <label class="flex items-center gap-2 text-sm text-slate-700">
        <input type="hidden" name="post_current" value="0">
        <input type="checkbox" name="post_current" value="1"
               {{ old('post_current', $post?->post_current) ? 'checked' : '' }}
               class="rounded-sm border-slate-300 text-forest-600 focus:ring-forest-600/40">
        Mark as current version
    </label>
</div>
