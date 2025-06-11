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
        <div class="mt-2 text-sm font-medium">
            <a href="<?= base_url('/') ?>" class="text-white hover:text-[#F9A826]">PROFIL</a>
            <span class="mx-2 text-[#F9A826]">›</span>
            <span class="text-white"><?= strtoupper($title) ?></span>
        </div>
    </div>
</div>

<section class="container mx-auto py-12 px-4">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Susunan Organisasi</h2>
    <div class="flex justify-center">
        <?php if (!empty($gambar) && isset($gambar['gambar'])): ?>
            <img src="<?= base_url('uploads/gambar/' . $gambar['gambar']) ?>" alt="Struktur Organisasi"
                class="rounded-lg shadow-lg w-full max-w-[1200px]">
        <?php else: ?>
            <p class="text-gray-500">Gambar struktur organisasi belum tersedia.</p>
        <?php endif; ?>
    </div>
</section>


<!-- Tupoksi Jabatan -->
<section class="container mx-auto px-4 pb-16">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Tugas Pokok & Fungsi Jabatan</h2>
    <div id="accordion-flush" class="max-w-3xl mx-auto" data-accordion="collapse"
         data-active-classes="bg-white text-gray-900" data-inactive-classes="text-black">
        <?php foreach ($jabatan as $index => $j): ?>
            <div class="border border-gray-200 rounded mb-2">
                <h2 id="accordion-flush-heading-<?= $index ?>">
                    <button type="button"
                        class="flex items-center justify-between w-full px-5 py-4 font-semibold text-left text-black bg-gray-50 hover:bg-gray-100 rounded-t transition"
                        data-accordion-target="#accordion-flush-body-<?= $index ?>"
                        aria-expanded="false"
                        aria-controls="accordion-flush-body-<?= $index ?>">
                        <span><?= esc($j['nama_jabatan']) ?></span>
                        <svg data-accordion-icon class="w-4 h-4 transition-transform" fill="none" viewBox="0 0 10 6"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-flush-body-<?= $index ?>" class="hidden" aria-labelledby="accordion-flush-heading-<?= $index ?>">
                    <div class="px-5 py-4 text-gray-700 bg-white border-t border-gray-200">
                        <p class="whitespace-pre-line leading-relaxed"><?= nl2br(esc($j['tupoksi_jabatan'])) ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const accordionButtons = document.querySelectorAll('[data-accordion-target]');
        accordionButtons.forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-accordion-target');
                const targetContent = document.querySelector(targetId);
                const isExpanded = this.getAttribute('aria-expanded') === 'true';

                // Toggle tampilan konten
                targetContent.classList.toggle('hidden');
                this.setAttribute('aria-expanded', !isExpanded);

                // Toggle ikon rotasi
                const icon = this.querySelector('[data-accordion-icon]');
                if (icon) {
                    icon.classList.toggle('rotate-180');
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>
