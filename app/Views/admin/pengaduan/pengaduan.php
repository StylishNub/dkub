<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<h1 class="text-2xl font-bold mt-10 mb-6 text-gray-800">📨 Manajemen Pengaduan</h1>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white  border border-gray-200">
    <!-- Header Filter -->
    <div class="flex justify-between items-center px-4 py-3 bg-gray-100 border-b">
        <form action="/kelola_pengaduan" method="GET" class="flex items-center space-x-2">
            <input type="text" name="keyword" class="p-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500" placeholder="Cari..." value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
            <button type="submit" class="p-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </form>
    </div>

    <!-- Tabel -->
<!-- Tabel -->
<div class="w-full overflow-x-auto">
    <table class="min-w-[900px] text-sm text-left text-gray-800">
        <thead class="bg-slate-100 text-gray-700 sticky top-0 z-10">
            <tr>
                <th class="px-6 py-3 font-semibold">Nama</th>
                <th class="px-6 py-3 font-semibold">Instansi</th>
                <th class="px-6 py-3 font-semibold">Email</th>
                <th class="px-6 py-3 font-semibold">No HP</th>
                <th class="px-6 py-3 font-semibold min-w-[250px]">Pertanyaan</th>
                <th class="px-6 py-3 font-semibold min-w-[250px]">Balasan</th>
                <th class="px-6 py-3 font-semibold">Bukti Upload</th>
                <th class="px-6 py-3 font-semibold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php foreach ($pengaduan as $index => $p): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 truncate max-w-[160px]"><?= esc($p['nama']); ?></td>
                    <td class="px-6 py-4 truncate max-w-[160px]"><?= esc($p['instansi']); ?></td>
                    <td class="px-6 py-4 truncate max-w-[160px]"><?= esc($p['email']); ?></td>
                    <td class="px-6 py-4 truncate max-w-[120px]"><?= esc($p['no_hp']); ?></td>
                    <td class="px-6 py-4 truncate max-w-[300px]"><?= esc($p['pertanyaan']); ?></td>
                    <td class="px-6 py-4 truncate max-w-[300px]"><?= esc($p['balasan']); ?></td>
                    <td class="px-6 py-4">
                        <?php if (!empty($p['bukti_upload'])): ?>
                            <a href="/uploads/dokumen/<?= esc($p['bukti_upload']); ?>" target="_blank" class="text-blue-600 hover:underline">Lihat Bukti</a>
                        <?php else: ?>
                            <span class="text-gray-500 italic">Tidak ada</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="inline-flex gap-3 justify-center">
                            <a href="/kelola_pengaduan/balas/<?= esc($p['id']) ?>" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 text-xs rounded font-medium">Balas</a>
                            <a href="/kelola_pengaduan/delete_pengaduan/<?= esc($p['id']); ?>" onclick="return confirm('Yakin ingin menghapus pengaduan ini?');" title="Hapus">
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

</div>

<?php $this->endSection(); ?>
