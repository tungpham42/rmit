@extends('layouts.guest')

@section('title', 'Create account')

@section('content')
    <h1 class="text-lg font-semibold text-slate-900 mb-1">Create your account</h1>
    <p class="text-sm text-slate-500 mb-6">Takes less than a minute.</p>

    @if ($errors->any())
        <div class="mb-4 rounded-sm border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('register.attempt') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Full name</label>
            <input type="text" name="user_fullname" value="{{ old('user_fullname') }}" autofocus
                   class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" name="password"
                       class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Confirm</label>
                <input type="password" name="password_confirmation"
                       class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
            </div>
        </div>

        <button type="submit"
                class="w-full inline-flex items-center justify-center px-4 py-2 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
            Create account
        </button>
    </form>
@endsection

@section('footer-link')
    Already have an account? <a href="{{ route('login') }}" class="text-white hover:underline">Sign in</a>
@endsection
