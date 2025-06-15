<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<!-- Greeting -->
<div class="bg-white p-6 rounded-lg shadow mb-6 border border-gray-200">
    <h2 class="text-xl font-bold text-gray-800">👋 Selamat datang di Dashboard Admin</h2>
    <p class="text-sm text-gray-600 mt-2">Pantau statistik, kelola user, dan tinjau status pengajuan kerjasama.</p>
</div>

<!-- Statistik -->
<h2 class="text-xl font-semibold text-gray-800 mb-4">📊 Statistik Umum</h2>

<!-- Baris 1: 4 item -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
    <div class="bg-white shadow rounded-lg p-4 border border-gray-200">
        <p class="text-sm text-gray-500">MOU Aktif</p>
        <p class="text-2xl font-bold text-indigo-700"><?= esc($countMouAktif) ?></p>
    </div>
    <div class="bg-white shadow rounded-lg p-4 border border-gray-200">
        <p class="text-sm text-gray-500">MOU Tidak Aktif</p>
        <p class="text-2xl font-bold text-red-700"><?= esc($countMouTidakAktif) ?></p>
    </div>
    <div class="bg-white shadow rounded-lg p-4 border border-gray-200">
        <p class="text-sm text-gray-500">Pengajuan Selesai</p>
        <p class="text-2xl font-bold text-green-700"><?= esc($countSelesai) ?></p>
    </div>
    <div class="bg-white shadow rounded-lg p-4 border border-gray-200">
        <p class="text-sm text-gray-500">Pengajuan Menunggu</p>
        <p class="text-2xl font-bold text-yellow-700"><?= esc($countMenunggu) ?></p>
    </div>
</div>

<!-- Baris 2: 3 item -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-8">
    <div class="bg-white shadow rounded-lg p-4 border border-gray-200">
        <p class="text-sm text-gray-500">Pengajuan Ditolak</p>
        <p class="text-2xl font-bold text-rose-700"><?= esc($countDitolak) ?></p>
    </div>
    <div class="bg-white shadow rounded-lg p-4 border border-gray-200">
        <p class="text-sm text-gray-500">Surat Disetujui</p>
        <p class="text-2xl font-bold text-green-700"><?= esc($countSuratSetuju) ?></p>
    </div>
    <div class="bg-white shadow rounded-lg p-4 border border-gray-200">
        <p class="text-sm text-gray-500">Surat Ditolak</p>
        <p class="text-2xl font-bold text-red-700"><?= esc($countSuratTolak) ?></p>
    </div>
</div>

<!-- 2 Kolom: User dan Pengajuan -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- KIRI: Manajemen User -->
    <div class="bg-white rounded-lg shadow p-4 border border-gray-200 max-h-[500px] overflow-y-auto scrollbar-thin">
        <h2 class="text-lg font-semibold mb-4">👤 Manajemen User</h2>
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="bg-slate-100 text-gray-700 sticky top-0 z-10">
                <tr>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                <?php foreach ($user as $u): ?>
                    <tr>
                        <td class="px-4 py-2"><?= esc($u['name']) ?></td>
                        <td class="px-4 py-2"><?= esc($u['email']) ?></td>
                        <td class="px-4 py-2"><?= esc($u['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- KANAN: Pengajuan Kerjasama -->
    <div class="bg-white rounded-lg shadow p-4 border border-gray-200 max-h-[500px] overflow-y-auto scrollbar-thin">
        <h2 class="text-lg font-semibold mb-4">📋 Pengajuan Kerjasama</h2>
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="bg-slate-100 text-gray-700 sticky top-0 z-10">
                <tr>
                    <th class="px-4 py-2">Instansi</th>
                    <th class="px-4 py-2">Status Surat</th>
                    <th class="px-4 py-2">Status Dokumen</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                <?php foreach ($pengajuan as $p): ?>
                    <tr>
                        <td class="px-4 py-2"><?= esc($p['nama_instansi_mitra']) ?></td>
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full
                                <?= ($p['status_surat'] === 'Disetujui') 
                                    ? 'bg-green-200 text-green-800' 
                                    : (($p['status_surat'] === 'Ditolak') 
                                        ? 'bg-red-200 text-red-800'
                                        : 'bg-yellow-200 text-yellow-800') ?>">
                                <?= esc($p['status_surat']) ?>
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full
                                <?= ($p['status_dokumen'] === 'Selesai') 
                                    ? 'bg-green-200 text-green-800' 
                                    : (($p['status_dokumen'] === 'Ditolak') 
                                        ? 'bg-red-200 text-red-800'
                                        : 'bg-yellow-200 text-yellow-800') ?>">
                                <?= esc($p['status_dokumen']) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Optional Custom Scrollbar -->
<style>
.scrollbar-thin::-webkit-scrollbar {
    width: 6px;
}
.scrollbar-thin::-webkit-scrollbar-thumb {
    background-color: rgba(107, 114, 128, 0.3);
    border-radius: 10px;
}
</style>

<?php $this->endSection(); ?>
