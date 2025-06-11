<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'pengaduan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama',
        'instansi',
        'email',
        'no_hp',
        'pertanyaan',
        'bukti_upload',
        'balasan'
    ];
}
