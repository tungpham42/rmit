@extends('layouts.app')

@section('title', 'Posts')

@section('header-actions')
    <a href="{{ route('posts.create') }}"
       class="inline-flex items-center px-4 py-2 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
        New post
    </a>
@endsection

@section('content')
    <div class="bg-white border border-slate-200 rounded-sm overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Course</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Comments</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($posts as $post)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-3 text-sm text-slate-800 max-w-xs truncate">{{ $post->post_title }}</td>
                        <td class="px-6 py-3 text-sm text-slate-500">{{ $post->course?->course_code ?? '—' }}</td>
                        <td class="px-6 py-3 text-sm text-slate-500">
                            {{ $post->post_hide_name ? 'Hidden' : ($post->author?->user_fullname ?? '—') }}
                        </td>
                        <td class="px-6 py-3 text-sm text-slate-500">{{ $post->comments_count }}</td>
                        <td class="px-6 py-3 text-sm">
                            @if ($post->post_current)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-sm bg-forest-600/10 text-forest-700 text-xs font-medium">Current</span>
                            @else
                                <span class="text-slate-400 text-xs">Archived</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-right text-sm space-x-3">
                            <a href="{{ route('posts.edit', $post) }}" class="text-navy-800 hover:underline font-medium">Edit</a>
                            <form id="delete-post-{{ $post->post_id }}" action="{{ route('posts.destroy', $post) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button"
                                    onclick="confirmDelete('delete-post-{{ $post->post_id }}', '{{ addslashes($post->post_title) }}')"
                                    class="text-rose-600 hover:text-rose-800 font-medium">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-sm text-slate-400">No posts yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
@endsection
