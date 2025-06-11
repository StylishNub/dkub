<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<div class="max-w-3xl mx-auto mt-12 px-6 py-8 bg-white dark:bg-gray-900 shadow-md rounded-xl">
    <!-- Tombol Kembali -->
    <div class="flex items-center mb-6">
        <a href="/kelola_sdm" class="flex items-center text-gray-700 dark:text-white hover:text-blue-600 transition text-sm font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Kelola SDM
        </a>
    </div>

    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Edit Data SDM</h1>

    <form action="/edit_sdm/save_editSdm" method="post" enctype="multipart/form-data" class="space-y-6">
        <!-- Hidden ID & Gambar -->
        <input type="hidden" name="id" value="<?= $sdm['id']; ?>">
        <input type="hidden" name="gambarLama" value="<?= $sdm['gambar']; ?>">

        <!-- Nama -->
        <div>
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= $sdm['nama']; ?>" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- NIP/NIK -->
        <div>
            <label for="nip_nik" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">NIP/NIK</label>
            <input type="text" name="nip_nik" id="nip_nik" value="<?= $sdm['nip_nik']; ?>" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- Jabatan -->
        <div>
            <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Jabatan</label>
            <select name="jabatan" id="jabatan" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" disabled>Pilih Jabatan</option>
                <?php foreach ($jabatan as $j): ?>
                    <option value="<?= esc($j['id']); ?>" <?= $j['id'] == $sdm['id_jabatan'] ? 'selected' : '' ?>>
                        <?= esc($j['nama_jabatan']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Pendidikan -->
        <div>
            <label for="pendidikan" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Pendidikan</label>
            <input type="text" name="pendidikan" id="pendidikan" value="<?= $sdm['pendidikan']; ?>" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- Pengalaman Manajerial -->
        <div>
            <label for="pengalaman_manajerial" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Pengalaman Manajerial</label>
            <input type="text" name="pengalaman_manajerial" id="pengalaman_manajerial" value="<?= $sdm['pengalaman_manajerial']; ?>" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- Foto SDM -->
        <div>
            <label for="gambar" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Foto SDM</label>
            <div class="flex items-center gap-4">
                <img src="/uploads/gambar/<?= $sdm['gambar']; ?>" class="w-32 h-32 object-cover rounded-md border border-gray-300 img-preview">
                <input type="file" name="gambar" id="gambar"
                       class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none"
                       accept="image/*" onchange="previewImg()">
            </div>
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
