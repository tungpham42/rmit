<!DOCTYPE html>
<html lang="en" x-data="{ navOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Coursebook') · Coursebook</title>
    <meta name="description" content="@yield('meta_description', 'Course notes, past questions and answers, organized by course and semester.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Source+Serif+4:opsz,wght@8..60,500;8..60,600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                        serif: ['"Source Serif 4"', 'ui-serif', 'serif'],
                    },
                    colors: {
                        navy: { 950: '#0E1A2E', 900: '#14213D', 800: '#1B2D52', 700: '#26386B' },
                        forest: { 600: '#0F6B5C', 700: '#0B5348' },
                        paper: '#F7F7F4',
                    },
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="font-sans bg-paper text-slate-800 antialiased">

    <header class="border-b border-slate-200 bg-paper/95 backdrop-blur sticky top-0 z-30">
        <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-serif text-xl text-navy-900 tracking-tight">Coursebook</a>

            <nav class="hidden md:flex items-center gap-8 text-sm text-slate-600">
                <a href="{{ route('home') }}#features" class="hover:text-navy-900">Features</a>
                <a href="{{ route('home') }}#how-it-works" class="hover:text-navy-900">How it works</a>
            </nav>

            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-700 hover:text-navy-900">Sign in</a>
                <a href="{{ route('register') }}"
                   class="inline-flex items-center px-4 py-2 bg-forest-600 text-white text-sm font-medium rounded-sm hover:bg-forest-700">
                    Get started
                </a>
            </div>

            <button @click="navOpen = !navOpen" class="md:hidden text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div x-cloak x-show="navOpen" class="md:hidden border-t border-slate-200 px-6 py-4 space-y-3 text-sm">
            <a href="{{ route('home') }}#features" class="block text-slate-600">Features</a>
            <a href="{{ route('home') }}#how-it-works" class="block text-slate-600">How it works</a>
            <a href="{{ route('login') }}" class="block text-slate-700 font-medium">Sign in</a>
            <a href="{{ route('register') }}" class="block text-forest-700 font-medium">Get started</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="border-t border-slate-200">
        <div class="max-w-6xl mx-auto px-6 py-10 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-slate-500">
            <span class="font-serif text-navy-900">Coursebook</span>
            <div class="flex items-center gap-6">
                <a href="{{ route('login') }}" class="hover:text-navy-900">Sign in</a>
                <a href="{{ route('register') }}" class="hover:text-navy-900">Create account</a>
            </div>
            <span>&copy; {{ date('Y') }} Coursebook</span>
        </div>
    </footer>

</body>
</html>
