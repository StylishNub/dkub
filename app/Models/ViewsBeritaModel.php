<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewsBeritaModel extends Model
{
    protected $table = 'views_berita';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_berita', 'view_count'];
}
