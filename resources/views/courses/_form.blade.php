@php $course = $course ?? null; @endphp

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Course name</label>
    <input type="text" name="course_name" value="{{ old('course_name', $course?->course_name) }}"
           class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
    @error('course_name')
        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Course code</label>
    <input type="text" name="course_code" value="{{ old('course_code', $course?->course_code) }}"
           class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
    @error('course_code')
        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Coordinator</label>
    <select name="user_id"
            class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
        <option value="">Select a coordinator</option>
        @foreach ($users as $user)
            <option value="{{ $user->user_id }}" {{ old('user_id', $course?->user_id) == $user->user_id ? 'selected' : '' }}>
                {{ $user->user_fullname }}
            </option>
        @endforeach
    </select>
    @error('user_id')
        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="flex flex-col gap-2">
    <label class="flex items-center gap-2 text-sm text-slate-700">
        <input type="hidden" name="course_allowed" value="0">
        <input type="checkbox" name="course_allowed" value="1"
               {{ old('course_allowed', $course?->course_allowed) ? 'checked' : '' }}
               class="rounded-sm border-slate-300 text-forest-600 focus:ring-forest-600/40">
        Students can enrol
    </label>
    <label class="flex items-center gap-2 text-sm text-slate-700">
        <input type="hidden" name="course_for_guest" value="0">
        <input type="checkbox" name="course_for_guest" value="1"
               {{ old('course_for_guest', $course?->course_for_guest) ? 'checked' : '' }}
               class="rounded-sm border-slate-300 text-forest-600 focus:ring-forest-600/40">
        Visible to guests
    </label>
</div>
