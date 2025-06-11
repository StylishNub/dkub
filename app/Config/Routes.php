<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->setAutoRoute(false); // atau false jika kamu definisikan semua route manual
$routes->get('error/unauthorized', 'Error::unauthorized');
$routes->get('error/forbidden', 'Error::forbidden');
$routes->get('/register', 'Auth::register');
$routes->post('/auth/save_register', 'Auth::save_register');


$routes->get('/', 'User::index');
$routes->post('/submit-survey', 'User::submitSurvey'); 
$routes->get('/sejarah', 'User::sejarah');
$routes->get('/visimisi', 'User::visimisi');
$routes->get('/organisasi', 'User::organisasi');
$routes->get('/sdm', 'User::sdm');
$routes->get('/progja', 'User::progja');
$routes->get('/kerjasama', 'User::kerjasama');
$routes->get('/mou', 'User::mou');
$routes->get('/pks', 'User::pks');
$routes->get('/evaluasi', 'User::evaluasi');
$routes->get('/sop', 'User::sop');
$routes->get('/pertor', 'User::pertor');
$routes->get('/detail_artikel/(:segment)','User::detail_artikel/$1');

$routes->get('/login', 'Auth::login');
$routes->post('/auth/cek_login', 'Auth::cek_login');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard', 'Admin::index');
// hero section
$routes->get('/hero_content', 'Admin::hero_content');
$routes->get('/hero_content/tambah_hero', 'Admin::tambah_hero');
$routes->post('/tambah_hero/save_hero', 'Admin::save_hero');
$routes->get('/hero_content/edit_hero/(:segment)','Admin::edit_hero/$1');
$routes->post('/edit_hero/save_editHero', 'Admin::save_editHero');
$routes->get('/hero_content/delete_hero/(:segment)','Admin::delete_hero/$1');

// Mou section
$routes->get('/kelola_kerjasama', 'Admin::kelola_kerjasama');
$routes->get('/kelola_kerjasama/tambah_mou', 'Admin::tambah_mou');
$routes->post('/tambah_mou/save_mou', 'Admin::save_mou');
$routes->get('/kelola_kerjasama/edit_kerjasama/(:segment)','Admin::edit_kerjasama/$1');
$routes->post('/edit_kerjasama/save_editMou', 'Admin::save_editMou');

// Gambar section
$routes->get('/kelola_gambar', 'Admin::kelola_gambar');
$routes->get('/kelola_gambar/tambah_gambar', 'Admin::tambah_gambar');
$routes->post('/tambah_gambar/save_gambar', 'Admin::save_gambar');
$routes->get('/kelola_gambar/edit_gambar/(:segment)','Admin::edit_gambar/$1');
$routes->post('/edit_gambar/save_editGambar', 'Admin::save_editGambar');
$routes->get('/manajemen_artikel/delete_artikel/(:segment)','Admin::delete_artikel/$1');

//SDM section
$routes->get('/kelola_sdm', 'Admin::kelola_sdm');
$routes->get('/kelola_sdm/tambah_sdm', 'Admin::tambah_sdm');
$routes->post('/tambah_sdm/save_sdm', 'Admin::save_sdm');
$routes->get('/kelola_sdm/edit_sdm/(:segment)','Admin::edit_sdm/$1');
$routes->post('/edit_sdm/save_editSdm', 'Admin::save_editSdm');

// Jabatan Section
$routes->get('/kelola_jabatan', 'Admin::kelola_jabatan');
$routes->get('/kelola_jabatan/tambah_jabatan', 'Admin::tambah_jabatan');
$routes->post('/tambah_jabatan/save_jabatan', 'Admin::save_jabatan');
$routes->get('/kelola_jabatan/edit_jabatan/(:segment)','Admin::edit_jabatan/$1');
$routes->post('/edit_jabatan/save_editJabatan', 'Admin::save_editJabatan');


// Profil Section
$routes->get('/kelola_profil', 'Admin::kelola_profil');
$routes->get('/kelola_profil/tambah_profil', 'Admin::tambah_profil');
$routes->post('/tambah_profil/save_profil', 'Admin::save_profil');
$routes->get('/kelola_profil/edit_profil/(:segment)','Admin::edit_profil/$1');
$routes->post('/edit_profil/save_editProfil', 'Admin::save_editProfil');

// Profil Section
$routes->get('/kelola_progja', 'Admin::kelola_progja');
$routes->get('/kelola_progja/tambah_progja', 'Admin::tambah_progja');
$routes->post('/tambah_progja/save_progja', 'Admin::save_progja');
$routes->get('/kelola_progja/edit_progja/(:segment)','Admin::edit_progja/$1');
$routes->post('/edit_progja/save_editProgja', 'Admin::save_editProgja');

// Statistik MoU
$routes->get('/statistik_mou', 'Admin::statistik_mou');

// Jaminan Mutu Section
$routes->get('/jaminan_mutu', 'Admin::jaminan_mutu');
$routes->get('/jaminan_mutu/tambah_jaminan_mutu', 'Admin::tambah_jaminan_mutu');
$routes->post('/tambah_jaminan_mutu/save_jaminan_mutu', 'Admin::save_jaminan_mutu');
$routes->get('/jaminan_mutu/edit_jaminanMutu/(:segment)','Admin::edit_jaminanMutu/$1');
$routes->post('/edit_jaminanMutu/save_editJaminanMutu', 'Admin::save_editJaminanMutu');

// Berita Section
$routes->get('/kelola_berita', 'Admin::kelola_berita');
$routes->get('/kelola_berita/tambah_berita', 'Admin::tambah_berita');
$routes->post('/tambah_berita/save_berita', 'Admin::save_berita');
$routes->get('/kelola_berita/edit_berita/(:segment)','Admin::edit_berita/$1');
$routes->post('/edit_berita/save_editBerita', 'Admin::save_editBerita');

//Kategori Berita Section
$routes->get('/kelola_kategori_berita', 'Admin::kelola_kategori_berita');
$routes->get('/kelola_kategori_berita/tambah_kategori_berita', 'Admin::tambah_kategori_berita');
$routes->post('/tambah_kategori_berita/save_kategori_berita', 'Admin::save_kategori_berita');
$routes->get('/kelola_kategori_berita/edit_kategoriBerita/(:segment)','Admin::edit_kategoriBerita/$1');
$routes->post('/edit_kategoriBerita/save_editKategoriBerita', 'Admin::save_editKategoriBerita');

//Dokumen Section
$routes->get('/kelola_dokumen', 'Admin::kelola_dokumen');
$routes->get('/kelola_dokumen/tambah_dokumen', 'Admin::tambah_dokumen');
$routes->post('/tambah_dokumen/save_dokumen', 'Admin::save_dokumen');
$routes->get('/kelola_dokumen/edit_dokumen/(:segment)','Admin::edit_dokumen/$1');
$routes->post('/edit_dokumen/save_editDokumen', 'Admin::save_editDokumen');

//Pengaduan Section
$routes->get('/kelola_pengaduan', 'Admin::kelola_pengaduan');
$routes->get('/kelola_pengaduan/balas/(:segment)', 'Admin::balas/$1'); 
$routes->post('/kelola_pengaduan/balas/(:segment)', 'Admin::balas/$1');

//Penjaduan Section
// Route to view and manage pengajuan
// Route untuk halaman kelola pengajuan
$routes->get('/kelola_pengajuan', 'Admin::kelola_pengajuan');

// Route untuk menangani POST request untuk update status (surat atau dokumen)
$routes->post('kelola_pengajuan/update_status/(:num)/(:segment)/(:segment)', 'Admin::update_status/$1/$2/$3');

// Route untuk melihat detail pengajuan berdasarkan ID
$routes->get('kelola_pengajuan/detail_pengajuan/(:num)', 'Admin::detail_pengajuan/$1');
// DELETE routes per modul
$routes->get('/kelola_kerjasama/delete_kerjasama/(:segment)', 'Admin::delete_kerjasama/$1');
$routes->get('/kelola_gambar/delete_gambar/(:segment)', 'Admin::delete_gambar/$1');
$routes->get('/kelola_sdm/delete_sdm/(:segment)', 'Admin::delete_sdm/$1');
$routes->get('/kelola_jabatan/delete_jabatan/(:segment)', 'Admin::delete_jabatan/$1');
$routes->get('/kelola_profil/delete_profil/(:segment)', 'Admin::delete_profil/$1');
$routes->get('/kelola_progja/delete_progja/(:segment)', 'Admin::delete_progja/$1');
$routes->get('/jaminan_mutu/delete_jaminanmutu/(:segment)', 'Admin::delete_jaminanmutu/$1');
$routes->get('/kelola_berita/delete_berita/(:segment)', 'Admin::delete_berita/$1');
$routes->get('/kelola_kategori_berita/delete_kategori_berita/(:segment)', 'Admin::delete_kategori_berita/$1');
$routes->get('/kelola_dokumen/delete_dokumen/(:segment)', 'Admin::delete_dokumen/$1');
$routes->get('/kelola_pengaduan/delete_pengaduan/(:segment)', 'Admin::delete_pengaduan/$1');
$routes->get('/kelola_pengajuan/delete_pengajuan/(:segment)', 'Admin::delete_pengajuan/$1');


$routes->get('/berita', 'User::berita');
$routes->get('/berita/detail_berita/(:num)', 'User::detail_berita/$1');


//Section User
$routes->get('/kelola_user', 'Admin::kelola_user');
$routes->get('/kelola_user/approve/(:num)', 'Admin::approve_user/$1');
$routes->get('/kelola_user/reject/(:num)', 'Admin::reject_user/$1');

$routes->get('/user_home', 'UserLogin::user_home');
$routes->get('/dinas', 'User::dinas');
$routes->get('/view_pengajuan', 'UserLogin::view_pengajuan');
$routes->get('/view_pengajuan/tambah_kerjasama', 'UserLogin::tambah_kerjasama');
$routes->post('tambah_kerjasama/save_pengajuan', 'UserLogin::save_pengajuan');

$routes->get('/view_pengajuan/delete_pengajuanUser/(:segment)', 'UserLogin::delete_pengajuanUser/$1');