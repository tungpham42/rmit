@extends('layouts.app')

@section('title', 'New post')

@section('content')
    <div class="max-w-2xl bg-white border border-slate-200 rounded-sm p-6">
        <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
            @csrf
            @include('posts._form')

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
                    Save post
                </button>
                <a href="{{ route('posts.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-300 text-slate-700 text-sm font-medium rounded-sm hover:bg-slate-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
