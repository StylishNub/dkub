<?php

namespace App\Models;

use CodeIgniter\Model;

class KerjasamaModel extends Model
{
    protected $table = 'mou';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_mitra','tahun','jangka_waktu', 'tanggal_mulai', 'tanggal_berakhir','file_pdf', 'status', 'id_status'];

    public function getStatistikMouPerTahun()
    {
        return $this->db->table('mou')
            ->select('CONCAT("MOU Tahun ", tahun) as nama, tahun, COUNT(id) as jumlah')
            ->groupBy('tahun')
            ->orderBy('tahun', 'DESC')
            ->get()
            ->getResultArray();
    }
    

}
