<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<h1 class="text-2xl font-bold mt-10 mb-6 text-gray-800">🎨 Manajemen Hero Content</h1>

<div class="shadow-md sm:rounded-lg bg-white border border-gray-200">

<?php $errors = session()->getFlashdata('errors'); ?>
    <?php if ($errors !== null && is_array($errors)) : ?>
        <div class="p-4 mb-6 text-sm text-red-800 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-900">
            <strong class="font-semibold">Terdapat beberapa error:</strong>
            <ul class="mt-2 list-disc list-inside">
                <?php foreach ($errors as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')) : ?>
    <div class="p-4 mb-6 text-sm text-green-800 bg-green-100 rounded-lg">
        <?= session()->getFlashdata('success') ?>
    </div>
        <script>
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) alert.remove();
        }, 3000); // 3000 ms = 3 detik
    </script>
<?php endif; ?>
    <!-- Header + Search -->
    <div class="flex justify-between items-center px-4 py-3 bg-gray-100 border-b">
        <a href="/hero_content/tambah_hero" class="inline-flex gap-2 items-center bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded-md">
            <span>Add Hero Content</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </a>

        <form action="/hero_content" method="GET" class="flex items-center space-x-2">
            <input type="text" name="keyword" class="p-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500" placeholder="Cari..." value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
            <button type="submit" class="p-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </form>
    </div>

    <!-- Table -->
    <table class="w-full text-sm text-left text-gray-800">
        <thead class="bg-slate-100 text-gray-700">
            <tr>
                <th class="px-6 py-3 font-semibold">Gambar</th>
                <th class="px-6 py-3 font-semibold">Judul</th>
                <th class="px-6 py-3 font-semibold">Deskripsi</th>
                <th class="px-6 py-3 font-semibold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php foreach ($hero_content as $r): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <img src="/uploads/banner/<?= esc($r['hero_image']); ?>" alt="Hero Image" class="w-24 h-auto rounded-md shadow-md" />
                    </td>
                    <td class="px-6 py-4 font-medium max-w-[160px] truncate">
                        <?= esc($r['hero_title']); ?>
                    </td>
                    <td class="px-6 py-4 font-normal max-w-[240px] truncate">
                        <?= esc($r['hero_description']); ?>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="inline-flex gap-3">
                            <!-- Edit -->
                            <a href="/hero_content/edit_hero/<?= esc($r['id']); ?>" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 hover:text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                                </svg>
                            </a>

                            <!-- Delete -->
                            <a href="/hero_content/delete_hero/<?= esc($r['id']); ?>" onclick="return confirm('Yakin ingin menghapus Hero Content ini?');" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600 hover:text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="flex justify-center py-4 text-sm text-gray-700">
        <div class="inline-flex items-center space-x-3">
            <?php if ($currentPage > 1): ?>
                <a href="<?= $pager->getPageURI($currentPage - 1, 'hero') ?>"
                   class="px-3 py-1 border rounded hover:bg-gray-100">
                    &laquo; Previous
                </a>
            <?php else: ?>
                <span class="px-3 py-1 border rounded text-gray-400 cursor-not-allowed">
                    &laquo; Previous
                </span>
            <?php endif; ?>

            <span>Page <?= $currentPage ?> of <?= $totalPages ?></span>

            <?php if ($currentPage < $totalPages): ?>
                <a href="<?= $pager->getPageURI($currentPage + 1, 'hero') ?>"
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

<?php $this->endSection(); ?>
