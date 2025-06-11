<?= $this->extend('layout/templateUser'); ?>
<?= $this->section('content'); ?>

<div class="container mx-auto px-4 py-12 max-w-screen-lg">
    <div class="mb-6">
        <a href="<?= base_url('/berita'); ?>" class="text-blue-600 hover:underline text-sm">&larr; Kembali ke daftar berita</a>
    </div>

    <h1 class="text-3xl font-bold text-gray-900 mb-4"><?= esc($berita['judul']) ?></h1>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div class="text-sm text-gray-600 mb-2 sm:mb-0">
            <span class="mr-4">🗂️ Kategori: <strong><?= esc($berita['kategori']) ?></strong></span>
            <span>🕒 Dipublikasikan: <?= date('d M Y', strtotime($berita['publish_date'])) ?></span>
        </div>
        <div class="text-sm text-gray-600">✍️ Penulis: <?= esc($berita['penulis']) ?></div>
    </div>

    <?php if (!empty($berita['gambar'])): ?>
        <img src="<?= base_url('uploads/gambar/' . $berita['gambar']) ?>" alt="<?= esc($berita['judul']) ?>" class="w-full h-auto rounded-lg mb-6">
    <?php endif; ?>

    <div class="prose max-w-none text-gray-600 leading-relaxed text-justify font-normal">
    <?= nl2br(esc($berita['isi_berita'])) ?>
    </div>
</div>

<?= $this->endSection(); ?>
