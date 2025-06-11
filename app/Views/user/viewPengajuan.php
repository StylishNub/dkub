<?php $this->extend('layout/templateUserLogin'); ?>

<?php $this->section('content'); ?>

<h1 class="text-2xl font-bold mt-10 mb-6 text-gray-800">Pengajuan Kerjasama</h1>

<div class="relative overflow-x-auto shadow rounded-lg bg-white border border-gray-200">
    <div class="flex justify-between items-center p-4">
        <a href="/view_pengajuan/tambah_kerjasama" class="flex items-center gap-2 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Pengajuan
        </a>
        <form action="/kelola_pengajuan" method="GET" class="flex gap-2">
            <input type="text" name="keyword" class="border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="Cari..." value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>
            </button>
        </form>
    </div>
    <table class="min-w-full text-sm text-left text-gray-800">
        <thead class="bg-[#EFF3F9] text-gray-700">
            <tr>
                <th class="px-6 py-3 font-bold">Nama Unit</th>
                <th class="px-6 py-3 font-bold">Nama PIC</th>
                <th class="px-6 py-3 font-bold">Email</th>
                <th class="px-6 py-3 font-bold">Status Surat</th>
                <th class="px-6 py-3 font-bold">Status Dokumen</th>
                <th class="px-6 py-3 font-bold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
    <?php if (empty($pengajuan)): ?>
        <tr>
            <td colspan="6" class="text-center py-6 text-gray-500 italic">
                Belum ada data kerjasama.
            </td>
        </tr>
    <?php else: ?>
        <?php foreach ($pengajuan as $item): ?>
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 whitespace-nowrap max-w-[180px] truncate"><?= esc($item['nama_instansi_mitra']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?= esc($item['email_pengguna_jawab']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?= esc($item['no_telp_mitra']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs font-semibold <?= strtolower($item['status_surat']) === 'disetujui' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' ?> rounded-full">
                        <?= esc($item['status_surat']) ?>
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs font-semibold <?= strtolower($item['status_dokumen']) === 'selesai' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' ?> rounded-full">
                        <?= esc($item['status_dokumen']) ?>
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <a href="/view_pengajuan/delete_pengajuanUser/<?= $item['id'] ?>" class="text-red-600 hover:underline text-sm font-medium" onclick="return confirm('Yakin ingin menghapus data pengajuan ini?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</tbody>

    </table>
</div>

<?php $this->endSection(); ?>
