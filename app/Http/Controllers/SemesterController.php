<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SemesterController extends Controller
{
    public function index(): View
    {
        $semesters = Semester::orderByDesc('semester_start_date')->paginate(15);

        return view('semesters.index', compact('semesters'));
    }

    public function create(): View
    {
        return view('semesters.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if (! empty($data['semester_current'])) {
            Semester::query()->update(['semester_current' => false]);
        }

        Semester::create($data);

        return redirect()->route('semesters.index')->with('success', 'Semester created.');
    }

    public function edit(Semester $semester): View
    {
        return view('semesters.edit', compact('semester'));
    }

    public function update(Request $request, Semester $semester): RedirectResponse
    {
        $data = $this->validated($request, $semester->semester_id);

        if (! empty($data['semester_current'])) {
            Semester::query()->where('semester_id', '!=', $semester->semester_id)->update(['semester_current' => false]);
        }

        $semester->update($data);

        return redirect()->route('semesters.index')->with('success', 'Semester updated.');
    }

    public function destroy(Semester $semester): RedirectResponse
    {
        $semester->delete();

        return redirect()->route('semesters.index')->with('success', 'Semester deleted.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $data = $request->validate([
            'semester_code' => ['required', 'string', 'max:50', 'unique:semesters,semester_code,'.$ignoreId.',semester_id'],
            'semester_start_date' => ['required', 'date'],
            'semester_end_date' => ['required', 'date', 'after:semester_start_date'],
            'semester_current' => ['nullable', 'boolean'],
        ]);

        $data['semester_current'] = $request->boolean('semester_current');

        return $data;
    }
}
