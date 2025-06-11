<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<div class="max-w-3xl mx-auto mt-12 px-6 py-8 bg-white dark:bg-gray-900 shadow-md rounded-xl">
    <!-- Back button -->
    <div class="flex items-center mb-6">
        <a href="/kelola_gambar" class="flex items-center text-gray-700 dark:text-white hover:text-blue-600 transition text-sm font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Kelola Gambar
        </a>
    </div>

    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Tambah Gambar</h1>

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

    <form action="/tambah_gambar/save_gambar" method="post" enctype="multipart/form-data" class="space-y-6">
        <!-- Gambar Upload & Preview -->
        <div>
            <label for="gambar" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Gambar</label>
            <div class="flex items-center gap-6">
                <img src="/img/default-img.png" class="img-preview w-32 h-32 object-cover rounded-md border border-gray-300 shadow-sm">
                <input onchange="previewImg()" class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none" id="gambar" name="gambar" type="file">
            </div>
        </div>

        <!-- Nama Gambar -->
        <div>
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Nama Gambar</label>
            <input type="text" name="nama" id="nama" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- Kategori -->
        <div>
            <label for="kategori" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Kategori Gambar</label>
            <input type="text" name="kategori" id="kategori" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Status Gambar</label>
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

<script>
    function previewImg() {
        const input = document.getElementById('gambar');
        const preview = document.querySelector('.img-preview');
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => preview.src = e.target.result;
            reader.readAsDataURL(file);
        }
    }
</script>

<?php $this->endSection(); ?>
