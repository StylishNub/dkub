<?php

namespace App\Models;

use CodeIgniter\Model;

class SubMenuModel extends Model
{
    protected $table = 'submenu';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama','slug','kategori', 'kategori_id','menu_id', 'status','id_status'];
    protected $useTimestamps = false;

    protected $returnType = 'array';
}
