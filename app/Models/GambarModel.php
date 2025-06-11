<?php

namespace App\Models;

use CodeIgniter\Model;

class GambarModel extends Model
{
    protected $table = 'gambar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama','kategori','gambar', 'status', 'id_status'];
}
