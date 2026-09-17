@extends('layouts.app')

@section('title', 'New user')

@section('content')
    <div class="max-w-lg bg-white border border-slate-200 rounded-sm p-6">
        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Full name</label>
                <input type="text" name="user_fullname" value="{{ old('user_fullname') }}"
                       class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
                @error('user_fullname')
                    <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Alias (optional)</label>
                <input type="text" name="user_alias" value="{{ old('user_alias') }}"
                       class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
                @error('user_alias')
                    <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
                    @error('name')
                        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
                    @error('email')
                        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                <select name="role_id"
                        class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
                    <option value="">Select a role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->role_id }}" {{ old('role_id') == $role->role_id ? 'selected' : '' }}>
                            {{ $role->role_name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password"
                           class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
                    @error('password')
                        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Confirm password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
                </div>
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-700">
                <input type="hidden" name="user_status" value="0">
                <input type="checkbox" name="user_status" value="1" checked
                       class="rounded-sm border-slate-300 text-forest-600 focus:ring-forest-600/40">
                Active account
            </label>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
                    Save user
                </button>
                <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-300 text-slate-700 text-sm font-medium rounded-sm hover:bg-slate-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
