<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $table = 'jabatan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_jabatan','tupoksi_jabatan'];
    protected $returnType = 'array';
}
