
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;

// Halaman utama
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// ======================================
// MANAJEMEN BUKU
// ======================================

// 1. Melihat daftar buku
Route::middleware(['auth', 'permission:books.view'])->group(function () {
    Route::get('/books', [BookController::class, 'index'])
        ->name('books.index');
});

// 2. Menambah buku (Admin dan Dosen)
Route::middleware(['auth', 'permission:books.create'])->group(function () {
    Route::get('/books/create', [BookController::class, 'create'])
        ->name('books.create');

    Route::post('/books', [BookController::class, 'store'])
        ->name('books.store');
});

// 3. Mengedit buku (Admin dan Dosen)
Route::middleware(['auth', 'permission:books.edit'])->group(function () {
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])
        ->whereNumber('book')
        ->name('books.edit');

    Route::put('/books/{book}', [BookController::class, 'update'])
        ->whereNumber('book')
        ->name('books.update');
});

// 4. Menghapus buku (Hanya Admin)
Route::middleware(['auth', 'permission:books.delete'])->group(function () {
    Route::delete('/books/{book}', [BookController::class, 'destroy'])
        ->whereNumber('book')
        ->name('books.destroy');
});

// 5. Melihat detail buku
// Diletakkan paling bawah agar tidak mengganggu route lainnya.
Route::middleware(['auth', 'permission:books.view'])->group(function () {
    Route::get('/books/{book}', [BookController::class, 'show'])
        ->whereNumber('book')
        ->name('books.show');
});

// ======================================
// MANAJEMEN PENGGUNA (KHUSUS ADMIN)
// ======================================

Route::middleware(['auth', 'permission:users.manage'])->group(function () {

    Route::get('/users', [UserManagementController::class, 'index'])
        ->name('users.index');

    Route::patch('/users/{user}/role', [UserManagementController::class, 'updateRole'])
        ->whereNumber('user')
        ->name('users.updateRole');

});
// Authentication Breeze
require __DIR__.'/auth.php';
