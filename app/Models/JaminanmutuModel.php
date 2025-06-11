<?php

namespace App\Models;

use CodeIgniter\Model;

class JaminanmutuModel extends Model
{
    protected $table = 'jaminan_mutu';
    protected $primaryKey = 'id';
    protected $allowedFields = ['indikator','nilai'];
}
