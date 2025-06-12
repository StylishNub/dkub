<?php $this->extend('layout/templateUserLogin'); ?>
<?php $this->section('content'); ?>

<div class="max-w-5xl mx-auto px-4 py-10 space-y-10 bg-slate-100 min-h-screen">

    <h1 class="text-4xl font-bold text-center text-indigo-800">Detail Pengajuan Kerjasama</h1>

    <div class="rounded-xl overflow-hidden shadow-xl ring-1 ring-slate-300 bg-white">

        <!-- Header Mitra -->
        <div class="bg-gradient-to-r from-indigo-700 to-blue-600 px-6 py-4">
            <h2 class="text-2xl font-semibold text-white">🧾 Informasi Mitra</h2>
        </div>

<!-- Isi Mitra -->
     <div class="px-6 py-6 space-y-6 bg-white">
        <div>
            <h3 class="text-slate-700 font-semibold text-lg mb-1">Nama Instansi</h3>
            <div class="bg-slate-50 p-4 rounded-md border-l-4 border-indigo-500 text-slate-900 shadow-sm">
                <?= esc($pengajuan['nama_instansi_mitra']); ?>
            </div>
        </div>
        <div>
        <h3 class="text-slate-700 font-semibold text-lg mb-1">Kontak</h3>
        <div class="grid md:grid-cols-2 gap-4">
            <!-- Selalu tampilkan info dari mitra -->
            <div class="bg-slate-50 p-4 rounded-md border-l-4 border-indigo-500">
                <strong>Nama PIC Mitra:</strong> <?= esc($pengajuan['nama_pic_mitra']); ?>
            </div>
            <div class="bg-slate-50 p-4 rounded-md border-l-4 border-indigo-500">
                <strong>Email PIC Mitra:</strong> <?= esc($pengajuan['email_pic_mitra']); ?>
            </div>

            <!-- Tambahkan info PIC UB jika dari fakultas dan unit kerja -->
            <?php if ($user['keterangan'] === 'fakultas dan unit kerja') : ?>
                <div class="bg-slate-50 p-4 rounded-md border-l-4 border-green-500">
                    <strong>Nama PIC UB:</strong> <?= esc($user['name']); ?>
                </div>
                <div class="bg-slate-50 p-4 rounded-md border-l-4 border-green-500">
                    <strong>Email PIC UB:</strong> <?= esc($user['email']); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


        <!-- Kegiatan -->
        <div class="bg-slate-100 px-6 py-6">
            <h3 class="text-xl font-semibold text-slate-800 mb-4">📌 Informasi Kegiatan</h3>
            <div class="space-y-2 text-slate-700">
                <p><strong>Bidang Kerjasama:</strong> <?= esc($pengajuan['bidang_kerjasama']); ?></p>
                <p><strong>Rencana Kegiatan:</strong> <?= esc($pengajuan['rencana_kegiatan']); ?></p>
                <p><strong>Deskripsi Kegiatan:</strong> <?= esc($pengajuan['deskripsi_kegiatan']); ?></p>
            </div>
        </div>

        <!-- Status -->
        <div class="bg-white px-6 py-6 border-t border-slate-200">
            <h3 class="text-xl font-semibold text-slate-800 mb-4">🔖 Status</h3>
            <div class="flex flex-col md:flex-row justify-between items-start gap-6 text-slate-700">
                <div>
                    <p><strong>Status Surat:</strong> <?= esc($pengajuan['status_surat']); ?></p>
                    <?php if ($pengajuan['status_surat'] === 'Ditolak') : ?>
                        <p class="text-red-600 mt-2"><strong>Alasan Penolakan:</strong> <?= esc($pengajuan['alasan_ditolak']); ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <p><strong>Status Dokumen:</strong> <?= esc($pengajuan['status_dokumen']); ?></p>
                </div>
            </div>
        </div>

        <!-- Tanggal dan Kategori -->
        <div class="bg-slate-50 px-6 py-6 border-t border-slate-200 text-slate-700">
            <h3 class="text-xl font-semibold text-slate-800 mb-2">📅 Informasi Tambahan</h3>
            <p><strong>Durasi Kerjasama:</strong> <?= esc($pengajuan['durasi']); ?></p>
            <p><strong>Kategori Kegiatan:</strong> <?= esc($pengajuan['kategori_kegiatan']); ?></p>
        </div>

        <!-- Dokumen -->
        <div class="bg-white px-6 py-6 border-t border-slate-200 space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-700 mb-1">📄 Surat Permohonan</h4>
                <div class="border border-slate-300 rounded">
                    <embed src="<?= base_url('uploads/dokumen/' . $pengajuan['surat_permohonan']); ?>" width="100%" height="400px" type="application/pdf">
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-slate-700 mb-1">📁 Draft Permintaan Dokumen</h4>
                <div class="border border-slate-300 rounded">
                    <embed src="<?= base_url('uploads/dokumen/' . $pengajuan['draft_permintaan_dokumen']); ?>" width="100%" height="400px" type="application/pdf">
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-slate-100 px-6 py-4 text-center">
            <a href="/view_pengajuan" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">⬅ Kembali</a>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
