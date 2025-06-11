<?= $this->extend('layout/templateUser'); ?>
<?= $this->section('content'); ?>

<?php 
    $segment1 = service('uri')->getSegment(1);
    $title = ucwords(str_replace('-', ' ', $segment1));
?>

<!-- Header Hero -->
<div class="relative w-full h-[60vh] bg-cover bg-center" style="background-image: url('<?= base_url('/img/ub_header.jpeg') ?>');">
    <div class="absolute inset-0 bg-blue-900 bg-opacity-60"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-4">
        <h1 class="text-4xl md:text-5xl font-extrabold text-[#F9A826]"><?= strtoupper($title) ?></h1>
        <div class="mt-2 text-sm font-medium tracking-wide">
            <a href="<?= base_url('/') ?>" class="text-white hover:text-[#F9A826]">PROFIL</a>
            <span class="mx-2 text-[#F9A826]">›</span>
            <span class="text-white"><?= strtoupper($title) ?></span>
        </div>
    </div>
</div>

<!-- Konten Visi Misi Tujuan -->
<div class="container mx-auto px-6 py-12 md:px-16 text-gray-700">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
        <!-- VISI -->
        <div class="rounded-xl shadow p-6" style="background-color: rgba(59, 130, 246, 0.08);">
            <h2 class="text-xl font-bold text-blue-900 mb-4 text-center">Visi</h2>
            <p class="text-justify leading-relaxed text-base"><?= nl2br($profil['visi']); ?></p>
        </div>

        <!-- MISI -->
        <div class="rounded-xl shadow p-6" style="background-color: rgba(234, 179, 8, 0.08);">
            <h2 class="text-xl font-bold text-yellow-800 mb-4 text-center">Misi</h2>
            <ul class="list-disc list-inside text-justify space-y-2 text-base">
                <?php foreach (explode("\n", $profil['misi']) as $misi): ?>
                    <?php if (trim($misi) !== ''): ?>
                        <li><?= trim($misi); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <!-- TUJUAN -->
    <div class="rounded-xl shadow p-6" style="background-color: rgba(34, 197, 94, 0.08);">
        <h2 class="text-xl font-bold text-green-800 mb-4 text-center">Tujuan</h2>
        <ol class="list-decimal list-inside text-justify space-y-2 text-base">
            <?php foreach (explode("\n", $profil['tujuan']) as $tujuan): ?>
                <?php if (trim($tujuan) !== ''): ?>
                    <li><?= trim($tujuan); ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ol>
    </div>
</div>

<?= $this->endSection(); ?>
