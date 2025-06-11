<?php $this->extend('layout/templateAdmin'); ?>
<?php $this->section('content'); ?>

<h1 class="text-2xl font-bold mt-10 mb-6 text-gray-800">👤 Manajemen User</h1>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white max-h-[500px] border border-gray-200">
    <!-- Search -->
    <div class="flex justify-between items-center px-4 py-3 bg-gray-100 border-b">
        <form action="/kelola_user" method="GET" class="flex items-center w-full max-w-sm ml-auto">
            <input type="text" name="keyword" class="w-full p-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Cari user..." value="<?= isset($_GET['keyword']) ? esc($_GET['keyword']) : '' ?>">
            <button type="submit" class="ml-2 p-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </form>
    </div>


    <!-- Table -->
    <table class="w-full text-sm text-left text-gray-700">
        <thead class="bg-slate-100 text-gray-700 sticky top-0 z-10">
            <tr>
                <th class="px-6 py-3 font-semibold">Nama</th>
                <th class="px-6 py-3 font-semibold">Email</th>
                <th class="px-6 py-3 font-semibold">Instansi</th>
                <th class="px-6 py-3 font-semibold">Kepentingan</th>
                <th class="px-6 py-3 font-semibold">Status</th>
                <th class="px-6 py-3 font-semibold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php foreach ($user as $index => $user): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium truncate max-w-[200px]"><?= esc($user['name']) ?></td>
                    <td class="px-6 py-4 font-medium truncate max-w-[200px]"><?= esc($user['email']) ?></td>
                    <td class="px-6 py-4 font-medium truncate max-w-[200px]"><?= esc($user['instansi']) ?></td>
                    <td class="px-6 py-4 truncate max-w-[150px]"><?= esc($user['kepentingan']) ?></td>
                    <td class="px-6 py-4 capitalize">
                        <?php if ($user['status'] === 'pending'): ?>
                            <span class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded">Pending</span>
                        <?php elseif ($user['status'] === 'approved'): ?>
                            <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">Approved</span>
                        <?php elseif ($user['status'] === 'rejected'): ?>
                            <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded">Rejected</span>
                        <?php else: ?>
                            <span class="text-gray-500 italic">Unknown</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center items-center gap-2">
                            <?php if ($user['status'] == 'pending'): ?>
                                <a href="kelola_user/approve/<?= esc($user['id']) ?>" title="Approve" class="text-green-600 hover:text-green-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </a>
                                <a href="kelola_user/reject/<?= esc($user['id']) ?>" title="Reject" onclick="return confirm('Yakin ingin menolak user ini?');" class="text-red-600 hover:text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            <?php else: ?>
                                <span class="text-gray-400 italic">No Action</span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
$currentPage = $pager->getCurrentPage('user'); // 'user' = group pager
$totalPages = $pager->getPageCount('user');
?>

<div class="flex justify-center py-4 text-sm text-gray-700">
    <div class="inline-flex items-center space-x-3">
        <?php if ($currentPage > 1): ?>
            <a href="<?= $pager->getPageURI($currentPage - 1, 'user') ?>"
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
            <a href="<?= $pager->getPageURI($currentPage + 1, 'user') ?>"
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
