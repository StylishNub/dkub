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

<!-- Tabel Program Kerja -->
<div class="container mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold text-center mb-8">Daftar Program Kerja</h2>

    <table class="min-w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-blue-100 text-left">
                <th class="px-6 py-3 border-b font-semibold text-sm text-gray-700">No</th>
                <th class="px-6 py-3 border-b font-semibold text-sm text-gray-700">Program Kerja</th>
                <th class="px-6 py-3 border-b font-semibold text-sm text-gray-700">Detail Program</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($program as $i => $p): ?>
            <tr class="border-b">
                <td class="px-6 py-3 text-sm text-gray-800"><?= $i + 1 ?></td>
                <td class="px-6 py-3 text-sm text-gray-800"><?= esc($p['program_kerja']) ?></td>
                <td class="px-6 py-3 text-sm text-gray-800 whitespace-pre-line"><?= esc($p['deskripsi_program']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php $this->endSection(); ?>
