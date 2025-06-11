<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenModel extends Model
{
    protected $table = 'dokumen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_dokumen','file_pdf', 'jenis_dokumen_id', 'id_status'];
    protected $useTimestamps = false;

    protected $returnType = 'array';    

    
}




