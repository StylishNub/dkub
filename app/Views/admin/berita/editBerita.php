<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<div class="max-w-3xl mx-auto mt-12 px-6 py-8 bg-white dark:bg-gray-900 shadow-md rounded-xl">
    <!-- Tombol Kembali -->
    <div class="flex items-center mb-6">
        <a href="kelola_berita" class="flex items-center text-gray-700 dark:text-white hover:text-blue-600 transition text-sm font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Kelola Berita
        </a>
    </div>

    <!-- Judul Halaman -->
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">✍️ Edit Berita</h1>

    <!-- Error Handling -->
    <?php if ($errors = session()->getFlashdata('errors')): ?>
        <div class="p-4 mb-6 text-sm text-red-800 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-900">
            <strong class="font-semibold">Terjadi kesalahan:</strong>
            <ul class="mt-2 list-disc list-inside">
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Form Edit -->
    <form action="/edit_berita/save_editBerita" method="post" enctype="multipart/form-data" class="space-y-6">
        <input type="hidden" name="id" value="<?= $berita['id']; ?>">

        <!-- Judul -->
        <div>
            <label for="judul" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Judul</label>
            <input type="text" name="judul" id="judul" value="<?= esc($berita['judul']) ?>" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Isi Berita -->
        <div>
            <label for="isi_berita" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Isi Berita</label>
            <textarea name="isi_berita" id="isi_berita" rows="6" required
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"><?= esc($berita['isi_berita']) ?></textarea>
        </div>

        <!-- Kategori -->
        <div>
            <label for="id_kategori_berita" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Kategori</label>
            <select name="id_kategori_berita" id="id_kategori_berita" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">
                <option value="" disabled>-- Pilih Kategori --</option>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= esc($k['id']) ?>" <?= $berita['id_kategori_berita'] == $k['id'] ? 'selected' : '' ?>>
                        <?= esc($k['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Gambar -->
        <div>
            <label for="gambar" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Gambar (Opsional)</label>
            <input type="file" name="gambar" id="gambar"
                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none"
                   accept="image/*">
            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
        </div>

        <!-- Tombol Simpan -->
        <div class="text-right">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-6 py-2 rounded-md transition duration-200 ease-in-out">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<?php $this->endSection(); ?>
