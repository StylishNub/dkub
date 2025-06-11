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
            <li><a href="#" class="text-blue-600 hover:text-orange-600">Unduh DRAFT PKS, MoA, IA Dalam Negeri</a></li>
            <li><a href="#" class="text-blue-600 hover:text-orange-600">Unduh DRAFT PKS, MoA, IA Luar Negeri</a></li>
            <li><a href="#" class="text-blue-600 hover:text-orange-600">Unduh DRAFT PKS, MoA, IA Dalam Negeri 1 Lembar</a></li>
        </ul>
    </div>

    <?php if (!empty($dokumen)): ?>
    <h3 class="text-xl font-bold mb-6 text-center text-blue-800">Preview Dokumen PKS, MOA, IA</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
        <?php foreach ($dokumen as $d): ?>
            <?php if (!empty($d['file_pdf'])): ?>
                <div class="border border-gray-300 rounded shadow-sm">
                    <div class="bg-blue-100 px-4 py-2 font-semibold text-sm text-gray-700">
                        <?= esc($d['nama_dokumen']) ?>
                    </div>
                    <iframe src="<?= base_url('uploads/dokumen/' . $d['file_pdf']) ?>" width="100%" height="400px" class="rounded-b"></iframe>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script>
    let pdfDoc = null;
    let totalPages = 0;
    let scale = 1.5;  // Initial zoom level

    // Fungsi untuk memuat dan merender PDF otomatis saat halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        openPDF('/pdf/mou_dn.pdf');  // Ganti dengan path PDF yang sesuai
    });

    function openPDF(pdfUrl) {
        const container = document.getElementById('pdf-viewer-container');
        
        const row1Col1Container = document.getElementById('pdf-pages-row1-col1');
        const row1Col2Container = document.getElementById('pdf-pages-row1-col2');
        
        const row2Col1Container = document.getElementById('pdf-pages-row2-col1');
        const row2Col2Container = document.getElementById('pdf-pages-row2-col2');
        
        container.classList.remove('hidden'); // Show the PDF viewer

        const loadingTask = pdfjsLib.getDocument(pdfUrl);
        loadingTask.promise.then(function(pdf) {
            pdfDoc = pdf;
            totalPages = pdf.numPages;
            renderAllPages();
        });
    }

    function renderPage(pageNum, container) {
        pdfDoc.getPage(pageNum).then(function(page) {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            const viewport = page.getViewport({ scale: scale });
            
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            page.render({
                canvasContext: context,
                viewport: viewport
            });

            // Tambahkan canvas ke container yang sesuai
            container.appendChild(canvas);
        });
    }

    function renderAllPages() {
        let pageNum = 1;
        
        // Baris 1
        renderPage(pageNum++, document.getElementById('pdf-pages-row1-col1'));  // Baris 1 Kolom 1
        renderPage(pageNum++, document.getElementById('pdf-pages-row1-col2'));  // Baris 1 Kolom 2
        
        // Baris 2
        renderPage(pageNum++, document.getElementById('pdf-pages-row2-col1'));  // Baris 2 Kolom 1
        renderPage(pageNum++, document.getElementById('pdf-pages-row2-col2'));  // Baris 2 Kolom 2
        
        // Baris 3
        renderPage(pageNum++, document.getElementById('pdf-pages-row3-col1'));  // Baris 3 Kolom 1
        renderPage(pageNum++, document.getElementById('pdf-pages-row3-col2'));  // Baris 3 Kolom 2
    }
</script>

<?php $this->endSection(); ?>
