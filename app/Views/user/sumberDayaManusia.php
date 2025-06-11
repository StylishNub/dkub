<?php $this->extend('layout/templateUser'); ?>
<?php $this->section('content'); ?>

<?php 
    $segment1 = service('uri')->getSegment(1);
    $title = ucwords(str_replace('-', ' ', $segment1));
?>

<!-- Header -->
<div class="relative w-full h-[60vh] bg-cover bg-center" style="background-image: url('<?= base_url('/img/ub_header.jpeg') ?>');">
    <div class="absolute inset-0 bg-blue-900 bg-opacity-60"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center">
        <h1 class="text-5xl font-extrabold text-[#F9A826]"><?= strtoupper($title) ?></h1>
        <div class="mt-2 text-sm font-semibold">
            <a href="<?= base_url('/') ?>" class="text-white hover:text-[#F9A826]">PROFIL</a>
            <span class="mx-2 text-[#F9A826]">›</span>
            <span class="text-white"><?= strtoupper($title) ?></span>
        </div>
    </div>
</div>

<!-- Staff Section -->
<section class="py-20 px-6 lg:px-16 bg-gray-50 dark:bg-gray-900">
    <h2 class="text-center text-3xl font-bold text-[#F9A826] mb-12">Pimpinan dan Staf Direktorat Kerja Sama</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($sdm as $index => $s): ?>
            <div class="bg-[#0E1A47] text-white rounded-lg p-6 shadow-md flex flex-col items-center">
                <p class="font-semibold text-lg"><?= esc($s['nama']) ?></p>
                <p class="text-sm italic mb-4"><?= esc($s['nama_jabatan']) ?></p>
                <button data-modal-target="modal<?= $index ?>" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white mt-auto">
                    More Info
                </button>
            </div>

            <!-- Modal -->
            <div id="modal<?= $index ?>" tabindex="-1" class="hidden fixed inset-0 z-50 bg-black bg-opacity-60 flex items-center justify-center px-4">
                <div class="bg-white max-w-2xl w-full rounded-lg shadow-xl relative p-6">
                    <img src="<?= base_url('uploads/gambar/' . $s['gambar']) ?>" alt="<?= esc($s['nama']) ?>" class="mx-auto h-52 w-52 object-cover rounded-full shadow mb-4 border-4 border-blue-500">
                    <h3 class="text-xl font-bold text-center text-gray-800 mb-4"><?= esc($s['nama']) ?></h3>
                    <table class="text-sm w-full text-gray-700 mb-6">
                        <tbody>
                            <tr>
                                <td class="py-1 w-32 font-medium">Jabatan</td>
                                <td>: <?= esc($s['nama_jabatan']) ?></td>
                            </tr>
                            <tr>
                                <td class="py-1 font-medium">Pendidikan</td>
                                <td>: <?= esc($s['pendidikan']) ?></td>
                            </tr>
                            <tr>
                                <td class="py-1 font-medium">Pengalaman</td>
                                <td>: <?= nl2br(esc($s['pengalaman_manajerial'])) ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button data-modal-hide="modal<?= $index ?>" class="bg-blue-600 hover:bg-blue-700 px-6 py-2 text-white rounded">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Modal Script -->
<script>
    document.querySelectorAll('[data-modal-target]').forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-modal-target');
            document.getElementById(targetId)?.classList.remove('hidden');
        });
    });

    document.querySelectorAll('[data-modal-hide]').forEach(button => {
        button.addEventListener('click', () => {
            button.closest('[id^="modal"]').classList.add('hidden');
        });
    });

    window.addEventListener('click', e => {
        const openModal = document.querySelector('[id^="modal"]:not(.hidden)');
        if (openModal && e.target === openModal) {
            openModal.classList.add('hidden');
        }
    });
</script>

<?php $this->endSection(); ?>
