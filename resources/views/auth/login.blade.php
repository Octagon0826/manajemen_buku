@section('title', 'Login')
<x-guest-layout>

    <div class="mb-8">
        <span class="text-xs font-bold uppercase tracking-[0.2em] text-blue-600">
            Selamat Datang Kembali
        </span>

        <h2 class="mt-3 text-3xl font-extrabold text-slate-900">
            Masuk ke Akun
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Silakan masuk untuk mengakses sistem MANABU.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

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
                autofocus
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
                    autocomplete="current-password"
                    placeholder="Masukkan password"
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

        <!-- REMEMBER ME -->
        <div class="flex items-center justify-between gap-3">
            <label for="remember_me" class="flex items-center gap-2 text-sm text-slate-600">
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                >
                Ingat saya
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-xs font-semibold text-blue-600 hover:text-blue-800">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- BUTTON LOGIN -->
        <button
            type="submit"
            class="w-full rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200"
        >
            Masuk ke MANABU
        </button>
    </form>

    <div class="mt-7 border-t border-slate-100 pt-6 text-center">
        <p class="text-sm text-slate-500">
            Belum memiliki akun?
            <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-800">
                Daftar sekarang
            </a>
        </p>
    </div>

</x-guest-layout>
