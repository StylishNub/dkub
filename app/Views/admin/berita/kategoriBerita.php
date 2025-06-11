<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<h1 class="text-2xl font-bold mt-10 mb-6 text-gray-800">🗂️ Manajemen Kategori Berita</h1>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white max-h-[500px] border border-gray-200">
    <div class="flex justify-between items-center px-4 py-3 bg-gray-100 border-b">
        <a href="/kelola_kategori_berita/tambah_kategori_berita" class="inline-flex gap-2 items-center bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded-md">
            <span>Tambah Kategori</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </a>
    </div>

    <table class="w-full text-sm text-left text-gray-800">
        <thead class="bg-slate-100 text-gray-700 sticky top-0 z-10">
            <tr>
                <th class="px-6 py-3 font-semibold">Nama Kategori</th>
                <th class="px-6 py-3 font-semibold">Deskripsi</th>
                <th class="px-6 py-3 font-semibold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php foreach ($kategoriBerita as $index => $kb): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 max-w-[200px] truncate"><?= esc($kb['nama']); ?></td>
                    <td class="px-6 py-4 max-w-[400px] truncate"><?= esc($kb['deskripsi']); ?></td>
                    <td class="px-6 py-4 text-center">
                        <div class="inline-flex gap-3">
                            <a href="/kelola_kategori_berita/edit_kategoriBerita/<?= esc($kb['id']); ?>" title="Edit">
                                <svg class="w-5 h-5 text-blue-600 hover:text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13.5l6.768-6.768a2 2 0 012.828 0l.232.232a2 2 0 010 2.828L12 18H9v-2.25l.768-.768z"/>
                                </svg>
                            </a>
                            <a href="/kelola_kategori_berita/delete_kategori_berita/<?= esc($kb['id']); ?>" onclick="return confirm('Yakin ingin menghapus kategori ini?');" title="Hapus">
                                <svg class="w-5 h-5 text-red-600 hover:text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php $this->endSection(); ?>
