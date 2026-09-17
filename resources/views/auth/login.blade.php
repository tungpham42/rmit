@extends('layouts.guest')

@section('title', 'Sign in')

@section('content')
    <h1 class="text-lg font-semibold text-slate-900 mb-1">Sign in</h1>
    <p class="text-sm text-slate-500 mb-6">Use your account email and password.</p>

    @if ($errors->any())
        <div class="mb-4 rounded-sm border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login.attempt') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" autofocus
                   class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
            <input type="password" name="password"
                   class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
        </div>

        <label class="flex items-center gap-2 text-sm text-slate-700">
            <input type="checkbox" name="remember" value="1"
                   class="rounded-sm border-slate-300 text-forest-600 focus:ring-forest-600/40">
            Remember me
        </label>

        <button type="submit"
                class="w-full inline-flex items-center justify-center px-4 py-2 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
            Sign in
        </button>
    </form>
@endsection

@section('footer-link')
    Don't have an account? <a href="{{ route('register') }}" class="text-white hover:underline">Create one</a>
@endsection
