<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<div class="max-w-3xl mx-auto mt-12 px-6 py-8 bg-white dark:bg-gray-900 shadow-md rounded-xl">
    <div class="flex items-center mb-6">
        <a href="/hero_content" class="text-gray-700 dark:text-white hover:text-blue-600 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <h1 class="ml-4 text-2xl font-bold text-gray-800 dark:text-white">Tambah Hero Content</h1>
    </div>

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

    <form action="/tambah_hero/save_hero" method="post" enctype="multipart/form-data" class="space-y-6">
        <!-- Upload Image -->
        <div>
            <label for="hero_image" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Gambar</label>
            <div class="flex items-center gap-6">
                <img src="/img/default-img.png" alt="Preview" class="img-preview w-32 h-32 object-cover rounded-md border border-gray-300 shadow-sm">
                <input onchange="previewImg()" class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none" id="hero_image" name="hero_image" type="file">
            </div>
        </div>

        <!-- Hero Title -->
        <div>
            <label for="hero_title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Judul Hero</label>
            <input type="text" id="hero_title" name="hero_title" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- Hero Description -->
        <div>
            <label for="hero_description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Deskripsi Hero</label>
            <textarea id="hero_description" name="hero_description" rows="4" required
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
        </div>

        <!-- Submit Button -->
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
        const input = document.getElementById('hero_image');
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
