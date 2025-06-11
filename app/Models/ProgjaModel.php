<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgjaModel extends Model
{
    protected $table = 'progja';
    protected $primaryKey = 'id';
    protected $allowedFields = ['program_kerja','deskripsi_program','status'];
}
