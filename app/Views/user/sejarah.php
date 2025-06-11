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
            <a href="<?= base_url('/') ?>" class="text-white hover:text-[#F9A826]">PROFIL</a>
            <span class="mx-2 text-[#F9A826]">›</span>
            <span class="text-white"><?= strtoupper($title) ?></span>
        </div>
    </div>
</div>


<!-- Konten Utama Halaman -->
<div class="pt-10 px-6 md:px-12">
<h2 class="text-2xl font-bold mb-4 text-center">Sejarah</h2>
<div class="text-gray-700 leading-relaxed text-justify space-y-6">
    <?php
    $lines = explode("\n", $profil['sejarah']);
    $chunks = array_chunk($lines, 5); // tiap 5 baris

    foreach ($chunks as $chunk):
        $paragraph = nl2br(trim(implode("\n", $chunk))); // tetap pisah per baris dengan <br>
    ?>
        <p><?= $paragraph; ?></p>
    <?php endforeach; ?>
</div>
</div>
<?= $this->endSection(); ?>
