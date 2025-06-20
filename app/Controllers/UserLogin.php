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



class UserLogin extends BaseUserController
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
        parent::__construct();
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
        
    }

    public function user_home()
    {
        // Ambil ID pengguna yang login (misalnya dari session)
        $userId = session()->get('id');  // Sesuaikan dengan nama session yang Anda gunakan

        // Inisialisasi model UserModel
        $UserModel = new UserModel();

        // Ambil data pengguna berdasarkan ID
        $user = $UserModel->find($userId); // Menemukan satu pengguna berdasarkan ID

        // Pastikan ada data pengguna
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        // Kirim data pengguna ke view
        $data = [
            'title' => 'User Dashboard',
            'menu' => 'user_home',
            'user' => $user  // Mengirimkan data pengguna yang ditemukan ke view
        ];

        return view('user/userDashboard', $data);
    }

    public function view_pengajuan()
    {

        $userId = session()->get('id');
        $pengajuanData = $this->PengajuanModel->getUserPengajuan($userId);
        
        
        $data = [
            'title' => 'Pengajuan Kerjasama',
            'menu' => 'pengajuan_kerjasama',
            'pengajuan' => $pengajuanData,
            'user' => $this->UserModel->find($userId)
        ];
        
        return view('user/viewPengajuan', $data);
    }

    public function tambah_kerjasama()
    {
        $user = $this->UserModel->find(session()->get('id'));
        $data = [
            'title' => 'Pengajuan Kerjasama',
            'menu' => 'pengajuan_kerjasama',
            'user' => $user
        ];
        return view('user/pengajuanKerjasama', $data);
    }

    public function save_pengajuan()
    {
        $userId = session()->get('id');
    
        // Validasi form
        if (!$this->validate([
            'email_pic_mitra' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email PIC Mitra wajib diisi!',
                    'valid_email' => 'Email PIC Mitra tidak valid!'
                ]
            ],
            'nama_instansi_mitra' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Instansi Mitra wajib diisi!'
                ]
            ],
            'no_telp_mitra' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor telepon Mitra wajib diisi!'
                ]
            ],
            'bidang_kerjasama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang kerjasama wajib diisi!'
                ]
            ],
            'file_surat_permohonan' => [
                'rules' => 'uploaded[file_surat_permohonan]|max_size[file_surat_permohonan,2048]|mime_in[file_surat_permohonan,application/pdf]',
                'errors' => [
                    'uploaded' => 'Surat permohonan wajib diupload!',
                    'max_size' => 'Ukuran file terlalu besar, maksimal 2MB!',
                    'mime_in' => 'File harus berupa PDF!'
                ]
            ],
            'draft_permintaan_dokumen' => [
                'rules' => 'uploaded[draft_permintaan_dokumen]|max_size[draft_permintaan_dokumen,2048]|mime_in[draft_permintaan_dokumen,application/pdf]',
                'errors' => [
                    'uploaded' => 'Draft permintaan dokumen wajib diupload!',
                    'max_size' => 'Ukuran file terlalu besar, maksimal 2MB!',
                    'mime_in' => 'File harus berupa PDF!'
                ]
            ]
        ])) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('/view_pengajuan/tambah_kerjasama')->withInput();
        }
    
        // Upload file
        $fileSurat = $this->request->getFile('file_surat_permohonan');
        $namaSurat = $fileSurat->getRandomName();
        $fileSurat->move('uploads/dokumen', $namaSurat);
    
        $fileDraft = $this->request->getFile('draft_permintaan_dokumen');
        $namaDraft = $fileDraft->getRandomName();
        $fileDraft->move('uploads/dokumen', $namaDraft);
    
        // Ambil data kegiatan, cek jika pilih 'Lainnya'
        $rencana_kegiatan = $this->request->getVar('rencana_kegiatan');
        if ($rencana_kegiatan === 'Lainnya') {
            $rencana_kegiatan = $this->request->getVar('rencana_kegiatan_lain');
        }
    
        $kategori_kegiatan = $this->request->getVar('kategori_kegiatan');
        if ($kategori_kegiatan === 'Lainnya') {
            $kategori_kegiatan = $this->request->getVar('kategori_kegiatan_lain');
        }
    
        // Simpan ke DB
        $this->PengajuanModel->save([
            'nama_instansi_mitra' => $this->request->getVar('nama_instansi_mitra'),
            'nama_pic_mitra' => $this->request->getVar('nama_pic_mitra'),
            'email_pic_mitra' => $this->request->getVar('email_pic_mitra'),
            'no_telp_mitra' => $this->request->getVar('no_telp_mitra'),
            'bidang_kerjasama' => $this->request->getVar('bidang_kerjasama'),
            'surat_permohonan' => $namaSurat,
            'draft_permintaan_dokumen' => $namaDraft,
            'status_surat' => 'Menunggu',
            'status_dokumen' => 'Menunggu',
            'rencana_kegiatan' => $rencana_kegiatan,
            'deskripsi_kegiatan' => $this->request->getVar('deskripsi_kegiatan'),
            'durasi' => $this->request->getVar('durasi'),
            'kategori_kegiatan' => $kategori_kegiatan,
            'user_id' => $userId
        ]);
    
        return redirect()->to('/view_pengajuan')->with('success', 'Pengajuan berhasil dikirim.');
    }

    public function lihat_detailPengajuan($id)
{
    // Mengambil pengajuan berdasarkan ID
    $pengajuan = $this->PengajuanModel->find($id);
    
    // Jika pengajuan tidak ditemukan, tampilkan halaman error atau redirect
    if (!$pengajuan) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Pengajuan dengan ID $id tidak ditemukan.");
    }
    
    $user = $this->UserModel->find($pengajuan['user_id']);
    // Mengirimkan data ke view
    $data = [
        'title' => 'Detail Pengajuan User',
        'menu' => 'pengajuan_kerjasama',
        'pengajuan' => $pengajuan,  // Mengirimkan satu pengajuan berdasarkan ID
        'user' => $user,  // Mengirimkan satu pengajuan berdasarkan ID
    ];

    return view('user/lihatDetailPengajuan', $data);
}

    
    public function delete_pengajuanUser($id = false)
    {
        if (!$id || !$this->PengajuanModel->find($id)) {
            return redirect()->to('/view_pengajuan')->with('error', 'Data tidak ditemukan.');
        }
    
        $this->PengajuanModel->delete($id);
        return redirect()->to('/view_pengajuan')->with('success', 'Data pengajuan berhasil dihapus.');
    }    

}