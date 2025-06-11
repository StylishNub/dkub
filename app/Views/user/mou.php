<?php $this->extend('layout/templateUser'); ?>
<?php $this->section('content'); ?>

<?php 
    $segment1 = service('uri')->getSegment(1);
    $title = ucwords(str_replace('-', ' ', $segment1));
?>

<!-- Header -->
<div class="relative w-full h-[60vh] bg-cover bg-center -mb-1" style="background-image: url('<?= base_url('/img/ub_header.jpeg') ?>'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-blue-900 bg-opacity-50"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center">
        <h1 class="text-5xl font-extrabold text-[#F9A826]"><?= strtoupper($title) ?></h1>
        <div class="mt-2 text-sm font-semibold">
            <a href="<?= base_url('/') ?>" class="text-white hover:text-[#F9A826]">PROFIL</a>
            <span class="mx-2 text-[#F9A826]">›</span>
            <span class="text-white"><?= strtoupper($title) ?></span>
        </div>
    </div>
</div>

<!-- Konten -->
<div class="mb-8 mt-4 pl-6">
    <p class="text-lg font-semibold">Silakan unduh file Word berikut:</p>
    <ul class="list-decimal pl-5 mt-2 space-y-1">
        <li><a href="https://drive.google.com/mou_dalamnegeri.docx" target="_blank" class="text-blue-600 hover:text-orange-600">Unduh DRAFT MOU Dalam Negeri</a></li>
        <li><a href="https://drive.google.com/mou_luarnegeri.docx" target="_blank" class="text-blue-600 hover:text-orange-600">Unduh DRAFT MOU Luar Negeri</a></li>
        <li><a href="https://drive.google.com/mou_1lembar.docx" target="_blank" class="text-blue-600 hover:text-orange-600">Unduh DRAFT MOU Dalam Negeri 1 Lembar</a></li>
    </ul>
</div>

<?php if (!empty($dokumen)): ?>
    <h3 class="text-xl font-bold mb-6 text-center text-blue-800">Preview Dokumen MOU</h3>
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

<!-- PDF.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script>
    let pdfDoc = null;
    let totalPages = 0;
    let scale = 1.5;

    function openPDF(pdfUrl, title) {
        const container = document.getElementById('pdf-viewer-container');
        const titleElement = document.getElementById('pdf-title');
        titleElement.classList.remove('hidden');
        titleElement.textContent = 'Preview: ' + title;

        // Kosongkan viewer sebelumnya
        for (let i = 1; i <= 6; i++) {
            document.getElementById('pdf-pages-' + i).innerHTML = '';
        }

        container.classList.remove('hidden');

        const loadingTask = pdfjsLib.getDocument(pdfUrl);
        loadingTask.promise.then(function(pdf) {
            pdfDoc = pdf;
            totalPages = pdf.numPages;
            renderAllPages();
        });
    }

    function renderPage(pageNum, containerId) {
        if (pageNum > totalPages) return;
        pdfDoc.getPage(pageNum).then(function(page) {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            const viewport = page.getViewport({ scale: scale });

            canvas.height = viewport.height;
            canvas.width = viewport.width;

            page.render({ canvasContext: context, viewport: viewport });
            document.getElementById(containerId).appendChild(canvas);
        });
    }

    function renderAllPages() {
        for (let i = 0; i < 6; i++) {
            renderPage(i + 1, 'pdf-pages-' + (i + 1));
        }
    }
</script>

<?php $this->endSection(); ?>
