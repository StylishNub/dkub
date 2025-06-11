<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<h1 class="text-2xl font-bold mt-10 mb-6 text-gray-800">📰 Manajemen Berita</h1>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white max-h-[500px] border border-gray-200">
    <div class="flex justify-between items-center px-4 py-3 bg-gray-100 border-b">
        <a href="/kelola_berita/tambah_berita" class="inline-flex gap-2 items-center bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded-md">
            <span>Tambah Berita</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </a>
        <form action="/kelola_berita" method="GET" class="flex items-center gap-2">
            <input type="text" name="keyword" placeholder="Search..." value="<?= esc($keyword ?? '') ?>" class="p-2 rounded border text-sm" />
            <button type="submit" class="bg-white p-2 rounded border hover:bg-gray-100">
                <svg class="w-5 h-5 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 11-14 0 7 7 0 0114 0Z" />
                </svg>
            </button>
        </form>
    </div>

    <table class="w-full text-sm text-left text-gray-800">
        <thead class="bg-slate-100 text-gray-700 sticky top-0 z-10">
            <tr>
                <th class="px-6 py-3 font-semibold">Judul</th>
                <th class="px-6 py-3 font-semibold">Isi Berita</th>
                <th class="px-6 py-3 font-semibold">Kategori</th>
                <th class="px-6 py-3 font-semibold">Tanggal</th>
                <th class="px-6 py-3 font-semibold">Gambar</th>
                <th class="px-6 py-3 font-semibold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
    <?php if (empty($berita)): ?>
        <tr>
            <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">
                Belum ada data berita.
            </td>
        </tr>
    <?php else: ?>
        <?php foreach ($berita as $index => $b): ?>
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 max-w-[200px] truncate"><?= esc($b['judul']); ?></td>
                <td class="px-6 py-4 max-w-[200px] truncate"><?= esc($b['isi_berita']); ?></td>
                <td class="px-6 py-4"><?= esc($b['kategori']); ?></td>
                <td class="px-6 py-4"><?= esc($b['publish_date']); ?></td>
                <td class="px-6 py-4">
                    <?php if (!empty($b['gambar'])): ?>
                        <img src="/uploads/gambar/<?= esc($b['gambar']); ?>" alt="Gambar" class="w-20 rounded shadow" />
                    <?php else: ?>
                        <span class="italic text-gray-400">Tidak ada gambar</span>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="inline-flex gap-3">
                        <a href="/kelola_berita/edit_berita/<?= esc($b['id']); ?>" title="Edit">
                            <svg class="w-5 h-5 text-blue-600 hover:text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13.5l6.768-6.768a2 2 0 012.828 0l.232.232a2 2 0 010 2.828L12 18H9v-2.25l.768-.768z"/>
                            </svg>
                        </a>
                        <a href="/kelola_berita/delete_berita/<?= esc($b['id']); ?>" onclick="return confirm('Yakin ingin menghapus berita ini?');" title="Hapus">
                            <svg class="w-5 h-5 text-red-600 hover:text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</tbody>
    </table>
    
</div>

<?php $this->endSection(); ?>
