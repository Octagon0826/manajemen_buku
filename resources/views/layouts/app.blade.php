<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MANABU - @if(request()->routeIs('books.*'))Manajemen Buku
    @elseif(request()->routeIs('profile.*'))Pengaturan Profil
    @elseif(request()->routeIs('users.*'))Manajemen Pengguna
    @else Dashboard
    @endif</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}?v=3">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .toast-container {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: min(380px, calc(100% - 32px));
        }

        .toast {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.13);
            border-left: 5px solid #16a34a;
            animation: toastIn 0.35s ease forwards;
            transition: opacity 0.3s, transform 0.3s;
        }

        .toast.error {
            border-left-color: #dc2626;
        }

        .toast-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #dcfce7;
            color: #15803d;
            font-weight: 800;
            flex-shrink: 0;
        }

        .toast.error .toast-icon {
            background: #fee2e2;
            color: #dc2626;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 700;
            font-size: 14px;
            color: #1f2937;
        }

        .toast-message {
            font-size: 13px;
            color: #6b7280;
            margin-top: 2px;
        }

        .toast-close {
            border: none;
            background: transparent;
            color: #9ca3af;
            font-size: 22px;
            cursor: pointer;
        }

        .toast.hide {
            opacity: 0;
            transform: translateX(30px);
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>

<div class="app-shell">

    @auth
    <aside class="app-sidebar">

        <div class="app-brand">
            <div class="app-brand-icon">MB</div>
            <div>
                <div class="app-brand-name">MANABU</div>
                <div class="app-brand-subtitle">Sistem Manajemen Buku</div>
            </div>
        </div>

        <div class="sidebar-section">MENU UTAMA</div>

        <nav class="sidebar-menu">

            <a href="{{ route('dashboard') }}"
               class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="sidebar-link-icon">▦</span>
                Dashboard
            </a>

            @can('books.view')
            <a href="{{ route('books.index') }}"
               class="sidebar-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                <span class="sidebar-link-icon">▤</span>
                Manajemen Buku
            </a>
            @endcan

            @can('users.manage')
            <a href="{{ route('users.index') }}"
               class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <span class="sidebar-link-icon">♙</span>
                Manajemen Pengguna
            </a>
            @endcan

            <a href="{{ route('profile.edit') }}"
               class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <span class="sidebar-link-icon">⚙</span>
                Pengaturan Profil
            </a>

        </nav>

        <div class="sidebar-bottom">
            <div class="sidebar-user">{{ auth()->user()->name }}</div>

            <span class="sidebar-role">
                {{ auth()->user()->getRoleNames()->first() ?? 'Pengguna' }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-logout">
                    ⇥ Keluar dari Aplikasi
                </button>
            </form>
        </div>

    </aside>
    @endauth

    <main class="app-main">

        @auth
        <header class="app-topbar">
            <div>
                <div class="app-topbar-title">
                    {{ $header ?? 'Dashboard' }}
                </div>

                <div class="app-topbar-subtitle">
                    Selamat datang di Sistem Manajemen Buku
                </div>
            </div>

            <div class="text-sm font-semibold text-gray-600">
                {{ auth()->user()->name }}
            </div>
        </header>
        @endauth

        <section class="app-content">
            {{ $slot }}
        </section>

    </main>

</div>

{{-- TOAST NOTIFICATION --}}
<div class="toast-container">

    @if (session('success'))
        <div class="toast" role="alert">
            <div class="toast-icon">✓</div>
            <div class="toast-content">
                <div class="toast-title">Berhasil!</div>
                <div class="toast-message">{{ session('success') }}</div>
            </div>
            <button type="button" class="toast-close" aria-label="Tutup">&times;</button>
        </div>
    @endif

    @if (session('error'))
        <div class="toast error" role="alert">
            <div class="toast-icon">!</div>
            <div class="toast-content">
                <div class="toast-title">Terjadi Kesalahan!</div>
                <div class="toast-message">{{ session('error') }}</div>
            </div>
            <button type="button" class="toast-close" aria-label="Tutup">&times;</button>
        </div>
    @endif

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toast').forEach(function (toast) {

            function closeToast() {
                toast.classList.add('hide');

                setTimeout(function () {
                    toast.remove();
                }, 300);
            }

            const closeButton = toast.querySelector('.toast-close');

            closeButton.addEventListener('click', closeToast);

            setTimeout(closeToast, 4000);
        });
    });
</script>

</body>
</html>