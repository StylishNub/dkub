<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>
<div class="max-w-3xl mx-auto mt-12 px-6 py-8 bg-white dark:bg-gray-900 shadow-md rounded-xl">
    <!-- Back button -->
    <div class="flex items-center mb-6">
        <a href="/hero_content" class="flex items-center text-gray-700 dark:text-white hover:text-blue-600 transition text-sm font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
    </div>

    <!-- Heading -->
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Edit Hero</h1>

    <form action="/edit_hero/save_editHero" method="post" enctype="multipart/form-data" class="space-y-6">
        <!-- Hidden ID dan Gambar Lama -->
        <input type="hidden" name="id" value="<?= $hero['id']; ?>">
        <input type="hidden" name="gambarLama" value="<?= $hero['hero_image']; ?>">

        <!-- Upload & Preview Gambar -->
        <div>
            <label for="hero_image" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Gambar</label>
            <div class="flex items-center gap-6">
                <img src="/uploads/banner/<?= $hero['hero_image']; ?>" class="img-preview w-32 h-32 object-cover rounded-md border border-gray-300 shadow-sm">
                <input onchange="previewImg()" class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none" id="hero_image" name="hero_image" type="file">
            </div>
        </div>

        <!-- Input Judul -->
        <div>
            <label for="hero_title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Judul Hero</label>
            <input type="text" name="hero_title" id="hero_title" value="<?= $hero['hero_title']; ?>" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- Input Deskripsi -->
        <div>
            <label for="hero_description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Deskripsi Hero</label>
            <textarea name="hero_description" id="hero_description" rows="5" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"><?= $hero['hero_description']; ?></textarea>
        </div>

        <!-- Tombol Submit -->
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
