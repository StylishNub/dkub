<?php $this->extend('layout/templateAdmin'); ?>

<?php $this->section('content'); ?>

<h1 class="text-2xl font-bold mt-10 mb-6 text-gray-800">📋 Pengajuan Kerjasama</h1>

<div class="relative overflow-x-auto rounded-xl shadow-lg border border-gray-200 bg-white max-h-[500px]">
    <div class="flex justify-between items-center px-4 py-3 bg-gray-100 border-b">
        <form action="/kelola_pengajuan" method="GET" class="flex items-center space-x-2 w-full max-w-sm ml-auto">
            <input
                type="text"
                name="keyword"
                class="w-full p-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Cari pengajuan..."
                value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>"
            >
            <button type="submit" class="p-2 bg-indigo-600 hover:bg-indigo-700 rounded-md">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </form>
    </div>

    <table class="w-full text-sm text-left text-gray-700">
        <thead class="bg-slate-100 text-gray-700 sticky top-0 z-10">
            <tr>
                <th class="px-6 py-3 font-semibold whitespace-nowrap">Nama Unit</th>
                <th class="px-6 py-3 font-semibold whitespace-nowrap">Nama PIC</th>
                <th class="px-6 py-3 font-semibold whitespace-nowrap">Email</th>
                <th class="px-6 py-3 font-semibold whitespace-nowrap">Status Surat</th>
                <th class="px-6 py-3 font-semibold whitespace-nowrap">Status Dokumen</th>
                <th class="px-6 py-3 font-semibold whitespace-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php foreach ($pengajuan as $item): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4"><?= esc($item['nama_instansi_mitra']); ?></td>
                    <td class="px-6 py-4"><?= esc($item['email_pengguna_jawab']); ?></td>
                    <td class="px-6 py-4"><?= esc($item['no_telp_mitra']); ?></td>
                    <td class="px-6 py-4">
                        <span class="inline-block px-2 py-1 text-xs font-semibold text-white rounded-full 
                            <?= $item['status_surat'] === 'Menunggu' ? 'bg-yellow-500' : ($item['status_surat'] === 'Disetujui' ? 'bg-green-500' : 'bg-red-500') ?>">
                            <?= esc($item['status_surat']); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">
                            <?= esc($item['status_dokumen']); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="/kelola_pengajuan/detail_pengajuan/<?= $item['id']; ?>"
                           class="text-indigo-600 hover:underline text-sm">Lihat</a>
                        <span class="text-gray-300">|</span>
                        <a href="/kelola_pengajuan/delete_pengajuan/<?= $item['id']; ?>"
                           onclick="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?');"
                           class="text-red-500 hover:underline text-sm">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php $this->endSection(); ?>
