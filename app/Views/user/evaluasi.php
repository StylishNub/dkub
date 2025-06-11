<?= $this->extend('layout/templateUser'); ?>
<?= $this->section('content'); ?>

<?php 
    $segment1 = service('uri')->getSegment(1);
    $title = ucwords(str_replace('-', ' ', $segment1));
?>

<!-- Header Hero -->
<div class="relative w-full h-[60vh] bg-cover bg-center" style="background-image: url('<?= base_url('/img/ub_header.jpeg') ?>');">
    <div class="absolute inset-0 bg-blue-900 bg-opacity-60"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-4">
        <h1 class="text-4xl md:text-5xl font-extrabold text-[#F9A826]"><?= strtoupper($title) ?></h1>
        <div class="mt-2 text-sm font-medium tracking-wide">
            <a href="<?= base_url('/') ?>" class="text-white hover:text-[#F9A826]">Jaminan Mutu</a>
            <span class="mx-2 text-[#F9A826]">›</span>
            <span class="text-white"><?= strtoupper($title) ?></span>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800"><?= strtoupper($title) ?></h2>
        <p class="mt-2 text-gray-500 text-sm md:text-base">Berikut adalah evaluasi dan informasi terkait <strong><?= $title; ?></strong> yang telah dihimpun melalui survei kepuasan masyarakat.</p>
    </div>

    <!-- Chart Section -->
    <div class="bg-white p-6 rounded-xl shadow-md mb-10 max-w-md mx-auto border">
        <h3 class="text-lg font-semibold text-center text-blue-800 mb-4">Grafik IKM</h3>
        <canvas id="evaluationPieChart" class="w-full"></canvas>
    </div>

    <!-- Kesimpulan -->
    <div class="text-center mb-16 px-4 md:px-20">
        <h3 class="text-2xl font-semibold text-[#F9A826] mb-4">Kesimpulan & Rekomendasi</h3>
        <p class="text-gray-700 text-justify leading-relaxed">
            Berdasarkan hasil survei, nilai rata-rata IKM Direktorat Kerjasama Universitas Brawijaya adalah <strong><?= number_format($rata_rata, 2) ?></strong> 
            dengan total skor <strong><?= number_format($persentase, 2) ?>%</strong>. Berdasarkan pedoman IKM, nilai tersebut termasuk kategori 
            <strong><?= $predikat ?></strong>. Ini menunjukkan bahwa sebagian besar responden merasa sangat puas terhadap kualitas layanan yang diberikan. 
            Evaluasi ini mencakup aspek prosedur, waktu layanan, kompetensi petugas, hingga fasilitas sarana dan prasarana.
        </p>
    </div>

    <!-- Tabel Evaluasi dari Database -->
    <div class="bg-white p-6 rounded-xl shadow-sm mb-10 border">
        <h3 class="text-lg font-semibold text-center text-blue-800 mb-4">Detail Indikator Evaluasi</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-300 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border text-left">Indikator</th>
                        <th class="px-4 py-2 border">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jaminanmutu as $i => $row): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border text-center"><?= $i + 1 ?></td>
                        <td class="px-4 py-2 border"><?= esc($row['indikator']) ?></td>
                        <td class="px-4 py-2 border text-center"><?= esc($row['nilai']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Pedoman Penilaian -->
    <div class="bg-white p-6 rounded-xl shadow-sm border">
        <h3 class="text-lg font-semibold text-center text-blue-800 mb-4">Pedoman Penilaian IKM</h3>
        <table class="min-w-full table-auto border border-gray-300 text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Interval IKM</th>
                    <th class="px-4 py-2 border">Skor (%)</th>
                    <th class="px-4 py-2 border">Mutu</th>
                    <th class="px-4 py-2 border">Kinerja</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr><td class="px-4 py-2 border">1</td><td class="px-4 py-2 border">1,00 – 1,75</td><td class="px-4 py-2 border">25 – 43,75</td><td class="px-4 py-2 border">D</td><td class="px-4 py-2 border">Tidak Baik</td></tr>
                <tr><td class="px-4 py-2 border">2</td><td class="px-4 py-2 border">1,76 – 2,50</td><td class="px-4 py-2 border">43,76 – 62,50</td><td class="px-4 py-2 border">C</td><td class="px-4 py-2 border">Kurang Baik</td></tr>
                <tr><td class="px-4 py-2 border">3</td><td class="px-4 py-2 border">2,51 – 3,25</td><td class="px-4 py-2 border">62,51 – 81,25</td><td class="px-4 py-2 border">B</td><td class="px-4 py-2 border">Baik</td></tr>
                <tr><td class="px-4 py-2 border">4</td><td class="px-4 py-2 border">3,26 – 4,00</td><td class="px-4 py-2 border">81,26 – 100,00</td><td class="px-4 py-2 border">A</td><td class="px-4 py-2 border">Sangat Baik</td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Chart Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('evaluationPieChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['IKM (<?= number_format($persentase, 2) ?>%)', 'Sisa (<?= number_format(100 - $persentase, 2) ?>%)'],
            datasets: [{
                data: [<?= $persentase ?>, <?= 100 - $persentase ?>],
                backgroundColor: ['#36A2EB', '#E5E7EB'],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

<?= $this->endSection(); ?>
