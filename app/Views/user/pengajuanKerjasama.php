<?php $this->extend('layout/templateUserLogin'); ?>
<?php $this->section('content'); ?>

<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-8 mt-10 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-700">Form Pengajuan Kerjasama</h2>

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <form action="<?= site_url('/tambah_kerjasama/save_pengajuan') ?>" method="POST" class="space-y-6" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <?php if ($user['keterangan'] === 'mitra'): ?>
                <div class="mb-4">
                    <label for="nama_instansi_mitra" class="block text-sm font-medium text-gray-600">Nama Instansi Mitra</label>
                    <input type="text" id="nama_instansi_mitra" name="nama_instansi_mitra"
                           value="<?= esc($user['instansi']) ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-gray-100" readonly>
                </div>

                <div class="mb-4">
                    <label for="nama_pic_mitra" class="block text-sm font-medium text-gray-600">Nama PIC Mitra</label>
                    <input type="text" id="nama_pic_mitra" name="nama_pic_mitra"
                           value="<?= esc($user['name']) ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-gray-100" readonly>
                </div>

                <div class="mb-4">
                    <label for="email_pic_mitra" class="block text-sm font-medium text-gray-600">Email PIC Mitra</label>
                    <input type="email" id="email_pic_mitra" name="email_pic_mitra"
                           value="<?= esc($user['email']) ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-gray-100" readonly>
                </div>
            <?php else: ?>
                <div class="mb-4">
                    <label for="nama_instansi_mitra" class="block text-sm font-medium text-gray-600">Nama Instansi Mitra</label>
                    <input type="text" id="nama_instansi_mitra" name="nama_instansi_mitra"
                           value="<?= old('nama_instansi_mitra') ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="nama_pic_mitra" class="block text-sm font-medium text-gray-600">Nama PIC Mitra</label>
                    <input type="text" id="nama_pic_mitra" name="nama_pic_mitra"
                           value="<?= old('nama_pic_mitra') ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="email_pic_mitra" class="block text-sm font-medium text-gray-600">Email PIC Mitra</label>
                    <input type="email" id="email_pic_mitra" name="email_pic_mitra"
                           value="<?= old('email_pic_mitra') ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>
                </div>
            <?php endif; ?>

            <div class="mb-4">
                <label for="no_telp_mitra" class="block text-sm font-medium text-gray-600">No. Telp Mitra</label>
                <input type="text" id="no_telp_mitra" name="no_telp_mitra" value="<?= old('no_telp_mitra') ?>"
                       class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="bidang_kerjasama" class="block text-sm font-medium text-gray-600">Bidang Kerjasama</label>
                <select id="bidang_kerjasama" name="bidang_kerjasama" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>
                    <option value="">-- Pilih Bidang Kerjasama --</option>
                    <option value="Dalam Negeri" <?= old('bidang_kerjasama') === 'Dalam Negeri' ? 'selected' : '' ?>>Dalam Negeri</option>
                    <option value="Luar Negeri" <?= old('bidang_kerjasama') === 'Luar Negeri' ? 'selected' : '' ?>>Luar Negeri</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="rencana_kegiatan" class="block text-sm font-medium text-gray-600">Rencana Kegiatan</label>
                <select id="rencana_kegiatan" name="rencana_kegiatan" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" onchange="toggleInput('rencana_kegiatan', 'rencana_kegiatan_lain')" required>
                    <option value="">-- Pilih Rencana Kegiatan --</option>
                    <?php
                    $rencanaOptions = [
                        "Asisten Mengajar di Satuan Pendidikan-Kampus Merdeka",
                        "Gelar Bersama (Joint Degree)",
                        "Gelar Ganda (Dual Degree)",
                        "Kegiatan Wirausaha-Kampus Merdeka",
                        "Magang/Praktek Kerja-Kampus Merdeka",
                        "Membangun Desa/ KKN Tematik-Kampus Merdeka",
                        "Pelatihan Dosen dan Instruktur",
                        "Pemagangan",
                        "Lainnya"
                    ];
                    foreach ($rencanaOptions as $option):
                    ?>
                        <option value="<?= $option ?>" <?= old('rencana_kegiatan') === $option ? 'selected' : '' ?>><?= $option ?></option>
                    <?php endforeach ?>
                </select>
                <input type="text" id="rencana_kegiatan_lain" name="rencana_kegiatan_lain"
                       class="mt-2 block w-full p-3 border border-gray-300 rounded-md hidden" placeholder="Isi rencana kegiatan lainnya...">
            </div>

            <div class="mb-4">
                <label for="deskripsi_kegiatan" class="block text-sm font-medium text-gray-600">Deskripsi Kegiatan</label>
                <textarea id="deskripsi_kegiatan" name="deskripsi_kegiatan"
                          class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required><?= old('deskripsi_kegiatan') ?></textarea>
            </div>

            <div class="mb-4">
                <label for="file_surat_permohonan" class="block text-sm font-medium text-gray-600">Surat Permohonan (PDF, max 2MB)</label>
                <input type="file" id="file_surat_permohonan" name="file_surat_permohonan"
                       class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required accept="application/pdf">
            </div>

            <div class="mb-4">
                <label for="draft_permintaan_dokumen" class="block text-sm font-medium text-gray-600">Draft Permintaan Dokumen (PDF, max 2MB)</label>
                <input type="file" id="draft_permintaan_dokumen" name="draft_permintaan_dokumen"
                       class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required accept="application/pdf">
            </div>

            <div class="mb-4">
                <label for="durasi" class="block text-sm font-medium text-gray-600">Durasi Kerjasama</label>
                <select id="durasi" name="durasi" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>
                    <option value="">-- Pilih Durasi --</option>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <option value="<?= $i ?> tahun" <?= old('durasi') === "$i tahun" ? 'selected' : '' ?>><?= $i ?> tahun</option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="kategori_kegiatan" class="block text-sm font-medium text-gray-600">Kategori Kegiatan</label>
                <select id="kategori_kegiatan" name="kategori_kegiatan" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" onchange="toggleInput('kategori_kegiatan', 'kategori_kegiatan_lain')" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    $kategoriOptions = [
                        "Seminar", "Workshop", "Sosialisasi", "Rapat Koordinasi",
                        "Penandatanganan MoU", "Kunjungan Kerja", "Pelatihan Internal", "Expo/Pameran", "Lainnya"
                    ];
                    foreach ($kategoriOptions as $option):
                    ?>
                        <option value="<?= $option ?>" <?= old('kategori_kegiatan') === $option ? 'selected' : '' ?>><?= $option ?></option>
                    <?php endforeach ?>
                </select>
                <input type="text" id="kategori_kegiatan_lain" name="kategori_kegiatan_lain"
                       class="mt-2 block w-full p-3 border border-gray-300 rounded-md hidden" placeholder="Isi kategori lainnya...">
            </div>

            <div class="flex justify-center mt-6">
                <button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded-md hover:bg-blue-600">
                    Ajukan Kerjasama
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleInput(selectId, inputId) {
            const select = document.getElementById(selectId);
            const input = document.getElementById(inputId);
            input.classList.toggle('hidden', select.value !== 'Lainnya');
        }

        // Run once on page load
        window.addEventListener('DOMContentLoaded', () => {
            toggleInput('rencana_kegiatan', 'rencana_kegiatan_lain');
            toggleInput('kategori_kegiatan', 'kategori_kegiatan_lain');
        });
    </script>
</body>

<?= $this->endSection(); ?>
