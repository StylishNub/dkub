<?php $this->extend('layout/templateUser'); ?>

<?php $this->section('content'); ?>

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

<!-- Konten Unduhan -->
<div class="container mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold text-center mb-8">
        Berikut Merupakan DRAFT PKS, MoA, IA yang Bisa Digunakan untuk Pengajuan Kerja Sama dengan Universitas Brawijaya
    </h2>

    <div class="mb-8">
        <p class="text-lg font-semibold">Untuk file Word, bisa klik link di bawah ini:</p>
        <ul class="list-decimal pl-5">
            <li><a href="#" class="text-blue-600 hover:text-orange-600">Pengurusan Surat Persetujuan Kemensetneg (SP Setneg)</a></li>
            <li><a href="#" class="text-blue-600 hover:text-orange-600">Pengurusan Paspor Dinas, Exit Permit dan Rekomendasi Visa dari Kemenlu</a></li>
        </ul>
    </div>

    <section class="container mx-auto py-12 px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">SESUAI GAMBAR BERIKUT!!</h2>
        <div class="flex justify-center">
            <?php if (!empty($gambar) && isset($gambar['gambar'])): ?>
                <img src="<?= base_url('uploads/gambar/' . $gambar['gambar']) ?>" alt="Struktur Organisasi"
                    class="rounded-lg shadow-lg w-full max-w-[1200px]">
            <?php else: ?>
                <p class="text-gray-500">Gambar struktur organisasi belum tersedia.</p>
            <?php endif; ?>
        </div>
    </section>

</div>

<?php $this->endSection(); ?>
