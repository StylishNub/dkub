<?php $this->extend('layout/templateAdmin'); ?>

<?php $this->section('content'); ?>

<div class="max-w-5xl mx-auto px-4 py-10 space-y-10 bg-slate-100 min-h-screen">

    <h1 class="text-4xl font-bold text-center text-indigo-800">Detail Pengajuan Kerjasama</h1>

    <div class="rounded-xl overflow-hidden shadow-xl ring-1 ring-slate-300 bg-white">

        <!-- Header Mitra -->
        <div class="bg-gradient-to-r from-indigo-700 to-blue-600 px-6 py-4">
            <h2 class="text-2xl font-semibold text-white">🧾 Informasi Mitra</h2>
        </div>

        <!-- Isi Mitra -->
        <div class="px-6 py-6 space-y-6 bg-white">
            <div>
                <h3 class="text-slate-700 font-semibold text-lg mb-1">Nama Instansi</h3>
                <div class="bg-slate-50 p-4 rounded-md border-l-4 border-indigo-500 text-slate-900 shadow-sm">
                    <?= $pengajuan['nama_instansi_mitra']; ?>
                </div>
            </div>
            <div>
                <h3 class="text-slate-700 font-semibold text-lg mb-1">Kontak</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="bg-slate-50 p-4 rounded-md border-l-4 border-indigo-500">
                        <strong>Email:</strong> <?= $pengajuan['email_pengguna_jawab']; ?>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-md border-l-4 border-indigo-500">
                        <strong>No. Telp Mitra:</strong> <?= $pengajuan['no_telp_mitra']; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kegiatan -->
        <div class="bg-slate-100 px-6 py-6">
            <h3 class="text-xl font-semibold text-slate-800 mb-4">📌 Informasi Kegiatan</h3>
            <div class="space-y-2 text-slate-700">
                <p><strong>Bidang Kerjasama:</strong> <?= $pengajuan['bidang_kerjasama']; ?></p>
                <p><strong>Rencana Kegiatan:</strong> <?= $pengajuan['rencana_kegiatan']; ?></p>
                <p><strong>Deskripsi Kegiatan:</strong> <?= $pengajuan['deskripsi_kegiatan']; ?></p>
            </div>
        </div>

        <!-- Status -->
        <div class="bg-white px-6 py-6 border-t border-slate-200">
            <h3 class="text-xl font-semibold text-slate-800 mb-4">🔖 Status</h3>
            <div class="flex flex-col md:flex-row justify-between items-start gap-6 text-slate-700">
                <div>
                    <p><strong>Status Surat:</strong> <?= $pengajuan['status_surat']; ?></p>
                    <?php if ($pengajuan['status_surat'] == 'Menunggu') : ?>
                        <div class="mt-2 flex gap-2">
                            <button id="approveSurat" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Setujui</button>
                            <button id="rejectSurat" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Tolak</button>
                        </div>
                    <?php elseif ($pengajuan['status_surat'] == 'Ditolak') : ?>
                        <p class="text-red-600 mt-2"><strong>Alasan:</strong> <?= esc($pengajuan['alasan_ditolak']); ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <p><strong>Status Dokumen:</strong> <?= $pengajuan['status_dokumen']; ?></p>
                    <?php if (
                        $pengajuan['status_surat'] == 'Disetujui' &&
                        $pengajuan['status_dokumen'] != 'Ditolak' &&
                        $pengajuan['status_dokumen'] != 'Selesai' 
                    ) : ?>
                        <div class="flex gap-2 mt-2">
                            <button id="approveDokumenUpdate" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Update</button>
                            <button id="rejectDokumen" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Tolak</button>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <!-- Tanggal -->
        <div class="bg-slate-50 px-6 py-6 border-t border-slate-200 text-slate-700">
            <h3 class="text-xl font-semibold text-slate-800 mb-2">📅 Tanggal</h3>
            <p><strong>Tanggal Pelaksanaan:</strong> <?= $pengajuan['waktu_pelaksanaan_tgl']; ?></p>
            <p><strong>Kategori Kegiatan:</strong> <?= $pengajuan['kategori_kegiatan']; ?></p>
        </div>

        <!-- Dokumen -->
        <div class="bg-white px-6 py-6 border-t border-slate-200 space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-700 mb-1">📄 Surat Permohonan</h4>
                <div class="border border-slate-300 rounded">
                    <embed src="<?= base_url('uploads/dokumen/' . $pengajuan['surat_permohonan']); ?>" width="100%" height="400px" type="application/pdf">
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-slate-700 mb-1">📁 Draft Permintaan Dokumen</h4>
                <div class="border border-slate-300 rounded">
                    <embed src="<?= base_url('uploads/dokumen/' . $pengajuan['draft_permintaan_dokumen']); ?>" width="100%" height="400px" type="application/pdf">
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-slate-100 px-6 py-4 text-center">
            <a href="/kelola_pengajuan" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">⬅ Kembali</a>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
const id = <?= $pengajuan['id']; ?>;

// ======== SETUJUI SURAT ========
document.getElementById("approveSurat")?.addEventListener("click", () => {
    fetch(`/kelola_pengajuan/update_status/${id}/surat/approve`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert("Surat berhasil disetujui.");
            location.reload();
        }
    });
});

// ======== TOLAK SURAT ========
document.getElementById("rejectSurat")?.addEventListener("click", () => {
    const alasan = prompt("Masukkan alasan penolakan surat:");
    if (!alasan || alasan.trim() === "") {
        alert("Alasan tidak boleh kosong.");
        return;
    }

    fetch(`/kelola_pengajuan/update_status/${id}/surat/reject`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ alasan: alasan })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert("Surat berhasil ditolak.");
            location.reload();
        }
    });
});

// ======== UPDATE STATUS DOKUMEN ========
document.getElementById("approveDokumenUpdate")?.addEventListener("click", () => {
    const current = "<?= $pengajuan['status_dokumen']; ?>";
    const next = {
        "Disposisi Rektor/WR": "Disposisi Direktur",
        "Disposisi Direktur": "Disposisi Sekdir",
        "Disposisi Sekdir": "Disposisi Kasubdit",
        "Disposisi Kasubdit": "Selesai"
    }[current];

    if (!next) return;

    fetch(`/kelola_pengajuan/update_status/${id}/dokumen/approve`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ status_dokumen: next })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert("Status dokumen diperbarui.");
            location.reload();
        }
    });
});

// ======== TOLAK DOKUMEN ========
document.getElementById("rejectDokumen")?.addEventListener("click", () => {
    const alasan = prompt("Masukkan alasan penolakan dokumen:");
    if (!alasan || alasan.trim() === "") {
        alert("Alasan tidak boleh kosong.");
        return;
    }

    fetch(`/kelola_pengajuan/update_status/${id}/dokumen/reject`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ alasan: alasan })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert("Dokumen berhasil ditolak.");
            location.reload();
        }
    });
});
</script>

<?php $this->endSection(); ?>
