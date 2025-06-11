<?php

namespace App\Controllers;

use App\Models\AuthModel;



class Auth extends BaseController
{
    protected $Model_Auth;
    
    public function __construct()
    {
        helper('form');
        $this->Model_Auth = new AuthModel();
    }

    public function register()
    {
        $data = array(
            'title' => 'Register',
        );
        return view('/register', $data);
    }

    public function save_register()
    {
        if ($this->validate([
            'name' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => ['required' => '{field} wajib diisi !']
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} wajib diisi !',
                    'valid_email' => '{field} tidak valid!',
                ]
            ],
            'instansi' => [
                'label' => 'Instansi',
                'rules' => 'required',
                'errors' => ['required' => '{field} wajib diisi !']
            ],
            'kepentingan' => [
                'label' => 'Kepentingan',
                'rules' => 'required',
                'errors' => ['required' => '{field} wajib diisi !']
            ],
        ])) {
            $email = $this->request->getPost('email');
            $instansi = $this->request->getPost('instansi');
    
            // Cek apakah email sudah terdaftar
            if ($this->Model_Auth->db->table('user')->where('email', $email)->get()->getRow()) {
                session()->setFlashdata('warning', 'Email sudah digunakan. Silakan gunakan email lain yang aktif.');
                return redirect()->to(base_url('/register'))->withInput();
            }
            
            if ($this->Model_Auth->db->table('user')->where('instansi', $instansi)->get()->getRow()) {
                session()->setFlashdata('warning', 'Instansi sudah terdaftar. Kalau anak perusahaan atau unit, tuliskan sesuatu yang unik.');
                return redirect()->to(base_url('/register'))->withInput();
            }
            
            // Lolos validasi dan data unik
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $email,
                'instansi' => $instansi,
                'kepentingan' => $this->request->getPost('kepentingan'),
                'status' => 'pending',
                'level' => 'user',
            ];
    
            $this->Model_Auth->save_register($data);
            session()->setFlashdata('pesan', 'Berhasil daftar, mohon tunggu persetujuan admin.');
            return redirect()->to(base_url('/register'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/register'))->withInput();
        }
    }
    
    

    public function login()
    {
        $data = array(
            'title' => 'Login',
        );
        return view('login', $data);
    }

    public function cek_login()
    {
        if ($this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => ['required' => '{field} wajib diisi!']
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => ['required' => '{field} wajib diisi!']
            ],
        ])) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $cek = $this->Model_Auth->login($email, $password);
    
            if ($cek === 'email_not_found') {
                session()->setFlashdata('error', 'Email tidak terdaftar!');
            } elseif ($cek === 'wrong_password') {
                session()->setFlashdata('error', 'Password salah!');
            } elseif (is_array($cek)) {
                if ($cek['level'] === 'admin') {
                    session()->set($this->getSessionData($cek));
                    return redirect()->to(base_url('dashboard'));
                } elseif ($cek['level'] === 'user') {
                    if ($cek['status'] === 'approved') {
                        session()->set($this->getSessionData($cek));
                        return redirect()->to(base_url('user_home'));
                    } else {
                        session()->setFlashdata('error', 'Akun Anda belum disetujui oleh admin.');
                    }
                }
            } else {
                session()->setFlashdata('error', 'Email atau password salah!');
            }
    
            return redirect()->to(base_url('/login'))->withInput();
        } else {
            session()->setFlashdata('errorslogin', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/login'))->withInput();
        }
    }
    
    private function getSessionData($user)
    {
        return [
            'isLoggedIn' => true,
            'id'         => $user['id'],
            'name'       => $user['name'],
            'email'      => $user['email'],
            'level'      => $user['level'],
            'status'     => $user['status'],
        ];
    }
    
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/login'));
    }
}
