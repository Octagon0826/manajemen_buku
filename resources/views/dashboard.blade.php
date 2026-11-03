
<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="page-heading">
        <div>
            <h1 class="page-title">
                Selamat Datang, {{ auth()->user()->name }}!
            </h1>
            <p class="page-description">
                Sistem Informasi Manajemen Buku.
                Kelola koleksi buku dengan mudah dan terstruktur.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div class="app-card">
            <div class="text-sm text-gray-500 font-semibold">
                STATUS AKUN
            </div>
            <div class="text-2xl font-bold text-blue-600 mt-3">
                Aktif
            </div>
            <p class="text-sm text-gray-500 mt-2">
                Akun berhasil masuk ke sistem.
            </p>
        </div>

        <div class="app-card">
            <div class="text-sm text-gray-500 font-semibold">
                ROLE PENGGUNA
            </div>
            <div class="text-2xl font-bold text-blue-600 mt-3 capitalize">
                {{ auth()->user()->getRoleNames()->first() ?? 'Pengguna' }}
            </div>
            <p class="text-sm text-gray-500 mt-2">
                Hak akses berdasarkan role akun.
            </p>
        </div>

    </div>

    <div class="app-card mt-6">
        <h3 class="text-lg font-bold text-gray-800">
            Menu Manajemen Buku
        </h3>

        <p class="text-sm text-gray-500 mt-2 mb-5">
            Akses koleksi buku sesuai hak akses akun Anda.
        </p>

        @can('books.view')
            <a href="{{ route('books.index') }}"
               class="app-btn app-btn-primary">
                Buka Manajemen Buku →
            </a>
        @endcan
    </div>
</x-app-layout>
