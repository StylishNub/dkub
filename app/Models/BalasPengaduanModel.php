<?php

namespace App\Models;

use CodeIgniter\Model;

class BalasPengaduanModel extends Model
{
    protected $table = 'balas_pengaduan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['balasan','status', 'id_pengaduan', 'id_status','id_user'];
    protected $useTimestamps = false;

    protected $returnType = 'array';
}
