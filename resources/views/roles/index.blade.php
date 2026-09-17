@extends('layouts.app')

@section('title', 'Roles')

@section('header-actions')
    <a href="{{ route('roles.create') }}"
       class="inline-flex items-center px-4 py-2 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
        New role
    </a>
@endsection

@section('content')
    <div class="bg-white border border-slate-200 rounded-sm overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Role name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Users</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($roles as $role)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-3 text-sm text-slate-800">{{ $role->role_name }}</td>
                        <td class="px-6 py-3 text-sm text-slate-500">{{ $role->users_count }}</td>
                        <td class="px-6 py-3 text-right text-sm space-x-3">
                            <a href="{{ route('roles.edit', $role) }}" class="text-navy-800 hover:underline font-medium">Edit</a>
                            <form id="delete-role-{{ $role->role_id }}" action="{{ route('roles.destroy', $role) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button"
                                    onclick="confirmDelete('delete-role-{{ $role->role_id }}', '{{ addslashes($role->role_name) }}')"
                                    class="text-rose-600 hover:text-rose-800 font-medium">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-sm text-slate-400">No roles yet. Add one to get started.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $roles->links() }}
    </div>
@endsection
