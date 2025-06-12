<?php

namespace App\Controllers;

use App\Controllers\BaseAdminController;
use App\Models\HeroContentModel;
use App\Models\KerjasamaModel;
use App\Models\GambarModel;
use App\Models\SdmModel;
use App\Models\JabatanModel;
use App\Models\ProfilModel;
use App\Models\ProgjaModel;
use App\Models\StatistikMouModel;
use App\Models\JaminanmutuModel;
use App\Models\BeritaModel;
use App\Models\KategoriBeritaModel;
use App\Models\PengaduanModel;
use App\Models\PengajuanModel;
use App\Models\DokumenModel;
use App\Models\StatusModel;
use App\Models\JenisDokumenModel;
use App\Models\UserModel;

class Admin extends BaseAdminController
{
    protected $heroModel, $kerjasamaModel, $gambarModel, $sdmModel, $jabatanModel;
    protected $profilModel, $progjaModel, $statistikmouModel, $jaminanmutuModel;
    protected $beritaModel, $kategoriberitaModel, $pengaduanModel, $pengajuanModel;
    protected $dokumenModel, $statusModel, $jenisdokumenModel, $UserModel;

    public function __construct()
    {    parent::__construct(); // ⬅️ WAJIB ini biar BaseAdminController jalan

        $this->heroModel = new HeroContentModel();
        $this->kerjasamaModel = new KerjasamaModel();
        $this->gambarModel = new GambarModel();
        $this->sdmModel = new SdmModel();
        $this->jabatanModel = new JabatanModel();
        $this->profilModel = new ProfilModel();
        $this->progjaModel = new ProgjaModel();
        $this->statistikmouModel = new StatistikMouModel();
        $this->jaminanmutuModel = new JaminanmutuModel();
        $this->beritaModel = new BeritaModel();
        $this->kategoriberitaModel = new KategoriBeritaModel();
        $this->pengaduanModel = new PengaduanModel();
        $this->pengajuanModel = new PengajuanModel();
        $this->dokumenModel = new DokumenModel();
        $this->statusModel = new StatusModel();
        $this->jenisdokumenModel = new JenisDokumenModel();
        $this->UserModel = new UserModel();
    }
    public function index(): string
    {
        $userPending = $this->UserModel->where('status', 'pending')->findAll();
        $pengajuanBelumDisetujui = $this->pengajuanModel
            ->where('status_surat !=', 'Disetujui')
            ->groupStart()
            ->where('status_dokumen !=', 'Selesai')
            ->where('status_dokumen !=', 'Ditolak')
             ->groupEnd()
            ->findAll();
    
        $data = [
            'title' => 'Dashboard',
            'menu' => 'dashboard',
            'user' => $userPending,
            'pengajuan' => $pengajuanBelumDisetujui
        ];
    
        return view('admin/dashboard', $data);
    }

    public function kelola_user()
    {
        $keyword = $this->request->getGet('keyword');
    
        if ($keyword) {
            $user = $this->UserModel
                ->like('name', $keyword)
                ->orLike('email', $keyword)
                ->orLike('instansi', $keyword)
                ->orLike('kepentingan', $keyword)
                ->paginate(10, 'user');
        } else {
            $user = $this->UserModel->paginate(10, 'user');
        }
    
        $data = [
            'title' => 'Kelola User',
            'menu' => 'kelola_user',
            'user' => $user,
            'pager' => $this->UserModel->pager,
            'search' => $keyword,
        ];
    
        return view('admin/user/user', $data);
    }
    public function tambah_user()
    {
        $userModel = $this->UserModel->findAll();
        $data = [
            'title' => 'Tambah User',
            'menu' => 'kelola_user',
            'user' => $userModel,
            'validation' => \config\Services::validation()

        ];
        return view('admin/user/addUser', $data);
    }
    public function save_user()
    {
        if ($this->validate([
            'name' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => ['required' => '{field} wajib diisi!']
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'valid_email' => '{field} tidak valid!'
                ]
            ],
            'fakultas_unit' => [
                'label' => 'Fakultas / Unit',
                'rules' => 'required',
                'errors' => ['required' => '{field} wajib diisi!']
            ]
        ])) {
            $email = $this->request->getPost('email');
    
            // Cek duplikat email
            if ($this->UserModel->where('email', $email)->first()) {
                session()->setFlashdata('warning', 'Email sudah digunakan.');
                return redirect()->back()->withInput();
            }
    
            // Generate random password (8 karakter acak)
            $plainPassword = bin2hex(random_bytes(4));
    
            // Simpan user ke database
            $this->UserModel->save([
                'name' => $this->request->getPost('name'),
                'email' => $email,
                'instansi' => 'Universitas Brawijaya',
                'kepentingan' => 'Sebagai Operator',
                'fakultas_unit' => $this->request->getPost('fakultas_unit'),
                'status' => 'approved', // 
                'level' => 'user',
                'keterangan' => 'fakultas dan unit kerja',
                'password' => $plainPassword
            ]);
    
            // Kirim email notifikasi akun
            $emailService = \Config\Services::email();
            $config = new \Config\Email();
            $emailService->initialize($config);
    
            $emailService->setFrom($config->fromEmail, $config->fromName);
            $emailService->setTo($email);
            $emailService->setSubject('Akun Anda Telah Ditambahkan oleh Admin');
    
            $message = "
                <p>Halo <strong>{$this->request->getPost('name')}</strong>,</p>
                <p>Akun Anda telah <strong style='color:green;'>disetujui</strong> oleh Admin.</p>
                <p>Berikut informasi login Anda:</p>
                <ul>
                    <li><strong>Email:</strong> {$email}</li>
                    <li><strong>Password:</strong> {$plainPassword}</li>
                </ul>
                <p>Silakan login dan segera ubah password Anda setelah masuk.</p>
                <br><p>Terima kasih.</p>
            ";
    
            $emailService->setMessage($message);
    
            if (!$emailService->send()) {
                log_message('error', 'Gagal kirim email ke user baru: ' . print_r($emailService->printDebugger(['headers']), true));
                session()->setFlashdata('error', 'User ditambahkan, tapi email gagal dikirim.');
            } else {
                session()->setFlashdata('success', 'User berhasil ditambahkan dan email dikirim.');
            }
    
            return redirect()->to('/kelola_user');
    
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }
    }    

    public function approve_user($id)
    {
        $user = $this->UserModel->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }
    
        // Generate password random
        $plainPassword = bin2hex(random_bytes(4)); // contoh: 8 karakter acak
    
        // Update status dan password ke DB tanpa hashing
        $this->UserModel->update($id, [
            'password' => $plainPassword,  // Simpan password dalam bentuk plain text
            'status' => 'approved'
        ]);
    
        // Konfigurasi email
        $email = \Config\Services::email();
        $config = new \Config\Email();
        $email->initialize($config);
    
        // Atur pengirim, penerima, dan isi pesan
        $email->setFrom($config->fromEmail, $config->fromName);
        $email->setTo($user['email']);
        $email->setSubject('Akun Untuk Login User');
        $email->setMessage("
            <h3>Halo, {$user['name']}</h3>
            <p>Akun Anda telah disetujui. Berikut adalah detail login Anda:</p>
            <ul>
                <li><strong>Email:</strong> {$user['email']}</li>
                <li><strong>Password:</strong> {$plainPassword}</li>
            </ul>
            <p>Silakan login dan segera ubah password Anda setelah masuk.</p>
        ");
    
        // Kirim email
        if ($email->send()) {
            session()->setFlashdata('pesan', 'User berhasil disetujui dan email dikirim.');
        } else {
            session()->setFlashdata('error', 'User disetujui, tapi email gagal dikirim.');
        }
    
        return redirect()->to(base_url('/kelola_user'));
    }
    
    
    public function reject_user($id)
    {
        $user = $this->UserModel->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }
    
        // Update status user
        $this->UserModel->update($id, ['status' => 'rejected']);
    
        // Konfigurasi email
        $email = \Config\Services::email();
        $config = new \Config\Email();
        $email->initialize($config);
    
        $email->setFrom($config->fromEmail, $config->fromName);
        $email->setTo($user['email']);
        $email->setSubject('Akun Untuk Login User');
        $email->setMessage("
            <h3>Halo, {$user['name']}</h3>
            <p>Mohon maaf, pendaftaran akun Anda telah <strong>ditolak</strong> oleh admin.</p>
            <p>Jika Anda merasa ini adalah kesalahan, silakan hubungi kami kembali.</p>
        ");
    
        if ($email->send()) {
            session()->setFlashdata('pesan', 'User ditolak dan email pemberitahuan dikirim.');
        } else {
            session()->setFlashdata('error', 'User ditolak, tapi email gagal dikirim.');
        }
    
        return redirect()->to(base_url('/kelola_user'));
    }    

    public function hero_content()
    {
        $keyword = $this->request->getGet('keyword');
    
        if ($keyword) {
            $heroModel = $this->heroModel
                ->like('hero_title', $keyword)
                ->orLike('hero_description', $keyword)
                ->paginate(10, 'hero');
        } else {
            $heroModel = $this->heroModel->paginate(10, 'hero');
        }
    
        $data = [
            'title'         => 'Kelola Hero Section',
            'menu'          => 'hero_content',
            'hero_content'  => $heroModel,
            'pager'         => $this->heroModel->pager,
            'keyword'       => $keyword,
            'currentPage'   => $this->heroModel->pager->getCurrentPage('hero'),
            'totalPages'    => $this->heroModel->pager->getPageCount('hero'),
        ];
    
        return view('admin/hero/heroContent', $data);
    }
    

    public function tambah_hero()
    {
        $data = [
            'title' => 'Tambah Hero Content',
            'menu' => 'hero_content',
            'validation' => \config\Services::validation()

        ];
        return view('admin/hero/addHeroContent', $data);
    }

    public function save_hero()
    {
        if (!$this->validate([
            'hero_image' => [
                'rules' => 'uploaded[hero_image]|max_size[hero_image,2048]|is_image[hero_image]|mime_in[hero_image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                ]
            ],
            'hero_title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul Hero wajib diisi !'
                ]
            ],
            'hero_description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Hero wajib diisi !'
                ]
            ],
        ])) {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('/admin/hero_content/tambah'); // Redirect to the add hero page
        } else {
            // Jika validasi berhasil
            $fileGambar = $this->request->getFile('hero_image');
            
            // Generate a random name for the uploaded image
            $namaGambar = $fileGambar->getRandomName();
            
            // Move the image to the 'uploads/banner/' directory
            $fileGambar->move('uploads/banner', $namaGambar);

            // Insert the data into the database
            $this->heroModel->save([
                'hero_title' => $this->request->getVar('hero_title'),
                'hero_description' => $this->request->getVar('hero_description'),
                'hero_image' => $namaGambar,  // Store the image name in the database
            ]);

            // Redirect to the hero section page
            return redirect()->to('/hero_content');
        }
    }


    public function edit_hero($id = false)
    {
        $heroModel = $this->heroModel->where(['id' => $id])->first();
        $data = [
            'title' => 'Edit Hero Content',
            'menu' => 'hero_content',
            'hero' => $heroModel
        ];
        return view('admin/hero/editHeroContent', $data);
    }

    public function save_editHero()
    {
        $heroModel = new HeroContentModel();
        $id = $this->request->getPost('id'); // Sesuai input form: name="id"
        if (!$id) {
            return redirect()->back()->with('error', 'ID tidak ditemukan.');
        }
    
        $gambarLama = $this->request->getVar('gambarLama');
        $fileGambar = $this->request->getFile('hero_image');
    
        $namaGambar = $gambarLama; // Default: pakai gambar lama
    
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            // Upload gambar baru
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('uploads/banner', $namaGambar);
    
            // Hapus gambar lama jika ada
            $pathGambarLama = FCPATH . 'uploads/banner/' . $gambarLama;
            if (file_exists($pathGambarLama) && is_file($pathGambarLama)) {
                unlink($pathGambarLama);
            }
        }
    
        // Siapkan data untuk update
        $dataToUpdate = [
            'hero_title' => $this->request->getPost('hero_title'),
            'hero_description' => $this->request->getPost('hero_description'),
            'hero_image' => $namaGambar,
        ];
    
        // Jalankan update
        $heroModel->update($id, $dataToUpdate);
    
        return redirect()->to('/hero_content')->with('success', 'Data hero berhasil diperbarui.');
    }
       
    public function kelola_kerjasama()
    {
        $keyword = $this->request->getGet('keyword');
    
        $kerjasamaQuery = $this->kerjasamaModel
            ->select('mou.*, status.status')
            ->join('status', 'mou.id_status = status.id');
    
        if ($keyword) {
            $kerjasamaQuery = $kerjasamaQuery
                ->groupStart()
                    ->like('mou.nama_mitra', $keyword)
                    ->orLike('mou.tahun', $keyword)
                    ->orLike('mou.jangka_waktu', $keyword)
                    ->orLike('status.status', $keyword)
                ->groupEnd();
        }
    
        $data = [
            'title'        => 'Kelola Kerjasama',
            'menu'         => 'kelola_kerjasama',
            'kerjasama'    => $kerjasamaQuery->paginate(10, 'kerjasama'),
            'pager'        => $this->kerjasamaModel->pager,
            'keyword'      => $keyword,
            'currentPage'  => $this->kerjasamaModel->pager->getCurrentPage('kerjasama'),
            'totalPages'   => $this->kerjasamaModel->pager->getPageCount('kerjasama'),
        ];
    
        return view('admin/mou/KelolaKerjasama', $data);
    }
     

        public function tambah_mou()
    {
        $statusModel = $this->statusModel->findAll();
        $data = [
            'title' => 'Tambah MOU',
            'menu' => 'tambah_mou',
            'status' => $statusModel,
            'validation' => \config\Services::validation()

        ];
        return view('admin/mou/addKerjasama', $data);
    }

    public function save_mou()
    {
        if (!$this->validate([
            'nama_mitra' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama mitra wajib diisi !'
                ]
            ],
            'tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun wajib diisi !'
                ]
            ],
            'jangka_waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jangka waktu wajib diisi !'
                ]
            ],
            'tanggal_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal mulai wajib diisi !'
                ]
            ],
            'tanggal_berakhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal berakhir wajib diisi !'
                ]
            ],
            'file_pdf' => [
                'rules' => 'uploaded[file_pdf]|max_size[file_pdf,2048]|mime_in[file_pdf,application/pdf]',
                'errors' => [
                    'uploaded' => 'File PDF wajib diupload!',
                    'max_size' => 'Ukuran file PDF terlalu besar! Maksimal 2MB.',
                    'mime_in' => 'File yang diupload harus berupa PDF.',
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status wajib diisi !'
                ]
            ],
        ])) {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('/kelola_kerjasama/tambah_mou')->withInput();
        } else {
            // Jika validasi berhasil
            // Proses upload file PDF
            $filePDF = $this->request->getFile('file_pdf');
            $namaPDF = $filePDF->getRandomName();
            $filePDF->move('uploads/pdf', $namaPDF);
    
            // Siapkan data untuk disimpan
            $data = [
                'nama_mitra' => $this->request->getVar('nama_mitra'),
                'tahun' => $this->request->getVar('tahun'),
                'jangka_waktu' => $this->request->getVar('jangka_waktu'),
                'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
                'tanggal_berakhir' => $this->request->getVar('tanggal_berakhir'),
                'file_pdf' => $namaPDF, // Menyimpan nama file PDF
                'status' => $this->request->getVar('status'), // Menyimpan status
                'id_status' => $this->request->getVar('status') // Menyimpan id_status jika diperlukan
            ];
    
            // Simpan data kerjasama ke database
            if ($this->kerjasamaModel->save($data)) {

                // Redirect ke halaman kerjasama
                return redirect()->to('/kelola_kerjasama')->with('success', 'Kerjasama berhasil ditambahkan.');
            } else {
                // Jika gagal menyimpan
                return redirect()->to('/kelola_kerjasama/tambah_mou')->with('error', 'Gagal menambahkan kerjasama.');
            }
        }
    }

    public function edit_kerjasama($id=false)
    {
        $kerjasamaModel = $this->kerjasamaModel->select('mou.*, status.status')
        ->join('status', 'mou.id_status = status.id') 
        ->where('mou.id', $id) 
        ->first();

        $statusModel = $this->statusModel->findAll();
        $data = [
            'title' => 'Edit Kerjasama',
            'menu' => 'kelola_kerjasama',
            'mou' => $kerjasamaModel,
            'status' => $statusModel

        ];
        return view('admin/mou/editKerjasama', $data);
    }
        public function save_editMou()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            return redirect()->back()->with('error', 'ID kerjasama tidak ditemukan.');
        }

        // Validasi input
        if (!$this->validate([
            'nama_mitra' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama mitra wajib diisi !'
                ]
            ],
            'tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun wajib diisi !'
                ]
            ],
            'jangka_waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jangka waktu wajib diisi !'
                ]
            ],
            'tanggal_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal mulai wajib diisi !'
                ]
            ],
            'tanggal_berakhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal berakhir wajib diisi !'
                ]
            ],
            'file_pdf' => [
                'rules' => 'max_size[file_pdf,2048]|mime_in[file_pdf,application/pdf]',
                'errors' => [
                    'max_size' => 'Ukuran file PDF terlalu besar! Maksimal 2MB.',
                    'mime_in' => 'File yang diupload harus berupa PDF.',
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status wajib diisi !'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        // Proses file PDF
        $filePDF = $this->request->getFile('file_pdf');
        $fileLama = $this->request->getPost('fileLama');
        $namaPDF = $fileLama;

        if ($filePDF && $filePDF->isValid() && !$filePDF->hasMoved()) {
            $namaPDF = $filePDF->getRandomName();
            $filePDF->move('uploads/pdf', $namaPDF);

            // Hapus file lama jika ada
            $pathPDFLama = FCPATH . 'uploads/pdf/' . $fileLama;
            if (file_exists($pathPDFLama) && is_file($pathPDFLama)) {
                unlink($pathPDFLama);
            }
        }

        // Data update
        $data = [
            'nama_mitra' => $this->request->getVar('nama_mitra'),
            'tahun' => $this->request->getVar('tahun'),
            'jangka_waktu' => $this->request->getVar('jangka_waktu'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_berakhir' => $this->request->getVar('tanggal_berakhir'),
            'file_pdf' => $namaPDF,
            'status' => $this->request->getVar('status'),
            'id_status' => $this->request->getVar('status'),
        ];

        if ($this->kerjasamaModel->update($id, $data)) {
            return redirect()->to('/kelola_kerjasama')->with('success', 'Data kerjasama berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data.');
        }
    }   

    // kELOLA GAMBAR
    public function kelola_gambar()
    {
        $keyword = $this->request->getGet('keyword');
    
        $gambarModel = $this->gambarModel->select('gambar.*, status.status')
            ->join('status', 'gambar.id_status = status.id');
    
        if ($keyword) {
            $gambarModel = $gambarModel
                ->groupStart()
                    ->like('gambar.nama', $keyword)
                    ->orLike('status.status', $keyword)
                    ->orLike('kategori', $keyword)
                ->groupEnd();
        }
    
        $data = [
            'title'        => 'Kelola Gambar',
            'menu'         => 'kelola_gambar',
            'gambar'       => $gambarModel->paginate(10, 'gambar'),
            'pager'        => $this->gambarModel->pager,
            'keyword'      => $keyword,
            'currentPage'  => $this->gambarModel->pager->getCurrentPage('gambar'),
            'totalPages'   => $this->gambarModel->pager->getPageCount('gambar'),
        ];
    
        return view('admin/gambar/kelolaGambar', $data);
    }    

        public function tambah_gambar()
    {
        $statusModel = $this->statusModel->findAll();
        $data = [
            'title' => 'Tambah Gambar',
            'menu' => 'kelola_gambar',
            'validation' => \config\Services::validation(),
            'status' => $statusModel

        ];
        return view('admin/gambar/addGambar', $data);
    }

     public function save_gambar()
    {
        // Validasi input
        if (!$this->validate([
            'gambar' => [
                'rules' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Gambar wajib diisi!'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori Gambar wajib diisi!'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Gambar wajib diisi!'
                ]
            ],
        ])) {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('/admin/tambah_gambar'); // Redirect to the add image page
        } else {
            // Jika validasi berhasil
            $fileGambar = $this->request->getFile('gambar');
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('uploads/gambar', $namaGambar);

            // Insert data gambar ke dalam database
            $this->gambarModel->save([
                'nama' => $this->request->getVar('nama'),
                'kategori' => $this->request->getVar('kategori'),
                'status' => $this->request->getVar('status'), // Status gambar
                'id_status' => $this->request->getVar('status'), // ID status
                'gambar' => $namaGambar,
            ]);

            // Redirect ke halaman daftar gambar
            return redirect()->to('/kelola_gambar');
        }
    }

    public function edit_gambar($id = false)
    {
        $gambarModel = $this->gambarModel
        ->select('gambar.*, status.status')
        ->join('status', 'gambar.id_status = status.id')
        ->where('gambar.id', $id)
        ->first();

        $statusModel = $this->statusModel->findAll();

        $data = [
            'title' => 'Edit Gambar',
            'menu' => 'kelola_gambar',
            'gambar' => $gambarModel,
            'status' => $statusModel
        ];
        return view('admin/gambar/editGambar', $data);
    }

    public function save_editGambar()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            return redirect()->back()->with('error', 'ID tidak ditemukan.');
        }
    
        // Validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Gambar wajib diisi!'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori Gambar wajib diisi!'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Gambar wajib diisi!'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                ]
            ],
        ])) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }
    
        // Ambil gambar lama dan file baru
        $gambarLama = $this->request->getVar('gambarLama');
        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $gambarLama;
    
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('uploads/gambar', $namaGambar);
    
            // Hapus gambar lama jika ada
            $pathGambarLama = FCPATH . 'uploads/gambar/' . $gambarLama;
            if (file_exists($pathGambarLama) && is_file($pathGambarLama)) {
                unlink($pathGambarLama);
            }
        }
    
        // Update ke database
        $this->gambarModel->update($id, [
            'nama' => $this->request->getVar('nama'),
            'kategori' => $this->request->getVar('kategori'),
            'status' => $this->request->getVar('status'),
            'id_status' => $this->request->getVar('status'),
            'gambar' => $namaGambar,
        ]);
    
        return redirect()->to('/kelola_gambar')->with('success', 'Data gambar berhasil diperbarui.');
    }
    

    // Kelola SDM
    public function kelola_sdm()
    {
        $keyword = $this->request->getGet('keyword');
    
        $jabatanModel = $this->jabatanModel->findAll();
    
        $sdmQuery = $this->sdmModel
            ->select('sdm.*, jabatan.nama_jabatan')
            ->join('jabatan', 'sdm.id_jabatan = jabatan.id', 'left');
    
        if ($keyword) {
            $sdmQuery = $sdmQuery
                ->groupStart()
                    ->like('sdm.nama', $keyword)
                    ->orLike('sdm.nip_nik', $keyword)
                    ->orLike('sdm.pendidikan', $keyword)
                    ->orLike('sdm.pengalaman_manajerial', $keyword)
                    ->orLike('jabatan.nama_jabatan', $keyword)
                ->groupEnd();
        }
    
        $data = [
            'title'        => 'Kelola SDM',
            'menu'         => 'kelola_sdm',
            'sdm'          => $sdmQuery->paginate(5, 'sdm'),
            'pager'        => $this->sdmModel->pager,
            'jabatan'      => $jabatanModel,
            'keyword'      => $keyword,
            'currentPage'  => $this->sdmModel->pager->getCurrentPage('sdm'),
            'totalPages'   => $this->sdmModel->pager->getPageCount('sdm'),
        ];
    
        return view('admin/sdm/kelolaSDM', $data);
    }
    

    public function tambah_sdm()
    {
        $jabatanModel = $this->jabatanModel->findAll();
        $data = [
            'title' => 'Tambah SDM',
            'menu' => 'kelola_sdm',
            'jabatan' => $jabatanModel,
            'validation' => \config\Services::validation()

        ];
        return view('admin/sdm/addSDM', $data);
    }

    public function save_sdm()
    {
        // Validasi input form SDM
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama SDM wajib diisi!',
                    'min_length' => 'Nama SDM minimal 3 karakter!'
                ]
            ],
            'nip_nik' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'NIP/NIK wajib diisi!',
                    'min_length' => 'NIP/NIK minimal 10 karakter!'
                ]
            ],
            'pendidikan' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Pendidikan wajib diisi!',
                    'min_length' => 'Pendidikan minimal 3 karakter!'
                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jabatan wajib dipilih!'
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|max_size[gambar,1024]|is_image[gambar]',
                'errors' => [
                    'uploaded' => 'gambar wajib diupload!',
                    'max_size' => 'Ukuran gambar terlalu besar! Maksimal 1MB.',
                    'is_image' => 'File yang diupload harus berupa gambar!'
                ]
            ]
        ])) {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('/kelola_sdm/tambah_sdm')->withInput();
        } else {
            // Jika validasi berhasil
            $fileGambar = $this->request->getFile('gambar');
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('uploads/gambar', $namaGambar);

            // Siapkan data untuk disimpan
            $data = [
                'nama' => $this->request->getVar('nama'),
                'nip_nik' => $this->request->getVar('nip_nik'),
                'pendidikan' => $this->request->getVar('pendidikan'),
                'pengalaman_manajerial' => $this->request->getVar('pengalaman_manajerial'),
                'id_jabatan' => $this->request->getVar('jabatan'),
                'gambar' => $namaGambar
            ];

            // Simpan data SDM ke database
            $sdmModel = new SdmModel();
            $sdmModel->save($data);

            // Redirect ke halaman kelola SDM
            return redirect()->to('/kelola_sdm')->with('success', 'Data SDM berhasil ditambahkan.');
        }
    }

    public function edit_sdm($id)
    {
        $jabatanModel = $this->jabatanModel->findAll();
    
        $sdmData = $this->sdmModel->select('sdm.*, jabatan.nama_jabatan')
            ->join('jabatan', 'sdm.id_jabatan = jabatan.id')
            ->where('sdm.id', $id)
            ->first();
    
        $data = [
            'title' => 'Kelola SDM',
            'menu' => 'kelola_sdm',
            'sdm' => $sdmData,
            'jabatan' => $jabatanModel
        ];
        
        return view('admin/sdm/editSdm', $data); // pastikan view-nya bukan kelolaSDM
    }

    public function save_editSdm()
{
    $id = $this->request->getPost('id');
    if (!$id) {
        return redirect()->back()->with('error', 'ID SDM tidak ditemukan.');
    }

    // Validasi input form SDM
    if (!$this->validate([
        'nama' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Nama SDM wajib diisi!',
                'min_length' => 'Nama SDM minimal 3 karakter!'
            ]
        ],
        'nip_nik' => [
            'rules' => 'required|min_length[10]',
            'errors' => [
                'required' => 'NIP/NIK wajib diisi!',
                'min_length' => 'NIP/NIK minimal 10 karakter!'
            ]
        ],
        'pendidikan' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Pendidikan wajib diisi!',
                'min_length' => 'Pendidikan minimal 3 karakter!'
            ]
        ],
        'pengalaman_manajerial' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Pengalaman Manajerial wajib diisi!',
                'min_length' => 'Pengalaman Manajerial minimal 3 karakter!'
            ]
        ],
        'jabatan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jabatan wajib dipilih!'
            ]
        ],
        'gambar' => [
            'rules' => 'max_size[gambar,1024]|is_image[gambar]',
            'errors' => [
                'max_size' => 'Ukuran gambar terlalu besar! Maksimal 1MB.',
                'is_image' => 'File yang diupload harus berupa gambar!'
            ]
        ]
    ])) {
        session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        return redirect()->back()->withInput();
    }

    $gambarLama = $this->request->getVar('gambarLama');
    $fileGambar = $this->request->getFile('gambar');
    $namaGambar = $gambarLama;

    if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('uploads/gambar', $namaGambar);

        // Hapus gambar lama
        $pathGambarLama = FCPATH . 'uploads/gambar/' . $gambarLama;
        if (file_exists($pathGambarLama) && is_file($pathGambarLama)) {
            unlink($pathGambarLama);
        }
    }

    // Siapkan data yang akan diupdate
    $data = [
        'nama' => $this->request->getVar('nama'),
        'nip_nik' => $this->request->getVar('nip_nik'),
        'pendidikan' => $this->request->getVar('pendidikan'),
        'pengalaman_manajerial' => $this->request->getVar('pengalaman_manajerial'),
        'id_jabatan' => $this->request->getVar('jabatan'),
        'gambar' => $namaGambar
    ];

    $sdmModel = new SdmModel();
    $sdmModel->update($id, $data);

    return redirect()->to('/kelola_sdm')->with('success', 'Data SDM berhasil diperbarui.');
}


    // Kelola Jabatan
    public function kelola_jabatan()
    {
        $keyword = $this->request->getGet('keyword');
    
        $jabatanQuery = $this->jabatanModel;
    
        if ($keyword) {
            $jabatanQuery = $jabatanQuery
                ->groupStart()
                    ->like('nama_jabatan', $keyword)
                    ->orLike('tupoksi_jabatan', $keyword)
                ->groupEnd();
        }
    
        $data = [
            'title'        => 'Kelola Jabatan',
            'menu'         => 'kelola_jabatan',
            'jabatan'      => $jabatanQuery->paginate(5, 'jabatan'),
            'pager'        => $this->jabatanModel->pager,
            'keyword'      => $keyword,
            'currentPage'  => $this->jabatanModel->pager->getCurrentPage('jabatan'),
            'totalPages'   => $this->jabatanModel->pager->getPageCount('jabatan'),
        ];
    
        return view('admin/sdm/kelolaJabatan', $data);
    }
    

    public function tambah_jabatan()
    {
        $data = [
            'title' => 'Tambah Jabatan',
            'menu' => 'Tambah Jabatan',
            'validation' => \config\Services::validation()

        ];
        return view('admin/sdm/addJabatan', $data);
    }

    public function save_jabatan()
    {
        if (!$this->validate([
            'nama_jabatan' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama Jabatan wajib diisi!',
                    'min_length' => 'Nama Jabatan minimal 3 karakter!'
                ]
            ],
            'tupoksi_jabatan' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Tupoksi Jabatan wajib diisi!',
                    'min_length' => 'Tupoksi Jabatan minimal 5 karakter!'
                ]
            ]
        ])) {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('/admin/kelola_jabatan/tambah');
        } else {
            // Jika validasi berhasil
            $this->jabatanModel->save([
                'nama_jabatan' => $this->request->getVar('nama_jabatan'),
                'tupoksi_jabatan' => $this->request->getVar('tupoksi_jabatan'),
            ]);

            // Redirect ke halaman kelola jabatan
            return redirect()->to('/kelola_jabatan');
        }
    }

    public function edit_jabatan($id = false)
    {
        $jabatanModel = $this->jabatanModel->where(['id' => $id])->first();
        $data = [
            'title' => 'Edit Jabatan',
            'menu' => 'kelola_jabatan',
            'jabatan' => $jabatanModel
        ];
        return view('admin/sdm/editJabatan', $data);
    }

    public function save_editJabatan()
{
    $id = $this->request->getPost('id');
    if (!$id) {
        return redirect()->back()->with('error', 'ID SDM tidak ditemukan.');
    }

    if (!$this->validate([
        'nama_jabatan' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Nama Jabatan wajib diisi!',
                'min_length' => 'Nama Jabatan minimal 3 karakter!'
            ]
        ],
        'tupoksi_jabatan' => [
            'rules' => 'required|min_length[5]',
            'errors' => [
                'required' => 'Tupoksi Jabatan wajib diisi!',
                'min_length' => 'Tupoksi Jabatan minimal 5 karakter!'
            ]
        ]
    ])) {
        // Jika validasi gagal
        session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        return redirect()->to('/kelola_jabatan/edit_jabatan/' . $id)->withInput();
    }

    // Jika validasi berhasil
    $this->jabatanModel->update($id, [
        'nama_jabatan' => $this->request->getVar('nama_jabatan'),
        'tupoksi_jabatan' => $this->request->getVar('tupoksi_jabatan'),
    ]);

    // Redirect ke halaman kelola jabatan
    return redirect()->to('/kelola_jabatan')->with('success', 'Jabatan berhasil diperbarui!');
}

    // Kelola Profil
    public function kelola_profil()
    {
        $keyword = $this->request->getGet('keyword');
    
        $profilQuery = $this->profilModel;
    
        if ($keyword) {
            $profilQuery = $profilQuery
                ->groupStart()
                    ->like('sejarah', $keyword)
                    ->orLike('visi', $keyword)
                    ->orLike('misi', $keyword)
                    ->orLike('tujuan', $keyword)
                ->groupEnd();
        }
    
        $data = [
            'title' => 'Kelola Profil',
            'menu' => 'kelola_profil',
            'profil' => $profilQuery->findAll(),
            'keyword' => $keyword
        ];
    
        return view('admin/profil/kelolaProfil', $data);
    }
    

    public function tambah_profil()
    {
        $data = [
            'title' => 'Tambah Profil',
            'menu' => 'Tambah Profil',
            'validation' => \config\Services::validation()

        ];
        return view('admin/profil/addProfil', $data);
    }

    public function save_profil()
    {
        if (!$this->validate([
            'sejarah' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Sejarah wajib diisi!',
                    'min_length' => 'Sejarah minimal 5 karakter!'
                ]
            ],
            'visi' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Visi wajib diisi!',
                    'min_length' => 'Visi minimal 5 karakter!'
                ]
            ],
            'misi' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Misi wajib diisi!',
                    'min_length' => 'Misi minimal 5 karakter!'
                ]
            ],
            'tujuan' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Tujuan wajib diisi!',
                    'min_length' => 'Tujuan minimal 5 karakter!'
                ]
            ],
        ])) {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('/admin/kelola_profil/tambah_profil');
        } else {
            // Jika validasi berhasil
            $this->profilModel->save([
                'sejarah' => $this->request->getVar('sejarah'),
                'visi' => $this->request->getVar('visi'),
                'misi' => $this->request->getVar('misi'),
                'tujuan' => $this->request->getVar('tujuan'),
            ]);

            // Redirect ke halaman kelola profil
            return redirect()->to('/kelola_profil');
        }
    }

    public function edit_profil($id = false)
    {
        $profilModel = $this->profilModel->where(['id' => $id])->first();
        $data = [
            'title' => 'Edit Profil',
            'menu' => 'kelola_profil',
            'profil' => $profilModel
        ];
        return view('admin/profil/editProfil', $data);
    }

    public function save_editProfil()
    {
    $id = $this->request->getPost('id');
    if (!$id) {
        return redirect()->back()->with('error', 'ID SDM tidak ditemukan.');
    }
    if (!$this->validate([
        'sejarah' => [
            'rules' => 'required|min_length[5]',
            'errors' => [
                'required' => 'Sejarah wajib diisi!',
                'min_length' => 'Sejarah minimal 5 karakter!'
            ]
        ],
        'visi' => [
            'rules' => 'required|min_length[5]',
            'errors' => [
                'required' => 'Visi wajib diisi!',
                'min_length' => 'Visi minimal 5 karakter!'
            ]
        ],
        'misi' => [
            'rules' => 'required|min_length[5]',
            'errors' => [
                'required' => 'Misi wajib diisi!',
                'min_length' => 'Misi minimal 5 karakter!'
            ]
        ],
        'tujuan' => [
            'rules' => 'required|min_length[5]',
            'errors' => [
                'required' => 'Tujuan wajib diisi!',
                'min_length' => 'Tujuan minimal 5 karakter!'
            ]
        ],
    ])) {
        // Jika validasi gagal
        session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        return redirect()->to('/admin/kelola_profil/edit/' . $id)->withInput();
    }

    // Jika validasi berhasil
    $this->profilModel->update($id, [
        'sejarah' => $this->request->getVar('sejarah'),
        'visi'    => $this->request->getVar('visi'),
        'misi'    => $this->request->getVar('misi'),
        'tujuan'  => $this->request->getVar('tujuan'),
    ]);

    // Redirect ke halaman kelola profil
    return redirect()->to('/kelola_profil')->with('success', 'Profil berhasil diperbarui!');
}


    // Kelola Program Kerja
    public function kelola_progja()
    {
        $keyword = $this->request->getGet('keyword');
    
        $progjaQuery = $this->progjaModel;
    
        if ($keyword) {
            $progjaQuery = $progjaQuery
                ->groupStart()
                    ->like('program_kerja', $keyword)
                    ->orLike('deskripsi_program', $keyword)
                ->groupEnd();
        }
    
        $data = [
            'title' => 'Kelola Program Kerja',
            'menu' => 'kelola_progja',
            'programs' => $progjaQuery->findAll(),
            'keyword' => $keyword
        ];
    
        return view('admin/profil/kelolaProgram', $data);
    }
    
        public function tambah_progja()
    {
        $data = [
            'title' => 'Tambah Program Kerja',
            'menu' => 'Tambah Program Kerja',
            'validation' => \config\Services::validation()

        ];
        return view('admin/profil/addProgram', $data);
    }

    public function save_progja()
    {
        if (!$this->validate([
            'program_kerja' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Program Kerja wajib diisi!',
                    'min_length' => 'Program Kerja minimal 3 karakter!'
                ]
            ],
            'deskripsi_program' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Deskripsi Program wajib diisi!',
                    'min_length' => 'Deskripsi Program minimal 5 karakter!'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Program wajib diisi!'
                ]
            ],
        ])) {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('/admin/kelola_progja/tambah_progja');
        } else {
            // Jika validasi berhasil
            $this->progjaModel->save([
                'program_kerja' => $this->request->getVar('program_kerja'),
                'deskripsi_program' => $this->request->getVar('deskripsi_program'),
                'status' => $this->request->getVar('status'),
            ]);

            // Redirect ke halaman kelola program
            return redirect()->to('/kelola_progja');
        }
    }

    public function edit_progja($id = false)
    {
        $progjaModel = $this->progjaModel->where(['id' => $id])->first();
        $data = [
            'title' => 'Edit Program Kerja',
            'menu' => 'kelola_progja',
            'program' => $progjaModel
        ];
        return view('admin/profil/editProgram', $data);
    }

    public function save_editProgja()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            return redirect()->back()->with('error', 'ID SDM tidak ditemukan.');
        }
    if (!$this->validate([
        'program_kerja' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Program Kerja wajib diisi!',
                'min_length' => 'Program Kerja minimal 3 karakter!'
            ]
        ],
        'deskripsi_program' => [
            'rules' => 'required|min_length[5]',
            'errors' => [
                'required' => 'Deskripsi Program wajib diisi!',
                'min_length' => 'Deskripsi Program minimal 5 karakter!'
            ]
        ],
        'status' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Status Program wajib diisi!'
            ]
        ],
    ])) {
        // Jika validasi gagal
        session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        return redirect()->to('/admin/kelola_progja/edit/' . $id)->withInput();
    }

    // Jika validasi berhasil
    $this->progjaModel->update($id, [
        'program_kerja' => $this->request->getVar('program_kerja'),
        'deskripsi_program' => $this->request->getVar('deskripsi_program'),
        'status' => $this->request->getVar('status'),
    ]);

    // Redirect ke halaman kelola program
    return redirect()->to('/kelola_progja')->with('success', 'Program kerja berhasil diperbarui!');
}

    // Statistik MoU
    public function statistik_mou()
    {
        $jumlahPerTahun = $this->kerjasamaModel->getStatistikMouPerTahun();
    
        $data = [
            'title' => 'Statistik MoU',
            'menu' => 'statistik_mou',
            'statistik' => $jumlahPerTahun
        ];
    
        return view('admin/mou/statistikMou', $data);
    }
    
    // Jaminan Mutu
    public function jaminan_mutu()
    {
        $jaminanmutuModel = $this->jaminanmutuModel->findAll();
        $data = [
            'title' => 'Jaminan Mutu',
            'menu' => 'jaminan_mutu',
            'jaminanMutu' => $jaminanmutuModel
        ];
        return view('admin/jaminan_mutu/jaminanMutu', $data);
    }

    public function tambah_jaminan_mutu()
    {
        $data = [
            'title' => 'Tambah Jaminan Mutut',
            'menu' => 'jaminan_mutu',
            'validation' => \config\Services::validation()

        ];
        return view('admin/jaminan_mutu/addJaminanMutu', $data);
    }

    public function save_jaminan_mutu()
    {
        if (!$this->validate([
            'indikator' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'indikator wajib diisi!',
                    'min_length' => 'indikator minimal 3 karakter!'
                ]
            ],
            'nilai' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'nilai wajib diisi!',
                    'decimal' => 'nilai harus berupa angka desimal!'
                ]
            ],
            ],
        )) {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('/jaminan_mutu/tambah_jaminan_mutu');
        } else {
            // Jika validasi berhasil
            $this->jaminanmutuModel->save([
                'indikator' => $this->request->getVar('indikator'),
                'nilai' => $this->request->getVar('nilai'),
            ]);

            // Redirect ke halaman kelola program
            return redirect()->to('/jaminan_mutu');
        }
    }

    public function edit_jaminanMutu($id = false)
    {
        $jaminanmutuModel = $this->jaminanmutuModel->where(['id' => $id])->first();
        $data = [
            'title' => 'Edit Jaminan Mutu',
            'menu' => 'jaminan_mutu',
            'jaminan_mutu' => $jaminanmutuModel
        ];
        return view('admin/jaminan_mutu/editJaminanMutu', $data);
    }

    public function save_editJaminanMutu()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            return redirect()->back()->with('error', 'ID SDM tidak ditemukan.');
        }
        if (!$this->validate([
            'indikator' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Indikator wajib diisi!',
                    'min_length' => 'Indikator minimal 3 karakter!'
                ]
            ],
            'nilai' => [
                'rules' => 'required|min_length[1]',
                'errors' => [
                    'required' => 'Nilai wajib diisi!',
                    'min_length' => 'Nilai minimal 1 karakter!'
                ]
            ]
        ])) {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('/jaminan_mutu/edit/' . $id)->withInput();
        }
    
        // Jika validasi berhasil
        $this->jaminanmutuModel->update($id, [
            'indikator' => $this->request->getVar('indikator'),
            'nilai'     => $this->request->getVar('nilai'),
        ]);
    
        // Redirect ke halaman kelola jaminan mutu
        return redirect()->to('/jaminan_mutu')->with('success', 'Data jaminan mutu berhasil diperbarui!');
    }
    

    // Berita
    public function kelola_berita()
    {
        $keyword = $this->request->getGet('keyword');
    
        $beritaModel = $this->beritaModel->getBeritaWithRelasi($keyword);
    
        $data = [
            'title' => 'Berita',
            'menu' => 'kelola_berita',
            'berita' => $beritaModel,
            'keyword' => $keyword
        ];
        return view('admin/berita/berita', $data);
    }
    

    public function tambah_berita()
    {
        $kategoriModel = $this->kategoriberitaModel->findAll();
        $data = [
            'title' => 'Tambah Berita',
            'menu' => 'kelola_berita',
            'kategori' => $kategoriModel,
            'validation' => \config\Services::validation()

        ];
        return view('admin/berita/addBerita', $data);
    }

    public function save_berita()
    {
        $userId = session()->get('id');
        // Validasi input
        if (!$this->validate([
            'judul' => 'required',
            'isi_berita' => 'required',
            'id_kategori_berita' => 'required',
            'gambar' => [
                'rules' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'File harus berupa gambar',
                    'mime_in' => 'Format gambar tidak didukung',
                ]
            ]
        ])) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('/kelola_berita/tambah_berita')->withInput();
        }
        $userId = session()->get('id');
        // Ambil file gambar
        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('uploads/gambar', $namaGambar);

        // Simpan data ke database
        $this->beritaModel->save([
            'judul' => $this->request->getVar('judul'),
            'isi_berita' => $this->request->getVar('isi_berita'),
            'gambar' => $namaGambar,
            'publish_date' => date('Y-m-d H:i:s'),
            'id_kategori_berita' => $this->request->getVar('id_kategori_berita'),
            'id_user' => $userId ?? 1 // default ke admin (id = 1) kalau tidak ada sesi login
        ]);

        return redirect()->to('/kelola_berita');
    }
    public function edit_berita($id)
    {
        $berita = $this->beritaModel->where('berita.id', $id)->first();
    
        if (!$berita) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data dokumen dengan ID $id tidak ditemukan.");
        }
        $kategoriModel = $this->kategoriberitaModel->findAll();
        $data = [
            'title' => 'Edit Berita',
            'menu' => 'kelola_berita',
            'berita' => $berita,
            'kategori' => $kategoriModel,
        ];
    
        return view('admin/berita/editBerita', $data);
    }

    public function save_editBerita()
{
    // Ambil data lama dari database
    $id = $this->request->getPost('id');
    if (!$id) {
        return redirect()->back()->with('error', 'ID Berita tidak ditemukan.');
    }
    $beritaLama = $this->beritaModel->find($id);

    // Siapkan aturan validasi dasar
    $rules = [
        'judul' => 'required',
        'isi_berita' => 'required',
        'id_kategori_berita' => 'required',
    ];

    // Cek apakah user upload gambar baru
    $fileGambar = $this->request->getFile('gambar');
    if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
        $rules['gambar'] = [
            'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
            'errors' => [
                'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                'is_image' => 'File harus berupa gambar',
                'mime_in' => 'Format gambar tidak didukung',
            ]
        ];
    }

    // Validasi form
    if (!$this->validate($rules)) {
        session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        return redirect()->to('/kelola_berita/edit/' . $id)->withInput();
    }

    // Siapkan nama gambar
    if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('uploads/gambar', $namaGambar);

        // Hapus gambar lama jika ada
        if (!empty($beritaLama['gambar']) && file_exists('uploads/gambar/' . $beritaLama['gambar'])) {
            unlink('uploads/gambar/' . $beritaLama['gambar']);
        }
    } else {
        $namaGambar = $beritaLama['gambar']; // gunakan gambar lama
    }

    // Simpan perubahan
    $this->beritaModel->update($id, [
        'judul' => $this->request->getVar('judul'),
        'isi_berita' => $this->request->getVar('isi_berita'),
        'gambar' => $namaGambar,
        'id_kategori_berita' => $this->request->getVar('id_kategori_berita'),
        'id_user' => $beritaLama['id_user'], // tetap ambil dari data lama
        'publish_date' => $beritaLama['publish_date'], // jangan diubah
    ]);

    return redirect()->to('/kelola_berita')->with('success', 'Berita berhasil diperbarui!');
}


    // Kategori Berita
    public function kelola_kategori_berita()
    {
        $kategoriberitaModel = $this->kategoriberitaModel->findAll();
        $data = [
            'title' => 'Kategori Berita',
            'menu' => 'kelola_kategori_berita',
            'kategoriBerita' => $kategoriberitaModel
        ];
        return view('admin/berita/kategoriBerita', $data);
    }

    public function tambah_kategori_berita()
    {
        $data = [
            'title' => 'Tambah Kategori Berita',
            'menu' => 'kelola_kategori_berita',
            'validation' => \config\Services::validation()

        ];
        return view('admin/berita/addKategoriBerita', $data);
    }

    public function save_kategori_berita()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'nama wajib diisi!',
                    'min_length' => 'nama minimal 3 karakter!'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|min_length[1]',
                'errors' => [
                    'required' => 'deskripsi wajib diisi!',
                    'min_length' => 'deskripsi minimal 5 karakter!'
                ]
            ],
            ],
        )) {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('/kelola_kategori_berita/tambah_kategori_berita');
        } else {
            // Jika validasi berhasil
            $this->kategoriberitaModel->save([
                'nama' => $this->request->getVar('nama'),
                'deskripsi' => $this->request->getVar('deskripsi'),
            ]);

            // Redirect ke halaman kelola program
            return redirect()->to('/kelola_kategori_berita');
        }
    }

    public function edit_kategoriBerita($id = false)
    {
        $kategoriberitaModel = $this->kategoriberitaModel->where(['id' => $id])->first();
        $data = [
            'title' => 'Edit Kategori Berita',
            'menu' => 'kelola_kategori_berita',
            'kategori' => $kategoriberitaModel
        ];
        return view('admin/berita/editKategoriBerita', $data);
    }

    public function save_editKategoriBerita()
{
    $id = $this->request->getPost('id');
    if (!$id) {
        return redirect()->back()->with('error', 'ID SDM tidak ditemukan.');
    }

    if (!$this->validate([
        'nama' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Nama wajib diisi!',
                'min_length' => 'Nama minimal 3 karakter!'
            ]
        ],
        'deskripsi' => [
            'rules' => 'required|min_length[5]',
            'errors' => [
                'required' => 'Deskripsi wajib diisi!',
                'min_length' => 'Deskripsi minimal 5 karakter!'
            ]
        ]
    ])) {
        session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        return redirect()->to('/kelola_kategori_berita/edit/' . $id)->withInput();
    }

    $this->kategoriberitaModel->update($id, [
        'nama' => $this->request->getVar('nama'),
        'deskripsi' => $this->request->getVar('deskripsi'),
    ]);

    return redirect()->to('/kelola_kategori_berita')->with('success', 'Kategori berita berhasil diperbarui!');
}


    // Dokumen
    public function kelola_dokumen()
    {
        $keyword = $this->request->getGet('keyword');
    
        $dokumenBuilder = $this->dokumenModel
            ->select('dokumen.*, status.status, jenis_dokumen.jenis')
            ->join('status', 'status.id = dokumen.id_status', 'left')
            ->join('jenis_dokumen', 'jenis_dokumen.id = dokumen.jenis_dokumen_id', 'left');
    
        if ($keyword) {
            $dokumenBuilder->groupStart()
                ->like('dokumen.nama_dokumen', $keyword)
                ->orLike('jenis_dokumen.jenis', $keyword)
                ->orLike('status.status', $keyword)
            ->groupEnd();
        }
    
        $perPage = 10;
    
        $data = [
            'title' => 'Kelola Dokumen',
            'menu' => 'kelola_dokumen',
            'dokumen' => $dokumenBuilder->paginate($perPage, 'dokumen'),
            'pager' => $this->dokumenModel->pager,
            'currentPage' => $this->request->getGet('page_dokumen') ?? 1,
            'totalPages' => ceil($this->dokumenModel->pager->getTotal('dokumen') / $perPage),
            'keyword' => $keyword
        ];
    
        return view('admin/dokumen/kelolaDokumen', $data);
    }
    
    
    public function tambah_dokumen()
    {
        $dokumenModel = $this->dokumenModel->findAll();
        $jenisDokumenModel = $this ->jenisdokumenModel->findAll();
        $statusModel = $this ->statusModel->findAll();
        $data = [
            'title' => 'Tambah Dokumen',
            'menu' => 'kelola_dokumen',
            'dokumen' => $dokumenModel,
            'status' => $statusModel,
            'jenis' => $jenisDokumenModel,
        ];
        return view('admin/dokumen/addDokumen', $data);
    }

    public function save_dokumen()
    {
        if (!$this->validate([
            'nama_dokumen' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama dokumen wajib diisi!',
                    'min_length' => 'Nama dokumen minimal 3 karakter!'
                ]
            ],
            'jenis_dokumen_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis dokumen wajib dipilih!'
                ]
            ],
            'id_status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status dokumen wajib dipilih!'
                ]
            ],
            'file_pdf' => [
                'rules' => 'uploaded[file_pdf]|max_size[file_pdf,10240]|mime_in[file_pdf,application/pdf]',
                'errors' => [
                    'uploaded' => 'File PDF wajib diupload!',
                    'max_size' => 'Ukuran file PDF terlalu besar! Maksimal 10MB.',
                    'mime_in' => 'File yang diupload harus berupa PDF.',
                ]
            ],
        ])) {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('/kelola_dokumen/tambah_dokumen');
        } else {
            // Jika validasi berhasil, simpan dokumen
            $filePDF = $this->request->getFile('file_pdf');
            $namaPDF = $filePDF->getRandomName();
            $filePDF->move('uploads/dokumen', $namaPDF);
    
            // Menyimpan data ke dalam tabel dokumen dengan menggunakan ID untuk jenis dokumen dan status dokumen
            $this->dokumenModel->save([
                'nama_dokumen' => $this->request->getVar('nama_dokumen'),
                'jenis_dokumen_id' => $this->request->getVar('jenis_dokumen_id'), // ID untuk jenis dokumen
                'id_status' => $this->request->getVar('id_status'), // ID untuk status dokumen
                'file_pdf' => $namaPDF, // Menyimpan nama file PDF
            ]);
    
            // Redirect ke halaman kelola dokumen
            return redirect()->to('/kelola_dokumen');
        }
    }

    public function edit_dokumen($id)
    {
        $dokumen = $this->dokumenModel
            ->select('dokumen.*, status.status, jenis_dokumen.jenis')
            ->join('status', 'status.id = dokumen.id_status', 'left')
            ->join('jenis_dokumen', 'jenis_dokumen.id = dokumen.jenis_dokumen_id', 'left')
            ->where('dokumen.id', $id)
            ->first();
    
        if (!$dokumen) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data dokumen dengan ID $id tidak ditemukan.");
        }
        $jenisDokumenModel = $this->jenisdokumenModel->findAll();
        $statusModel = $this->statusModel->findAll();
        $data = [
            'title' => 'Edit Dokumen',
            'menu' => 'kelola_dokumen',
            'dokumen' => $dokumen,
            'jenis' => $jenisDokumenModel,
            'status' => $statusModel
        ];
    
        return view('admin/dokumen/editDokumen', $data);
    }

    public function save_editDokumen()
{
    $id = $this->request->getPost('id');
    if (!$id) {
        return redirect()->back()->with('error', 'ID Dokumen tidak ditemukan.');
    }
    // Aturan validasi tanpa file_pdf (opsional)
    $rules = [
        'nama_dokumen' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Nama dokumen wajib diisi!',
                'min_length' => 'Nama dokumen minimal 3 karakter!'
            ]
        ],
        'jenis_dokumen_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jenis dokumen wajib dipilih!'
            ]
        ],
        'id_status' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Status dokumen wajib dipilih!'
            ]
        ]
    ];

    // Kalau user upload file baru, tambahkan validasi PDF
    if ($this->request->getFile('file_pdf')->isValid()) {
        $rules['file_pdf'] = [
            'rules' => 'max_size[file_pdf,10240]|mime_in[file_pdf,application/pdf]',
            'errors' => [
                'max_size' => 'Ukuran file PDF terlalu besar! Maksimal 2MB.',
                'mime_in' => 'File yang diupload harus berupa PDF.'
            ]
        ];
    }

    if (!$this->validate($rules)) {
        session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        return redirect()->to('/edit_dokumen/' . $id)->withInput();
    }

    // Ambil dokumen lama
    $dokumenLama = $this->dokumenModel->find($id);

    // Cek apakah user upload file baru
    $filePDF = $this->request->getFile('file_pdf');
    if ($filePDF && $filePDF->isValid()) {
        $namaPDF = $filePDF->getRandomName();
        $filePDF->move('uploads/dokumen', $namaPDF);

        // Hapus file lama jika ada
        if (!empty($dokumenLama['file_pdf']) && file_exists('uploads/dokumen/' . $dokumenLama['file_pdf'])) {
            unlink('uploads/dokumen/' . $dokumenLama['file_pdf']);
        }
    } else {
        $namaPDF = $dokumenLama['file_pdf']; // gunakan file lama jika tidak ada upload baru
    }

    // Simpan update
    $this->dokumenModel->update($id, [
        'nama_dokumen' => $this->request->getVar('nama_dokumen'),
        'jenis_dokumen_id' => $this->request->getVar('jenis_dokumen_id'),
        'id_status' => $this->request->getVar('id_status'),
        'file_pdf' => $namaPDF
    ]);

    return redirect()->to('/kelola_dokumen')->with('success', 'Dokumen berhasil diperbarui!');
}

//pengaduan
public function kelola_pengaduan()
{
    $keyword = $this->request->getGet('keyword');

    $pengaduanQuery = $this->pengaduanModel;

    if ($keyword) {
        $pengaduanQuery = $pengaduanQuery
            ->groupStart()
                ->like('nama', $keyword)
                ->orLike('instansi', $keyword)
                ->orLike('email', $keyword)
                ->orLike('pertanyaan', $keyword)
            ->groupEnd();
    }

    $data = [
        'title' => 'Pengaduan',
        'menu' => 'kelola_pengaduan',
        'pengaduan' => $pengaduanQuery->findAll(),
        'keyword' => $keyword
    ];

    return view('admin/pengaduan/pengaduan', $data);
}


    // Balas pengaduan
    public function balas($id)
    {
        // Cek apakah pengaduan dengan ID tersebut ada
        $pengaduan = $this->pengaduanModel->find($id);
    
        if (!$pengaduan) {
            return redirect()->to('/kelola_pengaduan')->with('error', 'Pengaduan tidak ditemukan.');
        }
    
        // Jika method POST dan belum dibalas
        if ($this->request->getMethod() === 'post') {
            // Cegah jika sudah dibalas
            if (!empty($pengaduan['balasan'])) {
                return redirect()->to('/kelola_pengaduan/balas/' . $id)
                    ->with('info', 'Pengaduan sudah pernah dibalas. Tidak dapat membalas ulang.');
            }
    
            // Validasi input balasan
            $balasan = $this->request->getPost('balasan');
            if (empty($balasan)) {
                return redirect()->back()->with('error', 'Balasan tidak boleh kosong.');
            }
    
            // Kirim email
            $emailTo = $pengaduan['email'];
            $emailSent = $this->_sendEmail($emailTo, $balasan);
    
            if (!$emailSent) {
                return redirect()->back()->with('error', 'Email gagal dikirim.');
            }
    
            // Simpan balasan
            $this->pengaduanModel->update($id, [
                'balasan' => $balasan,
            ]);
    
            return redirect()->to('/kelola_pengaduan')->with('success', 'Balasan berhasil dikirim.');
        }
    
        // Tampilkan halaman balas dengan form atau hanya balasan (diatur di view)
        $data = [
            'title' => 'Balas Pengaduan',
            'menu' => 'kelola_pengaduan',
            'pengaduan' => $pengaduan
        ];
    
        return view('admin/pengaduan/balasPengaduan', $data);
    }
    

    // Fungsi untuk mengirim email
    private function _sendEmail($emailTo, $balasan)
    {
        $email = \Config\Services::email();
        $email->setFrom('dimasw694@student.ub.ac.id', 'Admin Pengaduan');
        $email->setTo($emailTo);
        $email->setSubject('Balasan Pengaduan Anda');
        $email->setMessage($balasan);

        // Cek pengiriman email
        if (!$email->send()) {
            log_message('error', 'Email gagal dikirim ke: ' . $emailTo);
            return false; // Jika gagal, return false
        }
        return true; // Jika sukses, return true
    }

    public function kelola_pengajuan()
    {
        $keyword = $this->request->getGet('keyword');
    
        $pengajuanQuery = $this->pengajuanModel;
    
        if ($keyword) {
            $pengajuanQuery = $pengajuanQuery
                ->groupStart()
                    ->like('nama_instansi_mitra', $keyword)
                    ->orLike('bidang_kerjasama', $keyword)
                    ->orLike('status_surat', $keyword)
                    ->orLike('status_dokumen', $keyword)
                ->groupEnd();
        }
    
        $data = [
            'title' => 'Pengajuan Kerjasama',
            'menu' => 'kelola_pengajuan',
            'pengajuan' => $pengajuanQuery->findAll(),
            'keyword' => $keyword
        ];
    
        return view('admin/pengajuan/kelolaPengajuan', $data);
    }
    

    public function update_status($id, $type, $action = null)
    {
        $pengajuan = $this->pengajuanModel->find($id);
    
        if (!$pengajuan) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Pengajuan tidak ditemukan']);
        }
    
        // Ambil data user untuk menentukan email tujuan
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($pengajuan['user_id']);
        $emailTujuan = ($user && $user['keterangan'] === 'fakultas dan unit kerja') ? $user['email'] : $pengajuan['email_pic_mitra'];
    
        // ======== SURAT ========
        if ($type === 'surat') {
            if ($action === 'approve') {
                $this->pengajuanModel->update($id, [
                    'status_surat' => 'Disetujui',
                    'status_dokumen' => 'Disposisi Rektor/WR',
                ]);
            } elseif ($action === 'reject') {
                $input = json_decode($this->request->getBody(), true);
                $alasan = $input['alasan'] ?? 'Tidak ada alasan';
    
                $this->pengajuanModel->update($id, [
                    'status_surat' => 'Ditolak',
                    'status_dokumen' => 'Ditolak',
                    'alasan_ditolak' => $alasan,
                ]);
    
                // Kirim Email Penolakan Surat
                $email = \Config\Services::email();
                $config = new \Config\Email();
    
                $email->setFrom($config->fromEmail, $config->fromName);
                $email->setTo($emailTujuan);
                $email->setSubject('Penolakan Surat Pengajuan Kerjasama');
                $email->setMessage("
                    <p>Yth. <strong>{$pengajuan['nama_instansi_mitra']}</strong>,</p>
                    <p>Surat pengajuan kerjasama Anda telah <strong style='color:red;'>DITOLAK</strong>.</p>
                    <p><strong>Alasan:</strong> {$alasan}</p>
                    <br><p>Silakan perbaiki dan ajukan ulang jika diperlukan.</p>
                ");
    
                if (!$email->send()) {
                    log_message('error', 'Gagal kirim email penolakan surat: ' . print_r($email->printDebugger(['headers']), true));
                }
            }
        }
    
        // ======== DOKUMEN ========
        if ($type === 'dokumen') {
            if ($action === 'reject') {
                $input = json_decode($this->request->getBody(), true);
                $alasan = $input['alasan'] ?? 'Tidak ada alasan';
    
                $this->pengajuanModel->update($id, [
                    'status_dokumen' => 'Ditolak',
                    'alasan_ditolak' => $alasan,
                ]);
    
                // Kirim Email Penolakan Dokumen
                $email = \Config\Services::email();
                $config = new \Config\Email();
    
                $email->setFrom($config->fromEmail, $config->fromName);
                $email->setTo($emailTujuan);
                $email->setSubject('Penolakan Dokumen Pengajuan Kerjasama');
                $email->setMessage("
                    <p>Yth. <strong>{$pengajuan['nama_instansi_mitra']}</strong>,</p>
                    <p>Dokumen pengajuan kerjasama Anda telah <strong style='color:red;'>DITOLAK</strong>.</p>
                    <p><strong>Alasan:</strong> {$alasan}</p>
                    <br><p>Silakan lengkapi atau perbaiki dokumen, lalu ajukan ulang.</p>
                ");
    
                if (!$email->send()) {
                    log_message('error', 'Gagal kirim email penolakan dokumen: ' . print_r($email->printDebugger(['headers']), true));
                }
            } elseif ($action === 'approve') {
                switch ($pengajuan['status_dokumen']) {
                    case 'Disposisi Rektor/WR':
                        $this->pengajuanModel->update($id, ['status_dokumen' => 'Disposisi Direktur']);
                        break;
                    case 'Disposisi Direktur':
                        $this->pengajuanModel->update($id, ['status_dokumen' => 'Disposisi Sekdir']);
                        break;
                    case 'Disposisi Sekdir':
                        $this->pengajuanModel->update($id, ['status_dokumen' => 'Disposisi Kasubdit']);
                        break;
                    case 'Disposisi Kasubdit':
                        $this->pengajuanModel->update($id, ['status_dokumen' => 'Selesai']);
    
                        // Kirim Email Konfirmasi Dokumen Selesai
                        $email = \Config\Services::email();
                        $config = new \Config\Email();
    
                        $email->setFrom($config->fromEmail, $config->fromName);
                        $email->setTo($emailTujuan);
                        $email->setSubject('Dokumen Pengajuan Kerjasama Telah Selesai');
                        $email->setMessage("
                            <p>Yth. <strong>{$pengajuan['nama_instansi_mitra']}</strong>,</p>
                            <p>Dokumen pengajuan kerjasama Anda telah <strong style='color:green;'>SELESAI</strong>.</p>
                            <p>Untuk melakukan konfirmasi, silakan hubungi nomor outline <strong>(+62) 822-2656-6675</strong> Direktorat Kerjasama.</p>
                            <br><p>Terima kasih.</p>
                        ");
    
                        if (!$email->send()) {
                            log_message('error', 'Gagal kirim email dokumen selesai: ' . print_r($email->printDebugger(['headers']), true));
                        }
                        break;
                    case 'Ditolak':
                        // Tidak lakukan apa-apa
                        break;
                    default:
                        // Status tidak valid
                        break;
                }
            }
        }
    
        return $this->response->setJSON(['status' => 'success']);
    }

    public function detail_pengajuan($id)
    {
        // Mengambil pengajuan berdasarkan ID
        $pengajuan = $this->pengajuanModel->find($id);
    
        // Jika pengajuan tidak ditemukan
        if (!$pengajuan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Pengajuan dengan ID $id tidak ditemukan.");
        }
    
        // Ambil data user berdasarkan user_id
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($pengajuan['user_id']);
    
        // Gabungkan data user ke pengajuan
        if ($user) {
            $pengajuan['name'] = $user['name'];
            $pengajuan['email'] = $user['email'];
            $pengajuan['keterangan'] = $user['keterangan'];
        }
    
        $data = [
            'title' => 'Detail Pengajuan',
            'menu' => 'kelola_pengajuan',
            'pengajuan' => $pengajuan,
        ];
    
        return view('admin/pengajuan/detailPengajuan', $data);
    }
    

    public function delete_hero($id = false)
    {
        $this->heroModel->delete($id);
        return redirect()->to('/hero_content');
    }

    public function delete_kerjasama($id = false)
    {
        $this->kerjasamaModel->delete($id);
        return redirect()->to('/kelola_kerjasama');
    }

    public function delete_gambar($id = false)
    {
        $this->gambarModel->delete($id);
        return redirect()->to('/kelola_gambar');
    }

    public function delete_sdm($id = false)
    {
        $this->sdmModel->delete($id);
        return redirect()->to('/kelola_sdm');
    }

    public function delete_jabatan($id = false)
    {
        $this->jabatanModel->delete($id);
        return redirect()->to('/kelola_jabatan');
    }

    public function delete_profil($id = false)
    {
        $this->profilModel->delete($id);
        return redirect()->to('/kelola_profil');
    }

    public function delete_progja($id = false)
    {
        $this->progjaModel->delete($id);
        return redirect()->to('/kelola_progja');
    }

    public function delete_jaminanmutu($id = false)
    {
        $this->jaminanmutuModel->delete($id);
        return redirect()->to('/jaminan_mutu');
    }

    public function delete_berita($id = false)
    {
        $this->beritaModel->delete($id);
        return redirect()->to('/kelola_berita');
    }

    public function delete_kategori_berita($id = false)
    {
        $this->kategoriberitaModel->delete($id);
        return redirect()->to('/kelola_kategori_berita');
    }

    public function delete_dokumen($id = false)
    {
        $this->dokumenModel->delete($id);
        return redirect()->to('/kelola_dokumen');
    }

    public function delete_pengaduan($id = false)
    {
        $this->pengaduanModel->delete($id);
        return redirect()->to('/kelola_pengaduan');
    }

    public function delete_pengajuan($id = false)
    {
        $this->pengajuanModel->delete($id);
        return redirect()->to('/kelola_pengajuan');
    }
}
