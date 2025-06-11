<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<div class="max-w-3xl mx-auto mt-12 px-6 py-8 bg-white dark:bg-gray-900 shadow-md rounded-xl">
    <!-- Tombol Kembali -->
    <div class="flex items-center mb-6">
        <a href="/kelola_dokumen" class="flex items-center text-gray-700 dark:text-white hover:text-blue-600 transition text-sm font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Kelola Dokumen
        </a>
    </div>

    <!-- Judul -->
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Edit Dokumen</h1>

    <!-- Notifikasi Error -->
    <?php $errors = session()->getFlashdata('errors'); ?>
    <?php if ($errors !== null && is_array($errors)) : ?>
        <div class="p-4 mb-6 text-sm text-red-800 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-900">
            <strong class="font-semibold">Terjadi kesalahan:</strong>
            <ul class="mt-2 list-disc list-inside">
                <?php foreach ($errors as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Form -->
    <form action="/edit_dokumen/save_editDokumen" method="post" enctype="multipart/form-data" class="space-y-6">
        <input type="hidden" name="id" value="<?= $dokumen['id']; ?>">

        <!-- Nama Dokumen -->
        <div>
            <label for="nama_dokumen" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Nama Dokumen</label>
            <input type="text" name="nama_dokumen" id="nama_dokumen" value="<?= esc($dokumen['nama_dokumen']) ?>" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- Jenis Dokumen -->
        <div>
            <label for="jenis_dokumen_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Jenis Dokumen</label>
            <select name="jenis_dokumen_id" id="jenis_dokumen_id" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="">Pilih Jenis Dokumen</option>
                <?php foreach ($jenis as $s): ?>
                    <option value="<?= esc($s['id']); ?>" <?= $dokumen['jenis_dokumen_id'] == $s['id'] ? 'selected' : '' ?>>
                        <?= esc($s['jenis']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Status Dokumen -->
        <div>
            <label for="id_status" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Status Dokumen</label>
            <select name="id_status" id="id_status" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="">Pilih Status Dokumen</option>
                <?php foreach ($status as $s): ?>
                    <option value="<?= esc($s['id']); ?>" <?= $dokumen['id_status'] == $s['id'] ? 'selected' : '' ?>>
                        <?= esc($s['status']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- File PDF -->
        <div>
            <label for="file_pdf" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">File PDF (opsional)</label>
            <input type="file" name="file_pdf" id="file_pdf"
                   class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none"
                   accept=".pdf">
            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah file.</p>
        </div>

        <!-- Tombol Simpan -->
        <div class="text-right">
            <button type="submit"
                    class="inline-block bg-[#F97B22] hover:bg-[#e96c12] text-white font-semibold text-sm px-6 py-2 rounded-md transition duration-200 ease-in-out">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<?php $this->endSection(); ?>
