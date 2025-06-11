<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanModel extends Model
{
    protected $table = 'pengajuan_kerjasama';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'email_pengguna_jawab',
        'nama_instansi_mitra',
        'no_telp_mitra',
        'bidang_kerjasama',
        'surat_permohonan',
        'draft_permintaan_dokumen',
        'status_surat',
        'status_dokumen',
        'rencana_kegiatan',
        'deskripsi_kegiatan',
        'waktu_pelaksanaan_tgl',
        'kategori_kegiatan',
        'alasan_ditolak',
        'user_id'  // Menambahkan kolom user_id
    ];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getUserPengajuan($userId)
    {
        return $this->where('user_id', $userId)
                   ->orderBy('created_at', 'DESC')
                   ->findAll();
    }
}
