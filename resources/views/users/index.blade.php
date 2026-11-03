
<x-app-layout>
    <x-slot name="header">
        Manajemen Pengguna
    </x-slot>

    <div class="space-y-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Manajemen Pengguna
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola akun dan hak akses pengguna MANABU.
            </p>
        </div>

        <div class="app-card">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">
                        Daftar Pengguna
                    </h2>
                    <p class="text-sm text-gray-500">
                        Atur role setiap pengguna aplikasi.
                    </p>
                </div>

                <span class="text-sm font-semibold text-gray-500">
                    Total: {{ $users->total() }} pengguna
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="app-table w-full">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Role Saat Ini</th>
                            <th>Ubah Role</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    {{ $users->firstItem() + $loop->index }}
                                </td>

                                <td class="font-semibold text-gray-800">
                                    {{ $user->name }}

                                    @if ($user->id === auth()->id())
                                        <span class="text-xs text-blue-600">
                                            (Akun Anda)
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $user->email }}</td>

                                <td>
                                    @php
                                        $role = $user->getRoleNames()->first() ?? 'Belum memiliki role';
                                    @endphp

                                    <span class="px-3 py-1 rounded-full text-xs font-bold
                                        {{ $role === 'admin' ? 'bg-purple-100 text-purple-700' : '' }}
                                        {{ $role === 'dosen' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $role === 'mahasiswa' ? 'bg-green-100 text-green-700' : '' }}">
                                        {{ ucfirst($role) }}
                                    </span>
                                </td>

                                <td>
                                    @if ($user->id !== auth()->id())
                                        <form method="POST"
                                              action="{{ route('users.updateRole', $user) }}"
                                              class="flex items-center gap-2">

                                            @csrf
                                            @method('PATCH')

                                            <select name="role"
                                                    class="form-control text-sm"
                                                    required>

                                                <option value="admin"
                                                    {{ $role === 'admin' ? 'selected' : '' }}>
                                                    Admin
                                                </option>

                                                <option value="dosen"
                                                    {{ $role === 'dosen' ? 'selected' : '' }}>
                                                    Dosen
                                                </option>

                                                <option value="mahasiswa"
                                                    {{ $role === 'mahasiswa' ? 'selected' : '' }}>
                                                    Mahasiswa
                                                </option>

                                            </select>

                                            <button type="submit"
                                                    class="app-btn app-btn-primary text-sm">
                                                Simpan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-gray-400">
                                            Tidak dapat diubah
                                        </span>
                                    @endif
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-gray-500">
                                    Belum ada pengguna.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                {{ $users->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
