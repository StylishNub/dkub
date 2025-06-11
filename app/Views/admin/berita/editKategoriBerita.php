<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<div class="max-w-2xl mx-auto mt-12 px-6 py-8 bg-white dark:bg-gray-900 shadow-md rounded-xl">
    <!-- Tombol Kembali -->
    <div class="flex items-center mb-6">
        <a href="/kelola_kategori_berita" class="flex items-center text-gray-700 dark:text-white hover:text-blue-600 transition text-sm font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Kategori Berita
        </a>
    </div>

    <!-- Judul -->
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">✏️ Edit Kategori Berita</h1>

    <!-- Notifikasi Error -->
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

    <!-- Form -->
    <form action="/edit_kategoriBerita/save_editKategoriBerita" method="post" class="space-y-6">
        <input type="hidden" name="id" value="<?= $kategori['id']; ?>">

        <!-- Nama Kategori -->
        <div>
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Nama Kategori</label>
            <input type="text" name="nama" id="nama" value="<?= esc($kategori['nama']) ?>" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Deskripsi Kategori -->
        <div>
            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" required
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"><?= esc($kategori['deskripsi']) ?></textarea>
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
