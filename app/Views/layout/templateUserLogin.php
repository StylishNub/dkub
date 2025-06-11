<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Actor&family=Alegreya:ital,wght@0,400..900;1,400..900&family=Aleo:ital,wght@0,100..900;1,100..900&family=Gowun+Batang&family=Gravitas+One&family=Katibeh&family=Marcellus&family=Purple+Purse&family=Quattrocento:wght@400;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sree+Krushnadevaraya&display=swap" rel="stylesheet">
    <title><?= $title; ?></title>
    <link href="<?= base_url() ?>css/style.css" rel="stylesheet" />
    <style>
        #logo-sidebar::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }
        #logo-sidebar .h-full {
            height: calc(100vh - 100px);
            overflow-y: auto;
        }
    </style>
</head>

<body class="antialiased leading-default bg-[#F6F6F6] text-black">
    <!-- Sidebar -->
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform bg-[#110F36] border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
        <div class="flex flex-col items-center p-4">
            <img src="/img/logo_dk.png" alt="Logo DK" class="h-[80px] mb-4">
            <div class="border-t border-white w-full mb-4"></div>
            <nav class="w-full">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a class="flex items-center p-3 text-white rounded-lg transition hover:bg-[#FFBE1A] <?= $menu == 'user_home' ? 'bg-[#FFBE1A] text-black font-semibold' : '' ?>" href="<?= base_url('user_home') ?>">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span>Dashboard User</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center p-3 text-white rounded-lg transition hover:bg-[#FFBE1A] <?= $menu == 'pengajuan_kerjasama' ? 'bg-[#FFBE1A] text-black font-semibold' : '' ?>" href="<?= base_url('view_pengajuan') ?>">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span>Pengajuan Kerjasama</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center p-3 text-white rounded-lg transition hover:bg-[#FFBE1A]" href="<?= base_url('logout') ?>">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 18 16">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                            </svg>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-0 sm:ml-64 pt-4 px-4">
        <?php $this->renderSection('content'); ?>
    </main>

    <script src="<?= base_url() ?>js/main.js"></script>
</body>

</html>