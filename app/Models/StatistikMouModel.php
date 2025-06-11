<?php

namespace App\Models;

use CodeIgniter\Model;

class StatistikMouModel extends Model
{
    protected $table = 'statistik_mou';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama','tahun', 'id_mou', 'id_status'];

    public function getJumlahMouAktifPerTahun()
    {
        return $this->select('statistik_mou.nama, statistik_mou.tahun, COUNT(mou.id) as jumlah, status.status')
                    ->join('mou', 'mou.id = statistik_mou.id_mou')
                    ->join('status', 'status.id = statistik_mou.id_status')
                    ->groupBy('statistik_mou.tahun, statistik_mou.nama, status.status')
                    ->orderBy('statistik_mou.tahun', 'DESC')
                    ->findAll();
    }

}
