<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisDokumenModel extends Model
{
    protected $table = 'jenis_dokumen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis','keterangan'];
}
