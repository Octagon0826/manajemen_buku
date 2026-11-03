
<x-app-layout>
    <x-slot name="header">
        Edit Buku
    </x-slot>

    <div class="page-heading">
        <div>
            <h1 class="page-title">Edit Buku</h1>
            <p class="page-description">
                Perbarui informasi buku yang tersimpan.
            </p>
        </div>

        <a href="{{ route('books.index') }}" class="app-btn app-btn-primary">
            Kembali
        </a>
    </div>

    <div class="app-card">
        <form action="{{ route('books.update', $book->id) }}"
              method="POST"
              class="space-y-5">

            @csrf
            @method('PUT')

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Judul Buku
                </label>
                <input type="text" name="title"
                       value="{{ old('title', $book->title) }}"
                       class="form-control w-full" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Penulis
                </label>
                <input type="text" name="author"
                       value="{{ old('author', $book->author) }}"
                       class="form-control w-full" required>
                @error('author')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Penerbit
                </label>
                <input type="text" name="publisher"
                       value="{{ old('publisher', $book->publisher) }}"
                       class="form-control w-full">
                @error('publisher')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Tahun Terbit
                </label>
                <input type="number" name="publication_year"
                       value="{{ old('publication_year', $book->publication_year) }}"
                       class="form-control w-full">
                @error('publication_year')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    ISBN
                </label>
                <input type="text" name="isbn"
                       value="{{ old('isbn', $book->isbn) }}"
                       class="form-control w-full">
                @error('isbn')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Deskripsi
                </label>
                <textarea name="description" rows="4"
                          class="form-control w-full">{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-wrap gap-3 border-t pt-5">
                <button type="submit" class="app-btn app-btn-primary">
                    Simpan Perubahan
                </button>

                <a href="{{ route('books.index') }}"
                   class="app-btn app-btn-secondary">
                    Batal
                </a>
            </div>

        </form>
    </div>
</x-app-layout>
