
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Buku
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- NOTIFIKASI BERHASIL -->
            @if (session('success'))
                <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-green-800">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">✓</span>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6">

                <!-- HEADER -->
                <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">
                            Daftar Buku
                        </h3>
                        <p class="text-sm text-gray-500">
                            Kelola dan lihat koleksi buku.
                        </p>
                    </div>

                    @can('books.create')
                        <a href="{{ route('books.create') }}"
                           class="px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-sm">
                            + Tambah Buku
                        </a>
                    @endcan
                </div>

                <!-- TABEL BUKU -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="bg-gray-100 text-gray-700 uppercase">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Judul Buku</th>
                                <th class="px-4 py-3">Penulis</th>
                                <th class="px-4 py-3">Penerbit</th>
                                <th class="px-4 py-3">Tahun</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($books as $book)
                                <tr class="border-b hover:bg-gray-50 transition">

                                    <td class="px-4 py-3">
                                        {{ $books->firstItem() + $loop->index }}
                                    </td>

                                    <td class="px-4 py-3 font-semibold text-gray-900">
                                        {{ $book->title }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $book->author }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $book->publisher ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $book->publication_year ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex justify-center items-center gap-3">

                                            <a href="{{ route('books.show', $book) }}"
                                               class="font-medium text-blue-600 hover:text-blue-800">
                                                Detail
                                            </a>

                                            @can('books.edit')
                                                <a href="{{ route('books.edit', $book) }}"
                                                   class="font-medium text-yellow-600 hover:text-yellow-700">
                                                    Edit
                                                </a>
                                            @endcan

                                            @can('books.delete')
                                                <button
                                                    type="button"
                                                    data-delete-url="{{ route('books.destroy', $book) }}"
                                                    data-book-title="{{ $book->title }}"
                                                    class="font-medium text-red-600 hover:text-red-800">
                                                    Hapus
                                                </button>
                                            @endcan

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-8 text-gray-500">
                                        Belum ada data buku.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="mt-5">
                    {{ $books->links() }}
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL KONFIRMASI HAPUS -->
    @can('books.delete')
        <div id="deleteModal"
             class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-950/60 px-4 backdrop-blur-sm">

            <div id="deleteModalContent"
                 class="w-full max-w-md scale-95 rounded-2xl bg-white p-7 shadow-2xl transition-all duration-200">

                <!-- IKON PERINGATAN -->
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-8 w-8 text-red-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                </div>

                <!-- JUDUL -->
                <div class="mt-5 text-center">
                    <h3 class="text-xl font-extrabold text-gray-900">
                        Hapus Buku?
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-gray-500">
                        Apakah kamu yakin ingin menghapus buku
                        <span id="deleteBookTitle"
                              class="font-bold text-gray-800"></span>?
                    </p>

                    <p class="mt-2 text-xs text-red-500">
                        Data buku yang dihapus tidak dapat dikembalikan.
                    </p>
                </div>

                <!-- TOMBOL -->
                <div class="mt-7 flex gap-3">

                    <button type="button"
                            id="cancelDelete"
                            class="flex-1 rounded-xl border border-gray-200 px-4 py-3 text-sm font-bold text-gray-600 transition hover:bg-gray-100">
                        Batal
                    </button>

                    <form id="deleteForm" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="w-full rounded-xl bg-red-600 px-4 py-3 text-sm font-bold text-white transition hover:bg-red-700">
                            Ya, Hapus
                        </button>
                    </form>

                </div>
            </div>
        </div>
    @endcan

    <!-- JAVASCRIPT MODAL -->
    @can('books.delete')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('deleteModal');
                const modalContent = document.getElementById('deleteModalContent');
                const deleteForm = document.getElementById('deleteForm');
                const bookTitle = document.getElementById('deleteBookTitle');
                const cancelButton = document.getElementById('cancelDelete');

                if (!modal || !deleteForm) return;

                function openModal(url, title) {
                    deleteForm.action = url;
                    bookTitle.textContent = title;

                    modal.classList.remove('hidden');
                    modal.classList.add('flex');

                    requestAnimationFrame(() => {
                        modalContent.classList.remove('scale-95');
                        modalContent.classList.add('scale-100');
                    });

                    document.body.style.overflow = 'hidden';
                    cancelButton.focus();
                }

                function closeModal() {
                    modalContent.classList.remove('scale-100');
                    modalContent.classList.add('scale-95');

                    modal.classList.add('hidden');
                    modal.classList.remove('flex');

                    document.body.style.overflow = '';
                }

                document.querySelectorAll('[data-delete-url]').forEach(button => {
                    button.addEventListener('click', function () {
                        openModal(
                            this.dataset.deleteUrl,
                            this.dataset.bookTitle
                        );
                    });
                });

                cancelButton.addEventListener('click', closeModal);

                modal.addEventListener('click', function (event) {
                    if (event.target === modal) {
                        closeModal();
                    }
                });

                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                        closeModal();
                    }
                });
            });
        </script>
    @endcan

</x-app-layout>
