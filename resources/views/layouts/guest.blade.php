<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sign in') · Coursebook</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Source+Serif+4:opsz,wght@8..60,600&display=swap" rel="stylesheet">

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
                    },
                }
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="font-sans bg-navy-950 text-slate-800 antialiased min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <span class="font-serif text-2xl text-white tracking-tight">Coursebook</span>
        </div>

        <div class="bg-white rounded-sm border border-slate-200 p-8">
            @yield('content')
        </div>

        <p class="text-center text-xs text-slate-500 mt-6">
            @yield('footer-link')
        </p>
    </div>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: @json(session('success')),
                toast: true,
                position: 'top-end',
                timer: 2500,
                showConfirmButton: false,
            });
        @endif
    </script>
</body>
</html>
