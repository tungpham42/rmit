<!-- resources/views/components/ask-question.blade.php -->
@props(['courses' => [], 'selectedCourse' => 0, 'selectedWeek' => 0])

@auth
<div x-data="{ open: false }" class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-6">
    <button @click="open = !open" class="w-full flex items-center justify-between text-left text-sm font-semibold text-slate-700 hover:text-brand-600 transition">
        <span class="flex items-center gap-2">
            <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Ask a New Question
        </span>
        <svg class="w-4 h-4 transform transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </button>

    <form x-show="open" x-collapse action="{{ route('post.store') }}" method="POST" class="mt-4 space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Course Selector -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Course</label>
                <select name="course_id" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-brand-500">
                    <option value="">-- Select Course --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $selectedCourse == $course->id ? 'selected' : '' }}>
                            {{ $course->code }} - {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Week Selector -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Week</label>
                <select name="week" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-brand-500">
                    @for($w = 1; $w <= 12; $w++)
                        <option value="{{ $w }}" {{ ($selectedWeek == $w || ($selectedWeek == 0 && $w == 1)) ? 'selected' : '' }}>
                            Week {{ $w }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Question Title</label>
            <input type="text" name="title" required placeholder="Summarize your question..." class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-brand-500">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Details</label>
            <textarea name="question" rows="4" required placeholder="Provide context and details..." class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-brand-500"></textarea>
        </div>

        <div class="flex items-center justify-between pt-2">
            <label class="flex items-center gap-2 cursor-pointer text-xs text-slate-600">
                <input type="checkbox" name="hide_name" value="1" class="rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                <span>Post Anonymously</span>
            </label>

            <button type="submit" class="px-5 py-2 bg-brand-600 text-white rounded-lg text-sm font-semibold hover:bg-brand-700 shadow-sm transition">
                Submit Question
            </button>
        </div>
    </form>
</div>
@endauth
