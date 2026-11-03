<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with('roles')
            ->latest()
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        // Admin tidak boleh mengubah role akunnya sendiri.
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'Role akun sendiri tidak dapat diubah.');
        }

        $validated = $request->validate([
            'role' => [
                'required',
                Rule::in(['admin', 'dosen', 'mahasiswa']),
            ],
        ]);

        // Mengganti role pengguna.
        $user->syncRoles([$validated['role']]);

        return redirect()->route('users.index')
            ->with('success', 'Role pengguna berhasil diperbarui.');
    }
}
