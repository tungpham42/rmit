@extends('layouts.marketing')

@section('title', 'Coursebook — course notes, organized')
@section('meta_description', 'Every past question, answer, and thread for your courses — organized by semester, ranked by votes, easy to find again.')

@section('content')

    {{-- Hero --}}
    <section class="max-w-6xl mx-auto px-6 pt-16 pb-20 md:pt-24 md:pb-28 grid md:grid-cols-2 gap-14 items-center">
        <div>
            <p class="text-sm font-medium text-forest-700 mb-4">For students and course coordinators</p>
            <h1 class="font-serif text-4xl md:text-5xl leading-tight text-navy-900">
                The question your classmate already asked is already answered here.
            </h1>
            <p class="mt-6 text-base text-slate-600 max-w-md">
                Coursebook keeps every question, answer, and thread from your courses in one place —
                sorted by semester, ranked by votes, and searchable long after the exam is over.
            </p>

            <div class="mt-8 flex items-center gap-4">
                <a href="{{ route('register') }}"
                   class="inline-flex items-center px-5 py-3 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
                    Get started
                </a>
                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-700 hover:text-navy-900">
                    Sign in
                </a>
            </div>
        </div>

        {{-- Mock post card --}}
        <div class="relative">
            <div class="bg-white border border-slate-200 rounded-sm shadow-sm p-5">
                <div class="flex items-center gap-2 mb-3">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-sm bg-navy-900/5 text-navy-800 text-xs font-medium">MKT2050</span>
                    <span class="text-xs text-slate-400">Week 7 · 2026B</span>
                </div>

                <p class="text-sm font-medium text-slate-900">
                    Is the elasticity formula on the final the same as the one in lecture 4, or the revised one from the tutorial?
                </p>

                <div class="mt-3 pl-3 border-l-2 border-forest-600/30">
                    <p class="text-sm text-slate-600">
                        Revised one — the tutor confirmed it in week 8. Original formula still works for
                        the practice set though.
                    </p>
                    <p class="mt-1 text-xs text-slate-400">Answered by a coursemate</p>
                </div>

                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <div class="flex items-center gap-4">
                        <span class="inline-flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-forest-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 3l7 8h-4v6H7v-6H3l7-8z"/></svg>
                            24
                        </span>
                        <span>6 comments</span>
                    </div>
                    <span class="text-forest-700 font-medium">Following</span>
                </div>
            </div>

            <div class="hidden md:block absolute -bottom-4 -left-4 w-full h-full border border-slate-200 rounded-sm -z-10 bg-white"></div>
        </div>
    </section>

    {{-- Features --}}
    <section id="features" class="border-t border-slate-200 bg-white">
        <div class="max-w-6xl mx-auto px-6 py-20">
            <h2 class="font-serif text-2xl text-navy-900 max-w-md">
                Built around how a semester actually runs.
            </h2>

            <div class="mt-12 grid md:grid-cols-2 gap-x-12 gap-y-10">
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-sm bg-forest-600/10 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-forest-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6h16M4 12h16M4 18h7"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-slate-900">Sorted by course and semester</h3>
                        <p class="mt-1 text-sm text-slate-600">Nothing gets buried in a group chat. Every post lives under its course and the week it was asked.</p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-sm bg-forest-600/10 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-forest-700" fill="currentColor" viewBox="0 0 20 20"><path d="M10 3l7 8h-4v6H7v-6H3l7-8z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-slate-900">The best answer rises</h3>
                        <p class="mt-1 text-sm text-slate-600">Upvotes push the right answer to the top, so you don't have to read six replies to trust one.</p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-sm bg-forest-600/10 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-forest-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-slate-900">Follow the threads that matter</h3>
                        <p class="mt-1 text-sm text-slate-600">Follow a post and get back to it easily when the answer changes closer to the exam.</p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-sm bg-forest-600/10 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-forest-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-slate-900">Ask without your name attached</h3>
                        <p class="mt-1 text-sm text-slate-600">Post or comment with your name hidden when you'd rather keep a silly question anonymous.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How it works --}}
    <section id="how-it-works" class="max-w-6xl mx-auto px-6 py-20">
        <h2 class="font-serif text-2xl text-navy-900 max-w-md">From first question to finals.</h2>

        <div class="mt-12 grid md:grid-cols-3 gap-10">
            <div class="pt-6 border-t-2 border-navy-900">
                <span class="text-sm text-slate-400">1</span>
                <h3 class="mt-2 text-sm font-semibold text-slate-900">Join your course</h3>
                <p class="mt-1 text-sm text-slate-600">Find your course by its code and semester, and see every post already shared there.</p>
            </div>
            <div class="pt-6 border-t-2 border-navy-900">
                <span class="text-sm text-slate-400">2</span>
                <h3 class="mt-2 text-sm font-semibold text-slate-900">Ask or answer</h3>
                <p class="mt-1 text-sm text-slate-600">Post a question, or add the answer you worked out — attach a link if it helps.</p>
            </div>
            <div class="pt-6 border-t-2 border-navy-900">
                <span class="text-sm text-slate-400">3</span>
                <h3 class="mt-2 text-sm font-semibold text-slate-900">Vote and follow</h3>
                <p class="mt-1 text-sm text-slate-600">Upvote the answer that actually worked, and follow the post so you don't lose it.</p>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-navy-900">
        <div class="max-w-6xl mx-auto px-6 py-16 text-center">
            <h2 class="font-serif text-2xl md:text-3xl text-white max-w-lg mx-auto">
                Your next assignment question has probably already been asked.
            </h2>
            <a href="{{ route('register') }}"
               class="mt-8 inline-flex items-center px-6 py-3 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
                Create your account
            </a>
        </div>
    </section>

@endsection
