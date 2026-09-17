@extends('layouts.app')

@section('title', 'Semesters')

@section('header-actions')
    <a href="{{ route('semesters.create') }}"
       class="inline-flex items-center px-4 py-2 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
        New semester
    </a>
@endsection

@section('content')
    <div class="bg-white border border-slate-200 rounded-sm overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Start</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">End</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Current</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($semesters as $semester)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-3 text-sm text-slate-800">{{ $semester->semester_code }}</td>
                        <td class="px-6 py-3 text-sm text-slate-500">{{ $semester->semester_start_date->format('d M Y') }}</td>
                        <td class="px-6 py-3 text-sm text-slate-500">{{ $semester->semester_end_date->format('d M Y') }}</td>
                        <td class="px-6 py-3 text-sm">
                            @if ($semester->semester_current)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-sm bg-forest-600/10 text-forest-700 text-xs font-medium">Current</span>
                            @else
                                <span class="text-slate-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-right text-sm space-x-3">
                            <a href="{{ route('semesters.edit', $semester) }}" class="text-navy-800 hover:underline font-medium">Edit</a>
                            <form id="delete-semester-{{ $semester->semester_id }}" action="{{ route('semesters.destroy', $semester) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button"
                                    onclick="confirmDelete('delete-semester-{{ $semester->semester_id }}', '{{ addslashes($semester->semester_code) }}')"
                                    class="text-rose-600 hover:text-rose-800 font-medium">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-sm text-slate-400">No semesters yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $semesters->links() }}
    </div>
@endsection
