@php $semester = $semester ?? null; @endphp

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Semester code</label>
    <input type="text" name="semester_code" value="{{ old('semester_code', $semester?->semester_code) }}"
           placeholder="e.g. 2026B"
           class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
    @error('semester_code')
        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Start date</label>
        <input type="date" name="semester_start_date"
               value="{{ old('semester_start_date', $semester?->semester_start_date?->format('Y-m-d')) }}"
               class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
        @error('semester_start_date')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">End date</label>
        <input type="date" name="semester_end_date"
               value="{{ old('semester_end_date', $semester?->semester_end_date?->format('Y-m-d')) }}"
               class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
        @error('semester_end_date')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<label class="flex items-center gap-2 text-sm text-slate-700">
    <input type="hidden" name="semester_current" value="0">
    <input type="checkbox" name="semester_current" value="1"
           {{ old('semester_current', $semester?->semester_current) ? 'checked' : '' }}
           class="rounded-sm border-slate-300 text-forest-600 focus:ring-forest-600/40">
    Mark as the current semester
</label>
