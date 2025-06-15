<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rokkitt:wght@100..900&family=Abril+Fatface&family=Actor&display=swap" rel="stylesheet">
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            <?php if (session()->getFlashdata('error')) : ?>
                document.getElementById('myModal1').classList.remove('hidden');
            <?php endif; ?>
        });
    </script>
</head>
<body class="antialiased leading-default bg-[#F6F6F6] font-bold">
    <!-- Navbar -->
    <nav class="bg-[#061767] w-full px-4 md:px-10 py-3 top-0 left-0 z-50 shadow-lg"x-data="{ open: false, openMenu: null }">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <img src="<?= base_url('/img/logo_dk.png') ?>" alt="Logo DK" class="h-[60px] md:h-[80px]">

                <!-- Toggle Button (Mobile) -->
                <button @click="open = !open" class="text-white md:hidden focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

<!-- Desktop Menu -->
<div class="hidden md:flex gap-6 font-sans font-extrabold text-white text-[12px] uppercase items-center">
    <a href="<?= base_url('/') ?>" class="<?= service('uri')->getSegment(1) == '' ? 'text-[#F9A826]' : 'text-white' ?> hover:text-[#F9A826] transition">Home</a>

    <?php
    $uri = service('uri');
    $current = $uri->getSegment(1);
    $menus = [
        'Profil' => [
            'Sejarah' => 'sejarah', 
            'Visi Misi' => 'visimisi', 
            'Struktur Organisasi' => 'organisasi',
            'Sumber Daya Manusia' => 'sdm',
            'Program Kerja' => 'progja'
        ],
        'Kerjasama' => [
            'Daftar Kerjasama' => 'kerjasama',
            'Draft MOU' => 'mou',
            'Draft PKS, MOA, IA' => 'pks',
        ],
        'Jaminan Mutu' => [
            'Evaluasi Kerjasama' => 'evaluasi',
            'SOP Kerjasama' => 'sop'
        ],
        'Dokumen' => [
            'Dokumen Hukum' => 'pertor'
        ]
    ];
    ?>

    <?php foreach ($menus as $menu => $submenu): ?>
        <?php $isActive = in_array($current, $submenu) ? 'text-[#F9A826]' : 'text-white'; ?>
        <div class="relative group">
            <button class="flex items-center gap-1 <?= $isActive ?> hover:text-[#F9A826] transition duration-200">
                <?= strtoupper($menu) ?>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mt-[1px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="absolute left-0 mt-3 min-w-[180px] bg-[#0A0A2A] rounded-md shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                <?php foreach ($submenu as $name => $link): ?>
                    <a href="<?= base_url($link) ?>" class="block px-4 py-2 text-[12px] font-medium text-white hover:bg-[#141446] transition <?= $current == $link ? 'bg-[#141446]' : '' ?>">
                        <?= strtoupper($name) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <a href="<?= base_url('berita') ?>" class="<?= $current == 'berita' ? 'text-[#F9A826]' : 'text-white' ?> hover:text-[#F9A826] transition">BERITA</a>
</div>

<!-- Mobile Menu -->
<div x-show="open" x-cloak class="mt-4 md:hidden flex flex-col gap-3 text-white font-bold text-sm">
    <a href="<?= base_url('/') ?>" class="px-2 <?= service('uri')->getSegment(1) == '' ? 'text-[#F9A826]' : 'text-white' ?>">Home</a>

    <?php foreach ($menus as $menu => $submenu): ?>
        <?php $menuKey = strtolower(str_replace(' ', '_', $menu)); ?>
        <div class="px-2">
            <button @click="openMenu === '<?= $menuKey ?>' ? openMenu = null : openMenu = '<?= $menuKey ?>'"
                    class="w-full text-left flex justify-between items-center uppercase text-[#F9A826]">
                <?= strtoupper($menu) ?>
                <svg class="w-4 h-4 transform transition-transform duration-200"
                    :class="openMenu === '<?= $menuKey ?>' ? 'rotate-180' : ''"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openMenu === '<?= $menuKey ?>'" x-cloak class="pl-3 mt-2 space-y-1">
                <?php foreach ($submenu as $name => $link): ?>
                    <a href="<?= base_url($link) ?>" class="block font-medium hover:text-[#F9A826] <?= $current == $link ? 'text-[#F9A826]' : 'text-white' ?>">
                        <?= strtoupper($name) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <a href="<?= base_url('berita') ?>" class="px-2 <?= $current == 'berita' ? 'text-[#F9A826]' : 'text-white' ?>">Berita</a>
</div>

        </nav>

    <!-- Main Content -->
    <main class="">
        <?php $this->renderSection('content'); ?>
    </main>

    <footer class="bg-[#002366] text-white pt-10">
    <div class="max-w-screen-xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-x-10 gap-y-10 text-sm">
        <!-- OUR OFFICE -->
        <div class="lg:col-span-3">
            <div class="flex items-center mb-4 gap-3">
                <img src="<?= base_url('/img/logo_dk.png') ?>" alt="Logo" class="w-30 h-18">
            </div>
            <p class="mb-1">Gedung Rektorat Lantai 2 UB</p>
            <p class="mb-1">(+62) 822-2656-6675 / (0341)551611</p>
            <p class="mb-1">Instagram</p>
            <p>kerjasama@ub.ac.id</p>
        </div>

        <!-- OFFICE HOURS -->
        <div class="lg:col-span-3">
            <h4 class="font-semibold mb-3">OFFICE HOURS</h4>
            <p class="mb-1">MONDAY–THURSDAY<br><span class="ml-2">7.30 – 16.00</span></p>
            <p class="mb-1">FRIDAY<br><span class="ml-2">7.30 – 16.30</span></p>
            <p>SATURDAY & SUNDAY<br><span class="ml-2">CLOSED</span></p>
        </div>

        <!-- QUICK LINK -->
        <div class="lg:col-span-3">
            <h4 class="font-semibold mb-3">QUICK LINK</h4>
            <ul class="space-y-1">
                <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSe0GTSglUm3rwQFNpzPtSLeiNm10heP3fkZXGC7eWvbn4PZqA/viewform?usp=send_form" class="hover:underline font-bold">Temporary Trading Zone</a><br><span class="text-xs">(Identifikasi Peluang Kerja Sama)</span></li>
                <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSf9dv2Db5OlaPZwQcvjVczjNJ-7rvaZjBwt9deGPfGJ0ZIi6A/viewform" class="hover:underline font-bold">Penilaian Potensi Mitra</a></li>
                <li><a href="https://ikm.ub.ac.id//survei/?data=eyJpZF91bml0IjoiODgyIiwidW5pdF9ha3RpZiI6IkRpcmVrdG9yYXQgS2VyamEgU2FtYSJ9" class="hover:underline font-bold">Survey Kepuasan Pengguna</a></li>
                <li><a href="#https://ub-care.ub.ac.id/" class="hover:underline font-bold">Feedback</a></li>
            </ul>
        </div>

        <!-- VISIT STATS -->
        <div class="lg:col-span-3">
            <h4 class="font-semibold mb-3">TODAY VISITS</h4>
            <p class="mb-1">48 visits today</p>
            <p class="mb-4">24 visitors today</p>

            <h4 class="font-semibold mb-2">TOTAL VISITS</h4>
            <p class="mb-1">7,785 visits</p>
            <p>4,791 visitors</p>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="bg-[#1a1446] text-center text-xs text-white py-4 mt-8">
        <p>Copyright © 
            <a href="#" class="text-yellow-400 hover:underline">Direktorat Kerja Sama</a>, 
            All Right Reserved.
        </p>
    </div>
</footer>




    <script>
        // Toggle Menu for Mobile Devices
        function toggleMenu() {
            const menu = document.querySelector('.lg\\:flex');
            menu.classList.toggle('hidden');
        }

        document.querySelectorAll('[data-modal-target]').forEach(button => {
            button.addEventListener('click', function () {
                document.querySelector(this.dataset.modalTarget).classList.remove('hidden');
            });
        });
        
        document.querySelectorAll('[data-modal-close]').forEach(button => {
            button.addEventListener('click', function () {
                document.querySelector(this.dataset.modalClose).classList.add('hidden');
            });
        });
        
        window.addEventListener('click', function (event) {
            document.querySelectorAll('.modal').forEach(modal => {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
