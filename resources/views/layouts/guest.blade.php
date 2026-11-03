<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MANABU - {{ trim($__env->yieldContent('title', 'Login')) }}</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}?v=3">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <main class="min-h-screen flex items-center justify-center bg-slate-100 px-4 py-10">

        <div class="w-full max-w-5xl overflow-hidden rounded-3xl bg-white shadow-2xl md:grid md:grid-cols-2">

            <!-- PANEL KIRI -->
            <section class="relative hidden flex-col justify-between overflow-hidden bg-slate-900 p-10 text-white md:flex">

                <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-blue-600 opacity-20 blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-cyan-500 opacity-20 blur-3xl"></div>

                <div class="relative z-10">
                    <a href="/" class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-xl font-extrabold">
                            M
                        </div>

                        <div>
                            <h1 class="text-2xl font-extrabold tracking-wide">MANABU</h1>
                            <p class="text-xs tracking-widest text-blue-200">MANAJEMEN BUKU</p>
                        </div>
                    </a>
                </div>

                <div class="relative z-10 my-16">

                    <span class="text-sm font-bold uppercase tracking-[0.25em] text-blue-300">
                        Academic Management System
                    </span>

                    <h2 class="mt-5 text-4xl font-extrabold leading-tight">
                        Kelola koleksi buku dengan lebih mudah.
                    </h2>

                    <p class="mt-5 leading-7 text-slate-300">
                        Sistem informasi manajemen buku untuk membantu pengelolaan
                        data buku secara terstruktur, aman, dan efisien.
                    </p>

                    <div class="mt-8 space-y-4 text-sm text-slate-300">
                        <p>✓ Pengelolaan data buku</p>
                        <p>✓ Hak akses berdasarkan peran pengguna</p>
                        <p>✓ Sistem autentikasi yang aman</p>
                    </div>

                </div>

                <p class="relative z-10 text-xs text-slate-400">
                    © {{ date('Y') }} MANABU. Sistem Manajemen Buku.
                </p>

            </section>

            <!-- PANEL KANAN -->
            <section class="flex items-center justify-center px-6 py-10 sm:px-10">

                <div class="w-full max-w-md">

                    <div class="mb-8 text-center md:hidden">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 text-2xl font-extrabold text-white">
                            M
                        </div>

                        <h1 class="mt-3 text-2xl font-extrabold text-slate-900">
                            MANABU
                        </h1>

                        <p class="text-xs tracking-widest text-slate-500">
                            MANAJEMEN BUKU
                        </p>

                    </div>

                    {{ $slot }}

                </div>

            </section>

        </div>

    </main>

    <!-- FITUR INTIP PASSWORD -->
    <script>
        document.addEventListener('click', function (event) {

            const button = event.target.closest('[data-toggle-password]');

            if (!button) return;

            const inputId = button.getAttribute('data-toggle-password');
            const input = document.getElementById(inputId);

            if (!input) return;

            const isPassword = input.type === 'password';

            input.type = isPassword ? 'text' : 'password';

            button.textContent = isPassword ? 'Sembunyikan' : 'Lihat';

            button.setAttribute(
                'aria-label',
                isPassword ? 'Sembunyikan password' : 'Lihat password'
            );

        });
    </script>

</body>
</html>
