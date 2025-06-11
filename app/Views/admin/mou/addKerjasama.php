<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<div class="max-w-3xl mx-auto mt-12 px-6 py-8 bg-white dark:bg-gray-900 shadow-md rounded-xl">
    <!-- Tombol Kembali -->
    <div class="flex items-center mb-6">
        <a href="/kelola_kerjasama" class="flex items-center text-gray-700 dark:text-white hover:text-blue-600 transition text-sm font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Kelola Kerjasama
        </a>
    </div>

    <!-- Judul -->
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Tambah Kerjasama</h1>

    <!-- Notifikasi Error -->
    <?php $errors = session()->getFlashdata('errors'); ?>
    <?php if ($errors !== null && is_array($errors)) : ?>
        <div class="p-4 mb-6 text-sm text-red-800 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-900">
            <strong class="font-semibold">Terdapat beberapa error:</strong>
            <ul class="mt-2 list-disc list-inside">
                <?php foreach ($errors as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Form Tambah Kerjasama -->
    <form action="/tambah_mou/save_mou" method="post" enctype="multipart/form-data" class="space-y-6">

        <!-- Mitra -->
        <div>
            <label for="nama_mitra" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Nama Mitra</label>
            <input type="text" name="nama_mitra" id="nama_mitra" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- Tahun -->
        <div>
            <label for="tahun" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Tahun</label>
            <input type="text" name="tahun" id="tahun" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- Jangka Waktu -->
        <div>
            <label for="jangka_waktu" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Jangka Waktu</label>
            <input type="text" name="jangka_waktu" id="jangka_waktu" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- Tanggal Mulai -->
        <div>
            <label for="tanggal_mulai" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- Tanggal Berakhir -->
        <div>
            <label for="tanggal_berakhir" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Tanggal Berakhir</label>
            <input type="date" name="tanggal_berakhir" id="tanggal_berakhir" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- File PDF -->
        <div>
            <label for="file_pdf" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">File PDF</label>
            <input type="file" name="file_pdf" id="file_pdf" required
                   class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none"
                   accept=".pdf">
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Status</label>
            <select name="status" id="status" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="">Pilih Status</option>
                <?php foreach ($status as $s): ?>
                    <option value="<?= esc($s['id']); ?>"><?= esc($s['status']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Tombol Simpan -->
        <div class="text-right">
            <button type="submit"
                    class="inline-block bg-[#F97B22] hover:bg-[#e96c12] text-white font-semibold text-sm px-6 py-2 rounded-md transition duration-200 ease-in-out">
                Simpan
            </button>
        </div>
    </form>
</div>

<?php $this->endSection(); ?>
