<?= $this->extend('layout/templateAdmin'); ?>
<?= $this->section('content'); ?>

<div class="max-w-3xl mx-auto py-10 px-6 bg-white dark:bg-gray-900 shadow-md rounded-xl">
    <!-- Tombol Kembali -->
    <div class="flex items-center mb-6">
        <a href="/kelola_pengaduan" class="flex items-center text-gray-700 dark:text-white hover:text-blue-600 transition text-sm font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Pengaduan
        </a>
    </div>

    <!-- Judul -->
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Balas Pengaduan</h1>

    <!-- Flash Message -->
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="mb-4 text-sm text-red-700 bg-red-100 p-3 rounded-md">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="mb-4 text-sm text-green-700 bg-green-100 p-3 rounded-md">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('info')) : ?>
        <div class="mb-4 text-sm text-blue-700 bg-blue-100 p-3 rounded-md">
            <?= session()->getFlashdata('info') ?>
        </div>
    <?php endif; ?>

    <!-- Informasi Pengaduan -->
    <div class="space-y-2 mb-6 text-sm text-gray-800 dark:text-gray-200">
        <p><strong>Nama Pengadu:</strong> <?= esc($pengaduan['nama']); ?></p>
        <p><strong>Email Pengadu:</strong> <?= esc($pengaduan['email']); ?></p>
        <p><strong>Instansi:</strong> <?= esc($pengaduan['instansi']); ?></p>
        <p><strong>Deskripsi Pengaduan:</strong></p>
        <div class="bg-gray-50 border rounded p-4 text-gray-700 dark:bg-gray-800 dark:text-gray-100"><?= esc($pengaduan['pertanyaan']); ?></div>

        <?php if (!empty($pengaduan['bukti_upload'])): ?>
            <div class="mt-4">
                <strong>Bukti Upload:</strong><br>
                <?php
                    $ext = pathinfo($pengaduan['bukti_upload'], PATHINFO_EXTENSION);
                    $filePath = base_url('uploads/dokumen/' . $pengaduan['bukti_upload']);
                ?>
                <?php if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                    <img src="<?= $filePath ?>" alt="Bukti" class="w-48 mt-2 border rounded shadow">
                <?php else: ?>
                    <a href="<?= $filePath ?>" target="_blank" class="text-blue-600 underline mt-2 inline-block">
                        Lihat Dokumen: <?= esc($pengaduan['bukti_upload']) ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Balasan Admin -->
    <?php if (!empty($pengaduan['balasan'])): ?>
        <div class="mt-6">
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Balasan Admin:</label>
            <div class="bg-gray-50 border border-green-500 text-green-700 p-4 rounded-md dark:bg-gray-800 dark:text-green-300">
                <?= esc($pengaduan['balasan']); ?>
            </div>
        </div>
    <?php else: ?>
        <!-- Form Balasan -->
        <form action="/kelola_pengaduan/balas/<?= esc($pengaduan['id']) ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?= csrf_field(); ?>

            <!-- Textarea Balasan -->
            <div>
                <label for="balasan" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Balasan</label>
                <textarea name="balasan" id="balasan" rows="5" required
                          class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 p-2.5"></textarea>
            </div>

            <!-- Tombol Submit -->
            <div class="text-right">
                <button type="submit"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-6 py-2 rounded-md transition duration-200 ease-in-out">
                    Kirim Balasan
                </button>
            </div>
        </form>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>
