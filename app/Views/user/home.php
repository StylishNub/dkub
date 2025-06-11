<?php $this->extend('layout/templateUser'); ?>
<?php $this->section('content'); ?>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    let slides = <?= json_encode(array_map(fn($h) => [
        'title' => $h['hero_title'],
        'subtitle' => $h['hero_description'],
        'image' => base_url('/uploads/banner/' . $h['hero_image']),
        'link' => '#hero'
    ], $hero)); ?>;
</script>

<section id="hero" class="relative w-full h-[70vh] overflow-hidden text-white bg-[#061767]"
    x-data="{
        slides: slides,
        current: 0,
        next() { this.current = (this.current + 1) % this.slides.length },
        prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length }
    }"
    x-init="setInterval(() => next(), 5000)">
    <template x-for="(slide, index) in slides" :key="index">
        <div x-show="current === index" class="absolute inset-0 transition-opacity duration-1000 ease-in-out">
            <img :src="slide.image" alt="Hero Background" class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="absolute inset-0 z-10 flex flex-col justify-center items-center text-center px-4">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-3" x-text="slide.title"></h2>
                <h3 class="text-xl md:text-2xl text-white text-opacity-90 mb-5" x-text="slide.subtitle"></h3>
            </div>
        </div>
    </template>
    <div class="absolute z-20 bottom-4 left-0 right-0 flex justify-center gap-2">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="current = index" class="w-3 h-3 rounded-full transition-all duration-300 ease-in-out" :class="current === index ? 'bg-white scale-110 ring-2 ring-white' : 'bg-gray-300 opacity-70'"></button>
        </template>
    </div>
</section>

<section id="buttons" class="py-20 px-5 max-w-screen-xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="flex flex-col gap-4">
            <?php if (!empty($dokumen)): ?>
                <a href="<?= base_url('uploads/dokumen/' . $dokumen['file_pdf']) ?>" target="_blank" 
                   class="bg-[#061767] hover:bg-blue-800 hover:scale-105 text-white font-semibold py-4 px-6 rounded-lg text-lg transition duration-300 shadow-md text-center">
                    <i class="fas fa-file-alt mr-2"></i> PROSPECTUS UB
                </a>
            <?php else: ?>
                <div class="bg-gray-300 text-gray-600 py-4 px-6 rounded-lg text-center shadow-md">
                    <i class="fas fa-exclamation-circle mr-2"></i> Prospectus belum tersedia
                </div>
            <?php endif; ?>

            <a href="/mou" class="bg-[#061767] hover:bg-blue-800 hover:scale-105 text-white font-semibold py-4 px-6 rounded-lg text-lg transition duration-300 shadow-md text-center">
                <i class="fas fa-file-pdf mr-2"></i> DRAFT MOU
            </a>
        </div>

        <div class="flex items-center justify-center">
            <a href="/register" class="bg-[#061767] hover:bg-blue-800 hover:scale-105 text-white font-semibold py-10 px-6 rounded-lg text-xl transition duration-300 shadow-md text-center w-full">
                <i class="fas fa-handshake mr-2"></i> PENGAJUAN KERJA SAMA
            </a>
        </div>

        <div class="flex flex-col gap-4">
            <a href="/dinas" class="bg-[#061767] hover:bg-blue-800 hover:scale-105 text-white font-semibold py-4 px-6 rounded-lg text-lg transition duration-300 shadow-md text-center">
                <i class="fas fa-plane-departure mr-2"></i> PERJALANAN DINAS LN
            </a>
            <a href="/pks" class="bg-[#061767] hover:bg-blue-800 hover:scale-105 text-white font-semibold py-4 px-6 rounded-lg text-lg transition duration-300 shadow-md text-center">
                <i class="fas fa-thumbs-up mr-2"></i> DRAFT PKS, MOA, IA
            </a>
        </div>
    </div>
</section>



<section id="about" class="py-16 px-5 bg-blue-900 text-white">
    <div class="max-w-screen-xl mx-auto">
        <h1 class="text-center text-2xl lg:text-3xl font-bold mb-10">SEKILAS DIREKTORAT KERJASAMA UB</h1>
        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-6 lg:gap-10 relative">
            <img src="<?= base_url('/img/logo_ub.png') ?>" class="w-[160px] md:w-[200px] h-auto rounded-lg shadow-md">
            <p class="text-base lg:text-lg leading-relaxed text-justify">
                Keberadaan Universitas Brawijaya didirikan atas jalinan kerja sama yang baik antara birokrat, tokoh masyarakat, dan pengusaha di sekitar Malang. Kerja sama ini berkembang mencakup berbagai instansi pemerintah dan lembaga asing.
            </p>

            <!-- Tombol Selengkapnya -->
            <a href="<?= base_url('/sejarah'); ?>" class="absolute right-0 -bottom-8 lg:bottom-0 mt-4 inline-flex items-center text-sm text-white hover:text-yellow-300 transition">
                Selengkapnya 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</section>


<section id="partnerships" class="bg-[#f9fafb] py-16 lg:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Statistik MoU -->
        <div class="lg:col-span-4">
            <h2 class="text-xl font-bold mb-2 text-gray-800">MoU Statistic 2018-2024</h2>
            <p class="mb-4 text-sm text-gray-600">Berikut Data Statistik MoU Universitas Brawijaya</p>
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="table-auto w-full border border-gray-200 text-sm">
                    <thead>
                        <tr>
                            <th class="border border-gray-200 bg-blue-100 px-4 py-2">Jenis</th>
                            <th class="border border-gray-200 bg-blue-100 px-4 py-2">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($statistik_mou as $item): ?>
                            <tr class="hover:bg-blue-50">
                                <td class="border px-4 py-2 font-semibold text-gray-700">MoU <?= esc($item['tahun']) ?></td>
                                <td class="border px-4 py-2 text-green-600 font-bold"><?= esc($item['jumlah']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Chart -->
        <div class="lg:col-span-8">
            <div class="w-full h-[360px] md:h-[400px] rounded-lg bg-white p-4 shadow-md">
                <canvas id="mouChart"></canvas>
            </div>
        </div>
    </div>
</section>


<section id="recent-news" class="bg-blue-900 pt-12 pb-6">
    <div class="max-w-screen-xl mx-auto px-5">
        <h2 class="text-3xl font-bold text-center text-white mb-8">Berita Terbaru</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($berita as $b): ?>
                <div class="bg-gray-100 rounded-lg overflow-hidden shadow hover:shadow-xl hover:-translate-y-1 transform transition duration-300">
                    <img src="<?= base_url('/uploads/gambar/' . $b['gambar']) ?>" alt="<?= esc($b['judul']) ?>" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <p class="text-sm text-blue-600 font-semibold mb-1">Berita</p>
                        <h3 class="text-lg font-bold text-gray-800 mb-1 line-clamp-2"><?= esc($b['judul']) ?></h3>
                        <p class="text-sm text-gray-600 mb-2"><?= date('d F Y', strtotime($b['publish_date'])) ?></p>
                        <a href="<?= base_url('/berita/detail_berita/' . $b['id']) ?>" class="text-blue-600 hover:underline text-sm">Baca Selengkapnya</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-8">
            <a href="<?= base_url('/berita') ?>" class="inline-block bg-yellow-400 text-white font-semibold py-2 px-5 rounded hover:bg-white hover:text-black transition duration-300 text-sm">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>


<section id="survey" class="bg-[#f9fafb] py-20">
    <div class="max-w-screen-xl mx-auto px-5 flex flex-col lg:flex-row gap-12">
        <div class="lg:w-1/2">
            <img src="/img/ikm.jpg" alt="Survey Image" class="w-full h-auto rounded-lg shadow-lg">
        </div>
        <div class="lg:w-1/2">
            <h2 class="text-3xl font-extrabold mb-4 text-gray-800">Survei Kepuasan Masyarakat</h2>
            <p class="mb-6 text-gray-600">Silakan isi form berikut untuk memberikan masukan atau pertanyaan kepada kami.</p>
            
            <?php if (isset($successMessage)): ?>
                <div class="bg-green-100 border border-green-300 text-green-800 p-4 rounded mb-6 shadow-sm">
                    <?= $successMessage ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('submit-survey'); ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
                    <input type="text" name="name" placeholder="Masukkan nama lengkap" class="w-full border border-gray-300 p-3 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Instansi (opsional)</label>
                    <input type="text" name="instansi" placeholder="Contoh: Universitas Brawijaya" class="w-full border border-gray-300 p-3 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Handphone <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" placeholder="0812xxxxxxx" class="w-full border border-gray-300 p-3 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" placeholder="nama@email.com" class="w-full border border-gray-300 p-3 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pertanyaan / Masukan <span class="text-red-500">*</span></label>
                    <textarea name="question" placeholder="Tuliskan pertanyaan atau masukan Anda di sini..." rows="4" class="w-full border border-gray-300 p-3 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" required></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti (opsional)</label>
                    <input type="file" name="bukti_upload" class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-200" />
                </div>
                <div>
                    <button type="submit" class="w-full bg-[#061767] hover:bg-blue-900 text-white font-semibold py-3 rounded-lg shadow-md transition duration-300 ease-in-out">
                        Kirim Jawaban
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>


<section id="information" class="py-6 bg-[#061767] text-white">
    <div class="max-w-screen-xl mx-auto grid grid-cols-2 md:grid-cols-5 gap-y-4 text-center">
        <div><h3 class="text-lg font-bold">#5</h3><p class="text-xs">Indonesia Webometric</p></div>
        <div><h3 class="text-lg font-bold">#1501+</h3><p class="text-xs">THE’s World University Rankings</p></div>
        <div><h3 class="text-lg font-bold">#801-850</h3><p class="text-xs">QS World University Rankings</p></div>
        <div><h3 class="text-lg font-bold">#5</h3><p class="text-xs">4ICU Indonesian University</p></div>
        <div><h3 class="text-lg font-bold">#140</h3><p class="text-xs">UI GreenMetric World University</p></div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
<script>
    const ctx = document.getElementById('mouChart').getContext('2d');
    const mouChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= $tahun_mou ?? '[]'; ?>,
            datasets: [{
                label: 'Jumlah MoU per Tahun',
                data: <?= $jumlah_mou ?? '[]'; ?>,
                backgroundColor: 'rgba(30, 144, 255, 0.2)',
                borderColor: 'rgba(30, 144, 255, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: 'rgba(30, 144, 255, 1)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                datalabels: {
                    color: '#000',
                    anchor: 'end',
                    align: 'top',
                    font: { weight: 'bold' },
                    formatter: value => value
                },
                title: {
                    display: true,
                    text: 'Statistik MoU Universitas Brawijaya',
                    font: { size: 18 },
                    padding: { top: 10, bottom: 30 }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah MoU'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tahun'
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>


<?php $this->endSection(); ?>
