<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<h1 class="text-2xl font-bold mt-10 mb-6 text-gray-800">🗂️ Manajemen Program Kerja</h1>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white max-h-[500px] border border-gray-200">
    <!-- Header -->
    <div class="flex justify-between items-center px-4 py-3 bg-gray-100 border-b">
        <a href="/kelola_progja/tambah_progja" class="inline-flex gap-2 items-center bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded-md">
            <span>Tambah Program</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </a>

        <form action="/kelola_progja" method="GET" class="flex items-center space-x-2">
            <input type="text" name="keyword" class="p-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500" placeholder="Cari program..." value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
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
                <th class="px-6 py-3 font-semibold">Program Kerja</th>
                <th class="px-6 py-3 font-semibold">Deskripsi</th>
                <th class="px-6 py-3 font-semibold">Status</th>
                <th class="px-6 py-3 font-semibold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php foreach ($programs as $index => $p): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 max-w-[150px] truncate"><?= esc($p['program_kerja']); ?></td>
                    <td class="px-6 py-4 max-w-[240px] truncate"><?= esc($p['deskripsi_program']); ?></td>
                    <td class="px-6 py-4">
                        <?php if (strtolower($p['status']) === 'aktif'): ?>
                            <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">Aktif</span>
                        <?php elseif (strtolower($p['status']) === 'nonaktif'): ?>
                            <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded">Nonaktif</span>
                        <?php else: ?>
                            <span class="text-gray-500 italic"><?= esc($p['status']); ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="inline-flex gap-3">
                            <!-- Edit -->
                            <a href="/kelola_progja/edit_progja/<?= esc($p['id']); ?>" title="Edit">
                                <svg class="w-5 h-5 text-blue-600 hover:text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13.5l6.768-6.768a2 2 0 012.828 0l.232.232a2 2 0 010 2.828L12 18H9v-2.25l.768-.768z"/>
                                </svg>
                            </a>

                            <!-- Delete -->
                            <a href="/kelola_program/delete_progja/<?= esc($p['id']); ?>" onclick="return confirm('Yakin ingin menghapus data program ini?');" title="Hapus">
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
