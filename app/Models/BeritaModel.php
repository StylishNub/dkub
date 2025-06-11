<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul','isi_berita', 'gambar','publish_date', 'id_kategori_berita', 'id_user'];

    public function getBeritaWithRelasi($keyword = null)
    {
        $builder = $this->select('berita.*, user.name as penulis, kategori_berita.nama as kategori')
                        ->join('user', 'user.id = berita.id_user')
                        ->join('kategori_berita', 'kategori_berita.id = berita.id_kategori_berita');
    
        if ($keyword) {
            $builder->groupStart()
                        ->like('berita.judul', $keyword)
                        ->orLike('berita.isi_berita', $keyword)
                        ->orLike('user.name', $keyword)
                        ->orLike('kategori_berita.nama', $keyword)
                    ->groupEnd();
        }
    
        return $builder->findAll();
    }
    

}
