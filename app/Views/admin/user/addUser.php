<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<div class="max-w-3xl mx-auto mt-12 px-6 py-8 bg-white dark:bg-gray-900 shadow-md rounded-xl">

    <!-- Tombol Kembali -->
    <div class="flex items-center mb-6">
        <a href="/kelola_user" class="flex items-center text-gray-700 dark:text-white hover:text-blue-600 text-sm font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Kelola User
        </a>
    </div>

    <!-- Judul -->
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Tambah User</h1>

    <!-- Error Alert -->
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

    <!-- Form -->
    <form action="<?= base_url('/tambah_user/save_user') ?>" method="post" class="space-y-6">
        <?= csrf_field() ?>

        <!-- Nama -->
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Nama</label>
            <input type="text" name="name" id="name" value="<?= old('name') ?>" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Email</label>
            <input type="email" name="email" id="email" value="<?= old('email') ?>" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- Instansi Default -->
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Instansi</label>
            <input type="text" value="Universitas Brawijaya" disabled readonly
                class="bg-gray-200 border border-gray-300 text-gray-500 text-sm rounded-md block w-full p-2.5">
        </div>

        <!-- Kepentingan Default -->
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Kepentingan</label>
            <input type="text" value="Sebagai Operator" disabled readonly
                class="bg-gray-200 border border-gray-300 text-gray-500 text-sm rounded-md block w-full p-2.5">
        </div>

        <!-- Fakultas/Unit -->
        <div>
            <label for="fakultas_unit" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Fakultas / Unit</label>
            <input type="text" name="fakultas_unit" id="fakultas_unit" value="<?= old('fakultas_unit') ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <input type="hidden" name="level" value="user">

        <!-- Submit -->
        <div class="text-right">
            <button type="submit"
                class="inline-block bg-[#F97B22] hover:bg-[#e96c12] text-white font-semibold text-sm px-6 py-2 rounded-md transition duration-200 ease-in-out">
                Simpan User
            </button>
        </div>
    </form>
</div>

<?php $this->endSection(); ?>
