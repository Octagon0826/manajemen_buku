
<x-app-layout>
    <x-slot name="header">
        Detail Buku
    </x-slot>

    <div class="page-heading">
        <div>
            <h1 class="page-title">Detail Buku</h1>
            <p class="page-description">
                Informasi lengkap mengenai buku yang dipilih.
            </p>
        </div>

        <a href="{{ route('books.index') }}" class="app-btn app-btn-primary">
            Kembali
        </a>
    </div>

    <div class="app-card">
        <div class="space-y-5">

            <div>
                <p class="text-sm text-gray-500">Judul Buku</p>
                <h2 class="text-xl font-bold text-gray-800">
                    {{ $book->title }}
                </h2>
            </div>

            <div>
                <p class="text-sm text-gray-500">Penulis</p>
                <p class="font-semibold text-gray-800">{{ $book->author }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Penerbit</p>
                <p class="text-gray-800">{{ $book->publisher ?: '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Tahun Terbit</p>
                <p class="text-gray-800">{{ $book->publication_year ?: '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">ISBN</p>
                <p class="text-gray-800">{{ $book->isbn ?: '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Deskripsi</p>
                <p class="text-gray-800 whitespace-pre-line">
                    {{ $book->description ?: 'Tidak ada deskripsi.' }}
                </p>
            </div>

        </div>

        @can('books.edit')
            <div class="mt-7 border-t pt-5">
                <a href="{{ route('books.edit', $book->id) }}"
                   class="app-btn app-btn-primary">
                    Edit Buku
                </a>
            </div>
        @endcan
    </div>
</x-app-layout>
