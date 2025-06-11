<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<h1 class="text-2xl font-bold mt-10 mb-6 text-gray-800">📊 Dashboard</h1>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- KIRI: Manajemen User -->
    <div class="bg-white rounded-lg shadow p-4 border border-gray-200 overflow-auto max-h-[500px]">
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

    <!-- KANAN: Kelola Pengajuan -->
    <div class="bg-white rounded-lg shadow p-4 border border-gray-200 overflow-auto max-h-[500px]">
        <h2 class="text-lg font-semibold mb-4">📋 Pengajuan Kerjasama</h2>
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="bg-slate-100 text-gray-700 sticky top-0 z-10">
                <tr>
                    <th class="px-4 py-2">Instansi</th>
                    <th class="px-4 py-2">PIC</th>
                    <th class="px-4 py-2">Status Surat</th>
                    <th class="px-4 py-2">Status Dokumen</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                <?php foreach ($pengajuan as $p): ?>
                    <tr>
                        <td class="px-4 py-2"><?= esc($p['nama_instansi_mitra']) ?></td>
                        <td class="px-4 py-2"><?= esc($p['email_pengguna_jawab']) ?></td>

                        <!-- Status Surat -->
                        <td class="px-4 py-2">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded
                                <?= ($p['status_surat'] === 'Disetujui') 
                                    ? 'bg-green-100 text-green-800' 
                                    : 'bg-yellow-100 text-yellow-800' ?>">
                                <?= esc($p['status_surat']) ?>
                            </span>
                        </td>

                        <!-- Status Dokumen -->
                        <td class="px-4 py-2">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded
                                <?= ($p['status_dokumen'] === 'Disetujui') 
                                    ? 'bg-green-100 text-green-800' 
                                    : 'bg-yellow-100 text-yellow-800' ?>">
                                <?= esc($p['status_dokumen']) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->endSection(); ?>
