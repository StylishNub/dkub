<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<h1 class="text-2xl font-bold mt-10 mb-6 text-gray-800">📋 Manajemen Jaminan Mutu</h1>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white max-h-[500px] border border-gray-200">
    <div class="flex justify-between items-center px-4 py-3 bg-gray-100 border-b">
        <a href="jaminan_mutu/tambah_jaminan_mutu" class="inline-flex gap-2 items-center bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded-md">
            <span>Tambah Jaminan Mutu</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </a>
    </div>

    <table class="w-full text-sm text-left text-gray-800">
        <thead class="bg-slate-100 text-gray-700 sticky top-0 z-10">
            <tr>
                <th class="px-6 py-3 font-semibold">Indikator</th>
                <th class="px-6 py-3 font-semibold">Nilai</th>
                <th class="px-6 py-3 font-semibold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php foreach ($jaminanMutu as $index => $jm): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 max-w-[240px] truncate"><?= esc($jm['indikator']); ?></td>
                    <td class="px-6 py-4"><?= esc($jm['nilai']); ?></td>
                    <td class="px-6 py-4 text-center">
                        <div class="inline-flex gap-3">
                            <!-- Edit -->
                            <a href="/jaminan_mutu/edit_jaminanMutu/<?= esc($jm['id']); ?>" title="Edit">
                                <svg class="w-5 h-5 text-blue-600 hover:text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13.5l6.768-6.768a2 2 0 012.828 0l.232.232a2 2 0 010 2.828L12 18H9v-2.25l.768-.768z"/>
                                </svg>
                            </a>

                            <!-- Delete -->
                            <a href="/jaminan_mutu/delete_jaminanmutu/<?= esc($jm['id']); ?>" onclick="return confirm('Yakin ingin menghapus data Jaminan Mutu ini?');" title="Hapus">
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
