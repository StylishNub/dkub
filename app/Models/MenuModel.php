<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama','slug','kategori', 'induk', 'status','id_status'];
    protected $useTimestamps = false;

    protected $returnType = 'array';
}



