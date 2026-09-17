@extends('layouts.app')

@section('title', 'New comment')

@section('content')
    <div class="max-w-lg bg-white border border-slate-200 rounded-sm p-6">
        <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
            @csrf
            @include('comments._form')

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
                    Save comment
                </button>
                <a href="{{ route('comments.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-300 text-slate-700 text-sm font-medium rounded-sm hover:bg-slate-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
