@extends('layouts.app')

@section('title', 'Users')

@section('header-actions')
    <a href="{{ route('users.create') }}"
       class="inline-flex items-center px-4 py-2 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
        New user
    </a>
@endsection

@section('content')
    <div class="bg-white border border-slate-200 rounded-sm overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Username</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($users as $user)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-3 text-sm text-slate-800">{{ $user->user_fullname }}</td>
                        <td class="px-6 py-3 text-sm text-slate-500">{{ $user->name }}</td>
                        <td class="px-6 py-3 text-sm text-slate-500">{{ $user->email }}</td>
                        <td class="px-6 py-3 text-sm text-slate-500">{{ $user->role?->role_name ?? '—' }}</td>
                        <td class="px-6 py-3 text-sm">
                            @if ($user->user_status)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-sm bg-forest-600/10 text-forest-700 text-xs font-medium">Active</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-sm bg-slate-100 text-slate-500 text-xs font-medium">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-right text-sm space-x-3">
                            <a href="{{ route('users.edit', $user) }}" class="text-navy-800 hover:underline font-medium">Edit</a>
                            <form id="delete-user-{{ $user->user_id }}" action="{{ route('users.destroy', $user) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button"
                                    onclick="confirmDelete('delete-user-{{ $user->user_id }}', '{{ addslashes($user->user_fullname) }}')"
                                    class="text-rose-600 hover:text-rose-800 font-medium">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-sm text-slate-400">No users yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endsection
