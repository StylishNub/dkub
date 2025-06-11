<?php

namespace App\Models;

use CodeIgniter\Model;

class SdmModel extends Model
{
    protected $table = 'sdm';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama','nip_nik','jabatan', 'pendidikan', 'pengalaman_manajerial','gambar','id_jabatan'];
}
