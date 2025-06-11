<?php $this->extend('layout/templateUser'); ?>
<?php $this->section('content'); ?>

<?php 
    $segment1 = service('uri')->getSegment(1);
    $title = ucwords(str_replace('-', ' ', $segment1));
?>

<!-- Header dengan Background dan Overlay -->
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

<!-- Konten Tabel Kerjasama -->
<div class="container mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold text-center mb-8">Kerjasama Dalam Negeri Universitas Brawijaya</h2>

    <!-- Filter dan Search -->
    <div class="mb-6 flex justify-between items-center">
        <!-- Dropdown entri -->
        <form action="<?= base_url('kerjasama') ?>" method="get" class="flex space-x-2 items-center" id="perPageForm">
            <label for="perPage" class="text-sm text-gray-700">Tampilkan</label>
            <select name="perPage" id="perPage" class="border border-gray-300 rounded-lg p-2 text-sm">
                <option value="5"  <?= $perPage == 5 ? 'selected' : '' ?>>5 entri</option>
                <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10 entri</option>
                <option value="20" <?= $perPage == 20 ? 'selected' : '' ?>>20 entri</option>
                <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50 entri</option>
            </select>

            <?php if ($keyword): ?>
                <input type="hidden" name="keyword" value="<?= esc($keyword) ?>">
            <?php endif; ?>
        </form>

        <!-- Form search otomatis -->
        <form action="<?= base_url('kerjasama') ?>" method="get" class="flex space-x-4 items-center" id="searchForm">
            <label for="keyword" class="text-sm text-gray-700">Cari:</label>
            <input type="text" name="keyword" id="keyword" value="<?= esc($keyword) ?>"
                class="border border-gray-300 rounded-lg p-2 text-sm"
                placeholder="Cari mitra atau detail" autocomplete="off">
            <input type="hidden" name="perPage" value="<?= esc($perPage) ?>">
        </form>
    </div>

    <!-- Tabel -->
    <table class="min-w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-blue-100 text-left">
                <th class="px-6 py-3 border-b font-semibold text-sm text-gray-700">Mitra</th>
                <th class="px-6 py-3 border-b font-semibold text-sm text-gray-700">Tahun</th>
                <th class="px-6 py-3 border-b font-semibold text-sm text-gray-700">Jangka Waktu</th>
                <th class="px-6 py-3 border-b font-semibold text-sm text-gray-700">Tanggal Mulai</th>
                <th class="px-6 py-3 border-b font-semibold text-sm text-gray-700">Tanggal Berakhir</th>
                <th class="px-6 py-3 border-b font-semibold text-sm text-gray-700">Download</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kerjasama as $k): ?>
            <tr class="border-b">
                <td class="px-6 py-3 text-sm text-gray-800"><?= esc($k['nama_mitra']) ?></td>
                <td class="px-6 py-3 text-sm text-gray-800"><?= esc($k['tahun']) ?></td>
                <td class="px-6 py-3 text-sm text-gray-800"><?= esc($k['jangka_waktu']) ?></td>
                <td class="px-6 py-3 text-sm text-gray-800"><?= date('d-M-Y', strtotime($k['tanggal_mulai'])) ?></td>
                <td class="px-6 py-3 text-sm text-gray-800"><?= date('d-M-Y', strtotime($k['tanggal_berakhir'])) ?></td>
                <td class="px-6 py-3 text-sm text-orange-600">
                    <?php if (!empty($k['file_pdf'])): ?>
                        <a href="<?= base_url('uploads/pdf/' . $k['file_pdf']) ?>" target="_blank" class="hover:underline">Download</a>
                    <?php else: ?>
                        <span class="text-gray-400 italic">Belum ada file</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="flex justify-center py-4 text-sm text-gray-700">
        <div class="inline-flex items-center space-x-3">
            <?php
                $page  = $pager->getCurrentPage('mou');
                $total = $pager->getPageCount('mou');
            ?>
            <?php if ($page > 1): ?>
                <a href="<?= $pager->getPageURI($page - 1, 'mou') ?><?= $keyword ? '&keyword=' . urlencode($keyword) : '' ?>&perPage=<?= $perPage ?>"
                   class="px-3 py-1 border rounded hover:bg-gray-100">
                    &laquo; Previous
                </a>
            <?php else: ?>
                <span class="px-3 py-1 border rounded text-gray-400 cursor-not-allowed">
                    &laquo; Previous
                </span>
            <?php endif; ?>

            <span>Page <?= $page ?> of <?= $total ?></span>

            <?php if ($page < $total): ?>
                <a href="<?= $pager->getPageURI($page + 1, 'mou') ?><?= $keyword ? '&keyword=' . urlencode($keyword) : '' ?>&perPage=<?= $perPage ?>"
                   class="px-3 py-1 border rounded hover:bg-gray-100">
                    Next &raquo;
                </a>
            <?php else: ?>
                <span class="px-3 py-1 border rounded text-gray-400 cursor-not-allowed">
                    Next &raquo;
                </span>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Script -->
<script>
document.getElementById('keyword').addEventListener('input', function () {
    clearTimeout(window.searchTimeout);
    window.searchTimeout = setTimeout(function () {
        document.getElementById('searchForm').submit();
    }, 400);
});

document.getElementById('perPage').addEventListener('change', function () {
    document.getElementById('perPageForm').submit();
});
</script>

<?php $this->endSection(); ?>
