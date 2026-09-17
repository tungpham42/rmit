@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-xl font-bold text-slate-900">Search Results</h1>
        <p class="text-xs text-slate-500 mt-1">Showing search results for: "<span class="font-semibold text-slate-800">{{ $query }}</span>"</p>
    </div>

    <div id="feeds">
        @if(empty($query))
            <div class="bg-amber-50 border border-amber-200 text-amber-800 rounded-xl p-4 text-sm font-medium">
                Please type a keyword into the search bar to search.
            </div>
        @else
            @forelse($posts as $post)
                <x-post-card :post="$post" />
            @empty
                <div class="bg-white rounded-xl border border-slate-200 p-8 text-center text-slate-500">
                    No matching questions found for "{{ $query }}".
                </div>
            @endforelse

            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
