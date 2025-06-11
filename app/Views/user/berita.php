<?= $this->extend('layout/templateUser'); ?>
<?= $this->section('content'); ?>

<?php 
    $segment1 = service('uri')->getSegment(1);
    $title = ucwords(str_replace('-', ' ', $segment1));
?>

<!-- Header dengan Background dan Overlay -->
<div class="relative w-full h-[60vh] bg-cover bg-center -mb-1" style="background-image: url('<?= base_url('/img/ub_header.jpeg') ?>'); margin-top: 0; background-size: cover; background-position: center;">
    <!-- Overlay biru transparan -->
    <div class="absolute inset-0 bg-blue-900 bg-opacity-50"></div>

    <!-- Konten di atas overlay -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center">
        <h1 class="text-5xl font-extrabold text-[#F9A826]"><?= strtoupper($title) ?></h1>
        <div class="mt-2 text-sm font-semibold">
            <a href="<?= base_url('/') ?>" class="text-white hover:text-[#F9A826]">BERITA</a>
            <span class="mx-2 text-[#F9A826]">›</span>
            <span class="text-white"><?= strtoupper($title) ?></span>
        </div>
    </div>
</div>

<div class="max-w-screen-xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold text-center text-[#061767] mb-10">Berita Terbaru</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <?php foreach ($berita as $b): ?>
            <div class="bg-white rounded-lg shadow hover:shadow-md transition duration-300">
                <a href="<?= base_url('/berita/detail_berita/' . $b['id']); ?>">
                    <div class="p-4">
                        <p class="text-xs uppercase font-semibold text-gray-500 mb-1">Berita</p>
                        <h2 class="text-lg font-bold text-[#061767] leading-tight mb-3"><?= esc($b['judul']); ?></h2>
                        <?php if (!empty($b['gambar'])): ?>
                            <img src="<?= base_url('uploads/gambar/' . $b['gambar']); ?>" alt="<?= esc($b['judul']); ?>" class="w-full h-52 object-cover rounded mb-3">
                        <?php endif; ?>
                        <p class="text-sm text-gray-600">
                            <?= word_limiter(strip_tags($b['isi_berita']), 20); ?>
                        </p>
                        <p class="text-xs text-gray-400 mt-2">
                            <?= esc($b['kategori']); ?> | <?= date('d M Y', strtotime($b['publish_date'])); ?>
                        </p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php $this->endSection(); ?>
