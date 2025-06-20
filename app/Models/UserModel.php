<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name','email','password','fakultas_unit','instansi', 'kepentingan','status', 'level', 'keterangan'];
}
