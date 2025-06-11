<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    public function save_register($data)
    {
        $this->db->table('user')->insert($data);
    }
    public function login($email, $password)
    {
        // Cek apakah email terdaftar
        $user = $this->db->table('user')->where('email', $email)->get()->getRowArray();
    
        if (!$user) {
            return 'email_not_found'; // Email tidak terdaftar
        }
    
        if ($user['password'] !== $password) { // Belum hash? Langsung bandingkan dulu
            return 'wrong_password'; // Password salah
        }
    
        return $user; // Login sukses
    }
    
}
