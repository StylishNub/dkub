<?php

namespace App\Controllers;

use App\Models\HeroContentModel;
use App\Models\AuthModel;
use App\Models\KerjasamaModel;
use App\Models\PengaduanModel;
use App\Models\PengajuanModel;
use App\Models\UserModel;
use App\Models\StatistikMouModel;
use App\Models\ProfilModel;
use App\Models\JabatanModel;
use App\Models\SdmModel;
use App\Models\ProgjaModel;
use App\Models\DokumenModel;
use App\Models\BeritaModel;
use App\Models\GambarModel;
use App\Models\JaminanmutuModel;
use App\Controllers\BaseUserController;



class User extends BaseController
{
    protected $HeroModel;
    protected $AuthModel;
    protected $KerjasamaModel;
    protected $PengaduanModel;
    protected $PengajuanModel;
    protected $UserModel;
    protected $StatistikModel;
    protected $ProfilModel;
    protected $JabatanModel;
    protected $SdmModel;
    protected $ProgjaModel;
    protected $DokumenModel;
    protected $BeritaModel;
    protected $GambarModel;
    protected $JaminanMutuModel;

    public function __construct()
    {
        $this->HeroModel = new HeroContentModel();
        $this->AuthModel = new AuthModel();
        $this->KerjasamaModel = new KerjasamaModel();
        $this->PengaduanModel = new PengaduanModel();
        $this->PengajuanModel = new PengajuanModel();
        $this->UserModel = new UserModel();
        $this->StatistikModel = new StatistikMouModel();
        $this->ProfilModel = new ProfilModel();
        $this->JabatanModel = new JabatanModel();
        $this->SdmModel = new SdmModel();
        $this->ProgjaModel = new ProgjaModel();
        $this->DokumenModel = new DokumenModel();
        $this->BeritaModel = new BeritaModel();
        $this->GambarModel = new GambarModel();
        $this->JaminanMutuModel = new JaminanmutuModel();
    
        helper('session'); // ini juga boleh, meskipun di base controller biasanya udah
        
    }

    public function index()
    {
        $pengaduanModel = $this->PengaduanModel->findAll();
        $KerjasamaModel = $this->KerjasamaModel->findAll();
        $StatistikModel = $this->StatistikModel->findAll();
        $heroData = $this->HeroModel->orderBy('id', 'ASC')->findAll(4);
        $berita = $this->BeritaModel->orderBy('publish_date', 'DESC')->limit(3)->findAll();
    
        // Tambahan: Ambil data MoU untuk chart
        $chartMouData = $this->KerjasamaModel->select('tahun, COUNT(id) as jumlah')
                            ->groupBy('tahun')
                            ->orderBy('tahun', 'ASC')
                            ->findAll();
    
        // Ambil array tahun dan jumlah MoU
        $tahun = array_column($chartMouData, 'tahun');
        $jumlah = array_column($chartMouData, 'jumlah');
        $dokumen = $this->DokumenModel
        ->select('dokumen.*, status.status, jenis_dokumen.jenis')
        ->join('status', 'status.id = dokumen.id_status', 'left')
        ->join('jenis_dokumen', 'jenis_dokumen.id = dokumen.jenis_dokumen_id', 'left')
        ->whereIn('jenis_dokumen.jenis', ['Prospectus'])
        ->where('status.status', 'Aktif')
        ->first();
    
        $data = [
            'title' => 'Beranda',
            'menu' => 'home',
            'pengaduan' => $pengaduanModel,
            'kerjasama' => $KerjasamaModel,
            'statistik' => $StatistikModel,
            'hero' => $heroData,
            'berita' => $berita,
            'dokumen' => $dokumen,
            'statistik_mou' => $chartMouData,
            'tahun_mou' => json_encode($tahun),
            'jumlah_mou' => json_encode($jumlah),
            'successMessage' => session()->getFlashdata('success')
        ];
    
        return view('user/home', $data);
    }
    
    



    public function submitSurvey()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]',
            'phone' => 'required|numeric',
            'email' => 'required|valid_email',
            'question' => 'required|min_length[5]',
            'bukti_upload' => 'if_exist|max_size[bukti_upload,2048]' // Semua jenis file dibolehkan, max 2MB
        ]);
    
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        $data = [
            'nama' => $this->request->getPost('name'),
            'instansi' => $this->request->getPost('instansi'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('phone'),
            'pertanyaan' => $this->request->getPost('question'),
            'balasan' => null // biarkan null karena nanti akan diisi admin
        ];
    
        $file = $this->request->getFile('bukti_upload');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newFileName = $file->getRandomName();
            $uploadPath = FCPATH . 'uploads/dokumen';
        
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
        
            $file->move($uploadPath, $newFileName);
            $data['bukti_upload'] = $newFileName;
        }
        
    
        $pengaduanModel = new \App\Models\PengaduanModel();
        if ($pengaduanModel->save($data)) {
            session()->setFlashdata('success', 'Pengaduan Anda telah berhasil dikirim dan sedang kami proses.');
        } else {
            session()->setFlashdata('error', 'Terjadi kesalahan saat menyimpan pengaduan.');
        }
    
        return redirect()->to('/');
    }
    

    public function sejarah()
    {
        $ProfilModel = $this->ProfilModel->first();
        $data = [
            'title' => 'Sejarah',
            'menu' => 'sejarah',
            'profil' => $ProfilModel
        ];
        return view('user/sejarah', $data);
    }

    public function visimisi()
    {
        $ProfilModel = $this->ProfilModel->first();
        $data = [

            'title' => 'Visi Misi',
            'menu' => 'Visi Misi',
            'profil' => $ProfilModel
        ];
        return view('user/visimisi', $data);
    }
    public function organisasi()
    {
        $jabatan = $this->JabatanModel->findAll();
    
        // Ambil gambar dari GambarModel yang kategorinya 'organisasi'
        $gambar = $this->GambarModel
        ->select('gambar.*') // ambil semua kolom dari tabel gambar
        ->join('status', 'status.id = gambar.id_status')
        ->where('gambar.kategori', 'organisasi')
        ->where('status.status', 'aktif')
        ->first();
    
        $data = [
            'title' => 'Struktur Organisasi',
            'menu' => 'organisasi',
            'jabatan' => $jabatan,
            'gambar' => $gambar
        ];
        return view('user/organisasi', $data);
    }
    public function dinas()
    {
        $gambar = $this->GambarModel
        ->select('gambar.*') // ambil semua kolom dari tabel gambar
        ->join('status', 'status.id = gambar.id_status')
        ->where('gambar.kategori', 'Perjalanan Dinas LN')
        ->where('status.status', 'aktif')
        ->first();
    
        $data = [
            'title' => 'Perjalanan Dinas Luar Negeri',
            'menu' => 'perjalanan_dinas',
            'gambar' => $gambar
        ];
        return view('user/perjalananDinas', $data);
    }

    public function sdm()
    {
        $sdm = $this->SdmModel
            ->select('sdm.*, jabatan.nama_jabatan')
            ->join('jabatan', 'sdm.id_jabatan = jabatan.id', 'left')
            ->findAll();
    
        $data = [
            'title' => 'Sumber Daya Manusia',
            'menu' => 'sdm',
            'sdm'   => $sdm
        ];
        return view('user/SumberDayaManusia', $data);
    }

    public function progja()
    {
        $ProgjaModel = $this->ProgjaModel->findAll();
        $data = [
            'title' => 'Program Kerja',
            'menu' => 'progja',
            'program' => $ProgjaModel
        ];
        return view('user/programKerja', $data);
    }
    public function kerjasama()
    {
        $keyword  = $this->request->getGet('keyword');
        $perPage  = $this->request->getGet('perPage') ?? 10; // default 10
    
        $kerjasamaQuery = $this->KerjasamaModel
            ->select('mou.*, status.status')
            ->join('status', 'mou.id_status = status.id', 'left')
            ->where('status.status', 'Aktif');
    
        if ($keyword) {
            $kerjasamaQuery = $kerjasamaQuery
                ->groupStart()
                    ->like('mou.nama_mitra', $keyword)
                    ->orLike('mou.tahun', $keyword)
                    ->orLike('mou.jangka_waktu', $keyword)
                    ->orLike('mou.tanggal_mulai', $keyword)
                    ->orLike('mou.tanggal_berakhir', $keyword)
                ->groupEnd();
        }
    
        $data = [
            'title'        => 'Kerjasama',
            'menu'         => 'mou',
            'kerjasama'    => $kerjasamaQuery->paginate($perPage, 'mou'),
            'pager'        => $this->KerjasamaModel->pager,
            'keyword'      => $keyword,
            'perPage'      => $perPage,
            'page'         => $this->KerjasamaModel->pager->getCurrentPage('mou'),
            'total'        => $this->KerjasamaModel->pager->getPageCount('mou'),
        ];
    
        return view('user/kerjasama', $data);
    }
    
    public function mou()
    {
        $dokumen = $this->DokumenModel
            ->select('dokumen.*, status.status, jenis_dokumen.jenis')
            ->join('status', 'status.id = dokumen.id_status', 'left')
            ->join('jenis_dokumen', 'jenis_dokumen.id = dokumen.jenis_dokumen_id', 'left')
            ->where('jenis_dokumen.jenis', 'MOU')
            ->where('status.status', 'Aktif')
            ->findAll();
    
        $data = [
            'title' => 'Draft MOU',
            'menu' => 'mou',
            'dokumen' => $dokumen
        ];
        return view('user/mou', $data);
    }
    
    public function pks()
    {
        $dokumen = $this->DokumenModel
        ->select('dokumen.*, status.status, jenis_dokumen.jenis')
        ->join('status', 'status.id = dokumen.id_status', 'left')
        ->join('jenis_dokumen', 'jenis_dokumen.id = dokumen.jenis_dokumen_id', 'left')
        ->whereIn('jenis_dokumen.jenis', ['PKS', 'MOA', 'IA'])
        ->where('status.status', 'Aktif')
        ->findAll();
        $data = [
            'title' => 'Draft PKS, MoA, IA',
            'menu' => 'pks',
            'dokumen' => $dokumen
        ];
        return view('user/pks', $data);
    }
    public function evaluasi()
    {
        $jaminanmutu = $this->JaminanMutuModel->findAll();
    
        $total = 0;
        foreach ($jaminanmutu as $jm) {
            $total += (float) $jm['nilai'];
        }
    
        $rataRata = $total / count($jaminanmutu);
        $persentase = ($rataRata / 4) * 100;
    
        // Tentukan predikat
        if ($rataRata >= 3.26) {
            $predikat = 'A - Sangat Baik';
        } elseif ($rataRata >= 2.51) {
            $predikat = 'B - Baik';
        } elseif ($rataRata >= 1.76) {
            $predikat = 'C - Kurang Baik';
        } else {
            $predikat = 'D - Tidak Baik';
        }
    
        $data = [
            'title' => 'Evaluasi',
            'menu' => 'evaluasi',
            'jaminanmutu' => $jaminanmutu,
            'rata_rata' => $rataRata,
            'persentase' => $persentase,
            'predikat' => $predikat,
        ];
    
        return view('user/evaluasi', $data);
    }
    
    
    public function sop()
    {
            $dokumen = $this->DokumenModel
            ->select('dokumen.*, status.status, jenis_dokumen.jenis')
            ->join('status', 'status.id = dokumen.id_status', 'left')
            ->join('jenis_dokumen', 'jenis_dokumen.id = dokumen.jenis_dokumen_id', 'left')
            ->whereIn('jenis_dokumen.jenis', ['SOP'])
            ->where('status.status', 'Aktif')
            ->findAll();
            $data = [
                'title' => 'Draft SOP',
                'menu' => 'sop',
                'dokumen' => $dokumen
            ];
        return view('user/sop', $data);
    }
    public function pertor()
    {
        $dokumen = $this->DokumenModel
        ->select('dokumen.*, status.status, jenis_dokumen.jenis')
        ->join('status', 'status.id = dokumen.id_status', 'left')
        ->join('jenis_dokumen', 'jenis_dokumen.id = dokumen.jenis_dokumen_id', 'left')
        ->whereIn('jenis_dokumen.jenis', ['Dokumen Hukum'])
        ->where('status.status', 'Aktif')
        ->findAll();
        $data = [
            'title' => 'Peraturan Rektor',
            'menu' => 'pertor',
            'dokumen' => $dokumen
        ];
        return view('user/peraturanRektor', $data);
    }
    public function berita()
    {    helper('text');
            $berita = $this->BeritaModel->getBeritaWithRelasi();

        $data = [
            'title' => 'Berita',
            'menu' => 'berita',
            'berita' => $berita
        ];

        return view('user/berita', $data);
    }

    public function detail_berita($id)
    {
        $berita = $this->BeritaModel
                       ->select('berita.*, user.name as penulis, kategori_berita.nama as kategori')
                       ->join('user', 'user.id = berita.id_user')
                       ->join('kategori_berita', 'kategori_berita.id = berita.id_kategori_berita')
                       ->where('berita.id', $id)
                       ->first();
    
        if (!$berita) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Berita tidak ditemukan.');
        }
    
        return view('user/detailBerita', [
            'title' => $berita['judul'],
            'menu' => 'berita',
            'berita' => $berita
        ]);
    }








    // public function save_step1()
    // {
    //     $date_ = $this->request->getVar('date');
    //     $time_ = $this->request->getVar('time');

    //     if (!$this->validate([
    //         'date' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Date required',

    //             ]
    //         ],
    //         'time' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Time required'
    //             ]
    //         ],
    //     ])) {
    //         //jika tidak valid
    //         session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
    //         return redirect()->to('/therapy_step_1');
    //     } else {
    //         //jika valid
    //         // Simpan data dalam sesi
    //         session()->set('date_', $date_);
    //         session()->set('time_', $time_);
    //         return redirect()->to('/therapy_step_2');
    //     }
    // }

    // public function therapy_step_2()
    // {
    //     // Ambil data dari sesi
    //     $date_ = session()->get('date_');
    //     $time_ = session()->get('time_');

    //     $data = [
    //         'title' => 'Therapy Step 2',
    //         'menu' => 'therapy',
    //         'date_' => $date_, // Kirim data ke view
    //         'time_' => $time_, // Kirim data ke view
    //     ];
    //     return view('user/therapyStep2', $data);
    // }

    // public function save_therapy()
    // {
    //     $id = $this->request->getVar('id');
    //     $date = $this->request->getVar('date');
    //     $time = $this->request->getVar('time');
    //     $first_name = $this->request->getVar('first_name');
    //     $last_name = $this->request->getVar('last_name');
    //     $phone = $this->request->getVar('phone');
    //     $email = $this->request->getVar('email');

    //     if (!$this->validate([
    //         'date' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Date required',
    //             ]
    //         ],
    //         'time' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Time required'
    //             ]
    //         ],
    //         'id' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'You need to login'
    //             ]
    //         ],
    //         'first_name' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'First name required'
    //             ]
    //         ],
    //         'last_name' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Last name required'
    //             ]
    //         ],
    //         'phone' => [
    //             'rules' => 'required|numeric',
    //             'errors' => [
    //                 'required' => 'Phone number required',
    //                 'numeric' => 'Your input at phone column is not a number',
    //             ]
    //         ],
    //         'email' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Email required'
    //             ]
    //         ],
    //     ])) {
    //         //jika tidak valid
    //         session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
    //         return redirect()->to('/therapy_step_2');
    //     } else {

    //         $Exists = $this->KerjasamaModel->where('date', $date)->where('time', $time)->where('id', $id)->first();
    //         if ($Exists) {
    //             // Jika resep sudah ada, berikan pesan kesalahan
    //             session()->setFlashdata('error', 'You have already register therapy at the same time and date');
    //             return redirect()->to('therapy_step_2/');
    //         } else {
    //             //jika valid
    //             $this->KerjasamaModel->save([
    //                 'id' => $id,
    //                 'date' => $date,
    //                 'time' => $time,
    //                 'first_name' => $first_name,
    //                 'last_name' => $last_name,
    //                 'phone' => $phone,
    //                 'email' => $email,

    //             ]);
    //         }
    //         return redirect()->to('/therapy_step_3');
    //     }
    // }

    // public function therapy_step_3()
    // {
    //     $date = session()->get('date_');
    //     $time = session()->get('time_');

    //     $data = [
    //         'title' => 'Therapy Step 3',
    //         'menu' => 'article',
    //         'date' => $date,
    //         'time' => $time,
    //     ];
    //     return view('user/therapyStep3', $data);
    // }

}
