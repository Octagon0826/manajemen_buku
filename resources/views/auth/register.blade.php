@section('title', 'Register')
<x-guest-layout>

    <div class="mb-7">
        <span class="text-xs font-bold uppercase tracking-[0.2em] text-blue-600">
            Bergabung Bersama Kami
        </span>

        <h2 class="mt-3 text-3xl font-extrabold text-slate-900">
            Buat Akun Baru
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Lengkapi data berikut untuk mendaftar ke MANABU.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- NAMA -->
        <div>
            <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
                Nama Lengkap
            </label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Masukkan nama lengkap"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
            >

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- EMAIL -->
        <div>
            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                Alamat Email
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="username"
                placeholder="nama@email.com"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
            >

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- PASSWORD -->
        <div>
            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">
                Password
            </label>

            <div class="relative">
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Buat password"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 pr-20 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                >

                <button
                    type="button"
                    data-toggle-password="password"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-bold text-blue-600 hover:text-blue-800"
                >
                    Lihat
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- KONFIRMASI PASSWORD -->
        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">
                Konfirmasi Password
            </label>

            <div class="relative">
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Ulangi password"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 pr-20 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                >

                <button
                    type="button"
                    data-toggle-password="password_confirmation"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-bold text-blue-600 hover:text-blue-800"
                >
                    Lihat
                </button>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- BUTTON REGISTER -->
        <button
            type="submit"
            class="w-full rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200"
        >
            Daftar Akun
        </button>
    </form>

    <div class="mt-6 border-t border-slate-100 pt-5 text-center">
        <p class="text-sm text-slate-500">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-800">
                Masuk di sini
            </a>
        </p>
    </div>

</x-guest-layout>
