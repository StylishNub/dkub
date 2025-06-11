<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<h1 class="text-2xl font-bold mt-10 mb-6 text-gray-800">📊 Statistik MoU Aktif per Tahun</h1>

<div class="relative overflow-x-auto shadow rounded-lg bg-white border border-gray-200">
    <table class="min-w-full text-sm text-left text-gray-800">
        <thead class="bg-[#EFF3F9] text-gray-700 sticky top-0 z-10 text-sm">
            <tr>
                <th class="px-6 py-3 font-bold">Nama</th>
                <th class="px-6 py-3 font-bold">Tahun</th>
                <th class="px-6 py-3 font-bold">Jumlah</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php if (!empty($statistik)) : ?>
                <?php foreach ($statistik as $s) : ?>
                    <tr class="hover:bg-[#F5F9FF] transition">
                        <td class="px-6 py-4 whitespace-nowrap max-w-[200px] truncate font-medium">
                            <?= esc($s['nama']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= esc($s['tahun']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= esc($s['jumlah']); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" class="text-center text-gray-500 px-6 py-4">Belum ada data MoU aktif yang tersedia.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $this->endSection(); ?>
