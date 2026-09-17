@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <a href="javascript:history.back()" class="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-brand-600 mb-4 transition font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to feed
        </a>

        <x-post-card :post="$post" />
    </div>
@endsection
