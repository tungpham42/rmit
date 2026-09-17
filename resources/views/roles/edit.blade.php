@extends('layouts.app')

@section('title', 'Edit role')

@section('content')
    <div class="max-w-lg bg-white border border-slate-200 rounded-sm p-6">
        <form action="{{ route('roles.update', $role) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Role name</label>
                <input type="text" name="role_name" value="{{ old('role_name', $role->role_name) }}"
                       class="w-full rounded-sm border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-forest-600/40 focus:border-forest-600">
                @error('role_name')
                    <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
                    Update role
                </button>
                <a href="{{ route('roles.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-300 text-slate-700 text-sm font-medium rounded-sm hover:bg-slate-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
