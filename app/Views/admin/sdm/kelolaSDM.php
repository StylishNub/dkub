<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<h1 class="text-2xl font-bold mt-10 mb-6 text-gray-800">👤 Manajemen SDM</h1>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white max-h-[500px] border border-gray-200">
    <!-- Header -->
    <div class="flex justify-between items-center px-4 py-3 bg-gray-100 border-b">
        <a href="/kelola_sdm/tambah_sdm" class="inline-flex gap-2 items-center bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded-md">
            <span>Tambah SDM</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </a>

        <form action="/kelola_sdm" method="GET" class="flex items-center space-x-2">
            <input type="text" name="keyword" class="p-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500" placeholder="Cari SDM..." value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
            <button type="submit" class="p-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </form>
    </div>

    <!-- Table -->
    <table class="w-full text-sm text-left text-gray-800">
        <thead class="bg-slate-100 text-gray-700 sticky top-0 z-10">
            <tr>
                <th class="px-6 py-3 font-semibold">Nama</th>
                <th class="px-6 py-3 font-semibold">NIP/NIK</th>
                <th class="px-6 py-3 font-semibold">Jabatan</th>
                <th class="px-6 py-3 font-semibold">Pendidikan</th>
                <th class="px-6 py-3 font-semibold">Foto</th>
                <th class="px-6 py-3 font-semibold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php foreach ($sdm as $index => $s): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 max-w-[150px] truncate"><?= esc($s['nama']); ?></td>
                    <td class="px-6 py-4 max-w-[150px] truncate"><?= esc($s['nip_nik']); ?></td>
                    <td class="px-6 py-4 max-w-[180px] truncate"><?= esc($s['nama_jabatan']); ?></td>
                    <td class="px-6 py-4 max-w-[150px] truncate"><?= esc($s['pendidikan']); ?></td>
                    <td class="px-6 py-4">
                        <?php if (!empty($s['gambar'])): ?>
                            <img src="/uploads/gambar/<?= esc($s['gambar']); ?>" alt="Foto SDM" class="w-16 h-auto rounded-md shadow-sm">
                        <?php else: ?>
                            <span class="text-gray-500 italic">Tidak ada gambar</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="inline-flex gap-3">
                            <!-- Edit -->
                            <a href="/kelola_sdm/edit_sdm/<?= esc($s['id']); ?>" title="Edit">
                                <svg class="w-5 h-5 text-blue-600 hover:text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13.5l6.768-6.768a2 2 0 012.828 0l.232.232a2 2 0 010 2.828L12 18H9v-2.25l.768-.768z"/>
                                </svg>
                            </a>

                            <!-- Delete -->
                            <a href="/kelola_sdm/delete_sdm/<?= esc($s['id']); ?>" onclick="return confirm('Yakin ingin menghapus data SDM ini?');" title="Hapus">
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
    <div class="flex justify-center py-4 text-sm text-gray-700">
    <div class="inline-flex items-center space-x-3">
        <?php if ($currentPage > 1): ?>
            <a href="<?= $pager->getPageURI($currentPage - 1, 'sdm') ?>"
               class="px-3 py-1 border rounded hover:bg-gray-100">
                &laquo; Previous
            </a>
        <?php else: ?>
            <span class="px-3 py-1 border rounded text-gray-400 cursor-not-allowed">
                &laquo; Previous
            </span>
        <?php endif; ?>

        <span>Page <?= $currentPage ?> of <?= $totalPages ?></span>

        <?php if ($currentPage < $totalPages): ?>
            <a href="<?= $pager->getPageURI($currentPage + 1, 'sdm') ?>"
               class="px-3 py-1 border rounded hover:bg-gray-100">
                Next &raquo;
            </a>
        <?php else: ?>
            <span class="px-3 py-1 border rounded text-gray-400 cursor-not-allowed">
                Next &raquo;
            </span>
        <?php endif; ?>
    </div>
</div>
</div>

<?php $this->endSection(); ?>
