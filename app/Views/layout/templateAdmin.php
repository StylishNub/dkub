<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link href="<?= base_url() ?>css/style.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        #logo-sidebar {
            height: 100vh;
            font-size: 14px;
            overflow: hidden; /* penting biar anak-nya tidak keluar */
            display: flex;
            flex-direction: column;
        }

        #logo-sidebar .scroll-container {
            flex: 1;
            overflow-y: auto;
            scrollbar-width: none;
        }

        #logo-sidebar .scroll-container::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }

        #logo-sidebar h3 {
            font-size: 12px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-top: 1.5rem;
            margin-bottom: 0.25rem;
        }

        #logo-sidebar a {
            transition: all 0.2s ease-in-out;
        }

        #logo-sidebar a:hover {
            background-color: #FFBE1A;
            color: #1F2937;
        }

        #logo-sidebar a.active {
            background-color: #FFBE1A;
            color: #1F2937;
        }
    </style>
</head>

<body class="bg-[#F6F6F6] text-black">

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen bg-[#110F36] border-r border-gray-200 sm:translate-x-0">
    <img src="/img/logo_dk.png" alt="Logo" class="h-[90px] mb-4 mt-2 p-1 mx-auto" />
    <div class="border-t-2 border-white my-4 mx-4"></div>

    <div class="scroll-container px-3 pb-4">
        <ul class="space-y-2 font-medium text-white text-sm">

                <!-- Dashboard -->
                <li>
                    <a href="<?= base_url('dashboard') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'dashboard' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-9 4h4v4h-4v-4z"/></svg>
                        Dashboard
                    </a>
                </li>

                <!-- Manajemen User -->
                <li>
                    <h3 class="text-xs uppercase tracking-wider mt-6 px-2">Manajemen</h3>
                    <a href="<?= base_url('kelola_user') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'kelola_user' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Manajemen User
                    </a>
                </li>

                <!-- Beranda -->
                <li>
                    <h3 class="text-xs uppercase tracking-wider mt-6 px-2">Beranda</h3>
                    <a href="<?= base_url('hero_content') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'hero_content' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        Kelola Hero
                    </a>
                    <a href="<?= base_url('kelola_gambar') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'kelola_gambar' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h18v14H3V5z"/></svg>
                        Kelola Gambar
                    </a>
                </li>

                <!-- SDM -->
                <li>
                    <h3 class="text-xs uppercase tracking-wider mt-6 px-2">SDM</h3>
                    <a href="<?= base_url('kelola_sdm') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'kelola_sdm' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c4.418 0 8 1.79 8 4v2H4v-2c0-2.21 3.582-4 8-4z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10a4 4 0 100-8 4 4 0 000 8z"/></svg>
                        Kelola SDM
                    </a>
                    <a href="<?= base_url('kelola_jabatan') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'kelola_jabatan' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 018 0v2m-5-6a4 4 0 110-8 4 4 0 010 8z"/></svg>
                        Kelola Jabatan
                    </a>
                </li>

                <!-- Profil -->
                <li>
                    <h3 class="text-xs uppercase tracking-wider mt-6 px-2">Profil</h3>
                    <a href="<?= base_url('kelola_profil') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'kelola_profil' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804"/></svg>
                        Kelola Profil
                    </a>
                    <a href="<?= base_url('kelola_progja') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'kelola_progja' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>
                        Kelola Program
                    </a>
                </li>

                <!-- Kerjasama -->
                <li>
                    <h3 class="text-xs uppercase tracking-wider mt-6 px-2">Kerjasama</h3>
                    <a href="<?= base_url('kelola_kerjasama') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'kelola_kerjasama' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8H6a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"/></svg>
                        Kelola MOU
                    </a>
                    <a href="<?= base_url('kelola_pengajuan') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'kelola_pengajuan' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M5 4v16"/></svg>
                        Kelola Pengajuan
                    </a>
                    <a href="<?= base_url('statistik_mou') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'statistik_mou' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17v-6M15 17V9M7 17v-4M3 3v18h18"/></svg>
                        Statistik MOU
                    </a>
                </li>

                <!-- Jaminan Mutu -->
                <li>
                    <h3 class="text-xs uppercase tracking-wider mt-6 px-2">Jaminan Mutu</h3>
                    <a href="<?= base_url('jaminan_mutu') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'jaminan_mutu' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Kelola Jaminan Mutu
                    </a>
                </li>

                <!-- Berita -->
                <li>
                    <h3 class="text-xs uppercase tracking-wider mt-6 px-2">Berita</h3>
                    <a href="<?= base_url('kelola_berita') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'kelola_berita' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Kelola Berita
                    </a>
                    <a href="<?= base_url('kelola_kategori_berita') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'kelola_kategori_berita' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Kelola Kategori
                    </a>
                </li>

                <!-- Dokumen -->
                <li>
                    <h3 class="text-xs uppercase tracking-wider mt-6 px-2">Dokumen</h3>
                    <a href="<?= base_url('kelola_dokumen') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'kelola_dokumen' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6M9 16h6M5 4v16"/></svg>
                        Kelola Dokumen
                    </a>
                </li>

                <!-- Pengaduan -->
                <li>
                    <h3 class="text-xs uppercase tracking-wider mt-6 px-2">Pengaduan</h3>
                    <a href="<?= base_url('kelola_pengaduan') ?>" class="flex items-center px-4 py-2 rounded-md <?= $menu == 'kelola_pengaduan' ? 'bg-[#FFBE1A] text-gray-900' : '' ?>">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8h2a2 2 0 012 2v10H3V10a2 2 0 012-2h2M12 15h.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Kelola Pengaduan
                    </a>
                </li>

                <!-- Logout -->
                <li class="mt-6">
                    <a href="<?= base_url('logout') ?>" class="flex items-center p-2 text-white rounded-lg hover:bg-red-600 transition-all group">
                        <svg class="w-5 h-5 text-white group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
                        </svg>
                        <span class="ml-3">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main content -->
    <main class="ml-64 p-6">
        <?php $this->renderSection('content'); ?>
    </main>

    <script src="<?= base_url() ?>js/main.js"></script>
</body>

</html>
