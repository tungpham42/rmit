@extends('layouts.app')

@section('title', 'Comments')

@section('header-actions')
    <a href="{{ route('comments.create') }}"
       class="inline-flex items-center px-4 py-2 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
        New comment
    </a>
@endsection

@section('content')
    <div class="bg-white border border-slate-200 rounded-sm overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Comment</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Post</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Author</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($comments as $comment)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-3 text-sm text-slate-800 max-w-sm truncate">{{ $comment->comment_body }}</td>
                        <td class="px-6 py-3 text-sm text-slate-500 max-w-xs truncate">{{ $comment->post?->post_title ?? '—' }}</td>
                        <td class="px-6 py-3 text-sm text-slate-500">
                            {{ $comment->comment_hide_name ? 'Hidden' : ($comment->author?->user_fullname ?? '—') }}
                        </td>
                        <td class="px-6 py-3 text-right text-sm space-x-3">
                            <a href="{{ route('comments.edit', $comment) }}" class="text-navy-800 hover:underline font-medium">Edit</a>
                            <form id="delete-comment-{{ $comment->comment_id }}" action="{{ route('comments.destroy', $comment) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button"
                                    onclick="confirmDelete('delete-comment-{{ $comment->comment_id }}', 'this comment')"
                                    class="text-rose-600 hover:text-rose-800 font-medium">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-sm text-slate-400">No comments yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $comments->links() }}
    </div>
@endsection
