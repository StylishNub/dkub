-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2025 at 12:53 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dk`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi_berita` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `publish_date` datetime NOT NULL,
  `id_kategori_berita` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi_berita`, `gambar`, `publish_date`, `id_kategori_berita`, `id_user`) VALUES
(3, 'Universitas Yapis Papua Tingkatkan Mutu Pendidikan melalui Benchmarking Pascasarjana di Universitas Brawijaya', 'Malang, 10 Februari 2025 – Universitas Yapis Papua (Uniyap) terus berupaya meningkatkan mutu pendidikan tinggi melalui program Benchmarking Pascasarjana 2025 di Universitas Brawijaya (UB) Malang. Program ini bertujuan untuk memperdalam pemahaman terkait sistem akademik, manajemen pendidikan, serta penerapan kurikulum berbasis Outcome-Based Education (OBE) yang telah sukses diterapkan di UB.\r\n\r\nDalam kegiatan ini, delegasi Uniyap mengikuti serangkaian diskusi akademik dengan para pemangku kepentingan UB, meninjau fasilitas kampus, serta melakukan penandatanganan Memorandum of Understanding (MoU) untuk mempererat kerja sama antar kedua institusi. Salah satu aspek utama yang dibahas adalah implementasi program Fast Track S1-S2 yang memungkinkan mahasiswa menyelesaikan studi dalam waktu lebih singkat dengan tetap mempertahankan kualitas pendidikan yang optimal.\r\n\r\nRektor Uniyap, Dr. Ir. Didik Suryamiharja S. Mabui, ST., M.T., IPM, didampingi oleh Direktur Pascasarjana Dr. Muh Yamin Noch, S.E., M.SA, serta tim akademik lainnya, turut hadir untuk menjalin sinergi dengan Universitas Brawijaya. Dari pihak UB, hadir Prof. Andi Kurniawan S.Pi., M.Eng. D.Sc selaku Wakil Rektor IV, Dr. ROSIHAN ASMARA, S.E., M.P. selaku Direktur Direktorat Administrasi dan Layanan Akademik, dan PM. Erza Killian, Ph.D selaku Sekretaris Direktorat Kerja Sama, serta turut hadir Wakil Dekan Bidang Akademik Sekolah Sascasarjana UB dan Wakil Dekan Bidang Akademik Fakultas Ekonomi Bisnis UB. Kehadiran para pimpinan akademik ini memperkuat kolaborasi dalam upaya pengembangan pendidikan tinggi yang lebih inovatif dan berdaya saing.\r\n\r\nMelalui benchmarking ini, Universitas Yapis Papua berharap dapat mengadopsi strategi terbaik dari UB untuk diterapkan dalam sistem akademik mereka. Fokus utama dalam studi tiru ini mencakup pengembangan kurikulum berbasis industri, pemanfaatan teknologi dalam pembelajaran, serta peningkatan layanan akademik bagi mahasiswa.\r\n\r\nDiharapkan, kerja sama strategis ini dapat mendorong peningkatan kualitas pendidikan di Uniyap, mencetak lulusan yang lebih kompetitif, serta berkontribusi dalam pengembangan sumber daya manusia yang unggul di Indonesia.', '1749281088_d5031848972f2e47366e.jpeg', '2025-06-07 07:24:48', 3, 1),
(4, 'Kerjasama antara ITERA dan UB untuk Tridarma & Mahasiswa', 'Kerja sama antara ITERA dan UB semakin erat untuk mendukung tridarma perguruan tinggi, riset, serta pertukaran mahasiswa. Kolaborasi ini tidak hanya memperkuat pendidikan tinggi Indonesia tetapi juga membangun hubungan akademik antara ITERA dan UB. Pada 5 November 2024, Rektor ITERA, Prof. Dr. I Nyoman Pugeg Aryantha, dan Rektor UB, Prof. Widodo, S.Si., M.Si., Ph.D.Med.Sc., menandatangani Nota Kesepahaman (MoU) dan Perjanjian Kerja Sama (PKS) di Kampus ITERA, Lampung.\r\n\r\nWakil Rektor Bidang Akademik dan Kemahasiswaan ITERA, Prof. Dr.Eng. Khairurrijal, M.Si., dan Wakil Rektor Bidang Keuangan dan Umum, Dr. Rahayu Sulistyorini, S.T., M.T., turut hadir bersama para dekan fakultas dari kedua kampus. Melalui sinergi ini, ITERA dan UB berharap dapat meningkatkan kolaborasi di bidang riset, inovasi, dan kontribusi sosial.\r\n\r\nDalam sambutannya, Prof. I Nyoman Pugeg Aryantha mengungkapkan rasa syukur atas kemitraan strategis antara ITERA dan UB. “Seiring usia ITERA yang telah mencapai satu dekade, kami berharap dapat terus berkontribusi positif bagi bangsa. UB merupakan mitra strategis yang dapat bersama-sama mengembangkan potensi akademik dan riset kami,” ujarnya.\r\n\r\nRektor UB, Prof. Widodo, juga menyatakan komitmennya untuk melanjutkan kolaborasi ini dan mengapresiasi sambutan hangat dari ITERA. “Kami sangat antusias untuk bekerja sama dengan ITERA, khususnya di bidang riset dan inovasi. Sinergi ini membuka peluang kedua kampus untuk saling berbagi ilmu dan talenta demi kemajuan bersama,” ungkap Prof. Widodo.\r\n\r\nProf. Widodo menambahkan bahwa UB memberikan kesempatan bagi mahasiswa ITERA untuk belajar di UB, begitu pula sebaliknya. “Kami berharap pertukaran mahasiswa ini membawa dampak positif, tidak hanya bagi UB dan ITERA, tetapi juga bagi kemajuan pendidikan tinggi di Indonesia,” lanjut Prof. Widodo. Kerja sama ini juga mencakup program pengabdian kepada masyarakat untuk memperluas kontribusi kedua universitas kepada komunitas sekitar.\r\n\r\nAcara ditutup dengan penyerahan bibit tanaman secara simbolis dari Rektor UB kepada Rektor ITERA, sebagai bagian dari inisiatif “Alumni Menanam Pohon” yang diprakarsai oleh Forum Alumni Pengairan Ika UB. Rombongan UB juga meninjau Integrated Waste and Agro Center ITERA (IWACI) dan Kebun Raya ITERA, yang merupakan pusat inovasi dan pengelolaan lingkungan di ITERA.', '1749281657_27b77304f39968aad721.jpeg', '2025-06-07 07:34:17', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id` int(11) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `file_pdf` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `jenis_dokumen_id` int(11) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokumen`
--

INSERT INTO `dokumen` (`id`, `nama_dokumen`, `file_pdf`, `created_at`, `updated_at`, `jenis_dokumen_id`, `id_status`) VALUES
(1, 'MOU Dalam Negeri', '1749281714_1eec49e67fbf3c263610.pdf', '2025-05-14 09:14:18', '2025-05-14 09:14:18', 1, 1),
(5, 'MOU Dalam Negeri 1 Halaman', '1749281788_4554bcc30a163362215e.pdf', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1),
(6, 'MOU Luar Negeri', '1749281752_86a69497dc95139eb998.pdf', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1),
(7, 'PKS', '1749281989_20057e94033aaf532f25.pdf', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, 1),
(8, 'MOA', '1749282026_43f88b51024e3efa360c.pdf', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 1),
(9, 'SOP TELAAH PKS', '1749282091_1cdf78e30af91777bbff.pdf', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 5, 1),
(10, 'SOP Pengajuan MOU Dalam Negeri', '1749282127_ba291b684aca88f28364.pdf', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 5, 1),
(11, 'PERTOR I', '1749282357_8dcb9fdf1312fd13586f.pdf', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6, 1),
(12, 'Prospektus UB', '1747970746_13d6b971316950d67130.pdf', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 1),
(13, 'Implementation of Agreement', '1749281910_6f29878cc95ac9009623.pdf', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

CREATE TABLE `gambar` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gambar`
--

INSERT INTO `gambar` (`id`, `nama`, `kategori`, `gambar`, `status`, `id_status`) VALUES
(4, 'Susunan Organisasi', 'organisasi', '1747963685_cd2448fb28b8aa4f0078.png', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hero_content`
--

CREATE TABLE `hero_content` (
  `id` int(11) NOT NULL,
  `hero_title` varchar(255) DEFAULT NULL,
  `hero_description` text DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hero_content`
--

INSERT INTO `hero_content` (`id`, `hero_title`, `hero_description`, `hero_image`, `created_at`, `updated_at`) VALUES
(10, 'Selamat Datang Di Website', 'Direktorat Kerjasama Universitas Brawijaya', '1749276684_a8b3af3e9f96ec6726be.jpeg', '2025-06-07 13:11:24', '2025-06-07 13:11:24'),
(12, 'Kunjungan Kerjasama', 'Universiti Sains Malaysia', '1749276900_0b9d0f720d5c7315dafd.jpeg', '2025-06-07 13:15:00', '2025-06-07 13:15:00'),
(13, 'Penandatanganan MOU', 'Kepolisian Republik Indonesia', '1749277040_ee2686f12c2bcca602bd.jpeg', '2025-06-07 13:17:20', '2025-06-07 13:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `tupoksi_jabatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `tupoksi_jabatan`) VALUES
(3, 'Direktur Direktorat Kerjasama', '- melaksanakan dan mengembangkan program kerja sama;\r\n- mengevaluasi dan melaporkan kinerja hasil program kerja;\r\n- melakukan telaah terhadap nota kesepahaman dan bentuk perjanjian lain;\r\n- menginisiasi dan mengoordinasikan program prioritas dalam peningkatan keterlibatan UB di dunia internasional;\r\n- mengelola dan mengembangkan sistem informasi kerjasama;\r\n- menyelenggarakan layanan prima sesuai dengan prinsip tata kelola perguruan tinggi yang baik.'),
(4, 'Sekretaris Direktorat Kerja Sama', '- koordinasi dan penyusunan rencana, program, dan anggaran;\r\n- mewakili direktur Direktorat apabila ditugaskan oleh direktur/pimpinan diatasnya;\r\n- pelaksanaan urusan kepegawaian di lingkungan Direktorat;\r\n- pelaksanaan urusan keuangan di lingkungan Direktorat;\r\n- pengelolaan barang milik UB atau milik negara di lingkungan Direktorat;\r\n- fasilitasi pelaksanaan penataan kelembagaan dan reformasi birokrasi, serta pemantauan, evaluasi, dan pelaporan Direktorat\r\n- pelaksanaan hubungan masyarakat dan tata usaha Direktorat.');

-- --------------------------------------------------------

--
-- Table structure for table `jaminan_mutu`
--

CREATE TABLE `jaminan_mutu` (
  `id` int(11) NOT NULL,
  `indikator` varchar(255) NOT NULL,
  `nilai` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jaminan_mutu`
--

INSERT INTO `jaminan_mutu` (`id`, `indikator`, `nilai`) VALUES
(1, 'Kesesuaian persyaratan pelayanan dengan jenis pelayanannya.', '3.9939'),
(4, 'Kemudahan prosedur layanan.', '3.9939'),
(5, 'Kecepatan waktu pelayanan.', '3.9816'),
(6, 'Kewajaran biaya/tarif dalam layanan. (jika ada biaya layanan)', '3.9632'),
(7, 'Kesesuaian produk layanan dengan hasil yang diberikan', '3.9877'),
(8, 'Kompetensi atau kemampuan petugas dalam memberikan pelayanan.', '3.9877');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_dokumen`
--

CREATE TABLE `jenis_dokumen` (
  `id` int(11) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_dokumen`
--

INSERT INTO `jenis_dokumen` (`id`, `jenis`, `keterangan`) VALUES
(1, 'MOU', 'draft MOU'),
(2, 'IA', 'IMple'),
(3, 'MOA', 'ln ni ges'),
(4, 'PKS', 'dn ni ges\r\n'),
(5, 'SOP', 'sop ayam'),
(6, 'Dokumen Hukum', 'YTTA'),
(7, 'Prospectus', 'entahlah apa ini');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_berita`
--

CREATE TABLE `kategori_berita` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_berita`
--

INSERT INTO `kategori_berita` (`id`, `nama`, `deskripsi`) VALUES
(3, 'Kerjasama', 'untuk mendefinisikan kerjasama\r\n'),
(4, 'Teknologi', 'segala sesuatu yang berhubungan dengan teknologi\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `mou`
--

CREATE TABLE `mou` (
  `id` int(11) NOT NULL,
  `nama_mitra` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jangka_waktu` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `file_pdf` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Aktif',
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mou`
--

INSERT INTO `mou` (`id`, `nama_mitra`, `tahun`, `jangka_waktu`, `tanggal_mulai`, `tanggal_berakhir`, `file_pdf`, `status`, `id_status`) VALUES
(60, 'UNIV TADULAKO', 2020, '5 TAHUN', '2020-01-06', '2025-01-06', NULL, '', 1),
(61, 'PEMERINTAH KABUPATEN POHUWATO', 2025, '5 TAHUN', '2025-01-10', '2030-01-09', NULL, 'Aktif', 1),
(62, 'PEMERINTAH DAERAH KABUPATEN GARUT', 2025, '5 TAHUN', '2025-01-09', '2030-01-08', NULL, 'Aktif', 1),
(63, 'PT. BRINGIN KARYA SEJAHTERA', 2025, '5 TAHUN', '2025-01-02', '2030-01-01', NULL, 'Aktif', 1),
(64, 'KEMENTERIAN KEPENDUDUKAN DAN PEMBANGUNAN KELUARGA/ BADAN KEPENDUDUKAN DAN KELUARGA BERENCANA NASIONAL', 2025, '5 TAHUN', '2025-01-13', '2030-01-12', NULL, 'Aktif', 1),
(65, 'ASIA COUNCIL FOR SMALL BUSINESS (ACSB) AREA MALANG RAYA', 2025, '5 TAHUN', '2025-01-16', '2030-01-15', NULL, 'Aktif', 1),
(66, 'RUMAH SAKIT UMUM PUSAT Dr. M. DJAMIL PADANG', 2024, '3 TAHUN', '2024-03-01', '2027-03-01', NULL, 'Aktif', 1),
(67, 'RUMAH SAKIT UMUM DAERAH KOTA MATARAM', 2024, '5 TAHUN', '2024-01-02', '2029-01-01', NULL, 'Aktif', 1),
(68, 'UNIVERSITAS BANGKA BELITUNG', 2024, '5 TAHUN', '2024-01-09', '2029-01-08', NULL, 'Aktif', 1),
(69, 'PEMERINTAH KABUPATEN MERANGIN', 2024, '5 TAHUN', '2024-01-11', '2029-01-10', NULL, 'Aktif', 1),
(70, 'PEMERINTAH KABUPATEN BARITO SELATAN', 2024, '5 TAHUN', '2024-01-16', '2029-01-15', NULL, 'Aktif', 1),
(71, 'PT SUPERINTENDING COMPANY OF INDONESIA (SUCOFINDO)', 2023, '2 TAHUN', '2023-01-05', '2025-01-04', NULL, 'Aktif', 1),
(72, 'INSTITUT TEKNOLOGI TELKOM SURABAYA', 2023, '3 TAHUN', '2023-01-02', '2026-01-01', NULL, 'Aktif', 1),
(73, 'UNIVERSITAS PENDIDIKAN MANDALIKA', 2023, '5 TAHUN', '2023-01-10', '2028-01-09', NULL, 'Aktif', 1),
(74, 'PEMERINTAH DAERAH KABUPATEN GARUT', 2023, '2 TAHUN', '2023-01-12', '2025-01-11', NULL, 'Aktif', 1),
(75, 'PT SEMEN INDONESIA (PERSERO)Tbk.', 2023, '5 TAHUN', '2023-01-13', '2028-01-12', NULL, 'Aktif', 1),
(76, 'INSTITUT BISNIS DAN TEKNOLOGI PELITA INDONESIA', 2022, '5 TAHUN', '2022-01-05', '2027-01-05', NULL, 'Aktif', 1),
(77, 'UNIVERSITAS PERJUANGAN TASIKMALAYA', 2022, '5 TAHUN', '2022-01-06', '2027-01-06', NULL, 'Aktif', 1),
(78, 'CHAROEN POKPHAND FOUNDATION', 2022, '5 TAHUN', '2022-01-10', '2027-01-10', NULL, 'Aktif', 1),
(79, 'PEMERINTAH KABUPATEN WAKATOBI', 2022, '5 TAHUN', '2022-01-12', '2027-01-12', NULL, 'Aktif', 1),
(80, 'BPOM', 2022, '5 TAHUN', '2022-04-14', '2027-04-14', NULL, 'Aktif', 1),
(81, 'PEMERINTAH KABUPATEN TULUNGAGUNG', 2021, '1 TAHUN', '2021-01-05', '2022-01-05', NULL, 'Aktif', 1),
(82, 'PEMERINTAH KABUPATEN MADIUN', 2021, '4 TAHUN', '2021-01-04', '2025-01-04', NULL, 'Aktif', 1),
(83, 'PEMERINTAH KABUPATEN BANGKALAN', 2021, '5 TAHUN', '2021-01-18', '2026-01-18', NULL, 'Aktif', 1),
(84, 'PEMKAB TULUNGAGUNG', 2020, '1 TAHUN', '2020-01-02', '2021-01-02', NULL, 'Aktif', 1),
(85, 'PEMKAB MESUJI', 2020, '2 TAHUN', '2020-01-06', '2022-01-06', NULL, 'Aktif', 1),
(86, 'UNIV TADULAKO', 2020, '5 TAHUN', '2020-01-06', '2025-01-06', NULL, 'Aktif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `instansi` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `pertanyaan` text NOT NULL,
  `bukti_upload` varchar(255) DEFAULT NULL,
  `balasan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `nama`, `instansi`, `email`, `no_hp`, `pertanyaan`, `bukti_upload`, `balasan`) VALUES
(10, 'admin', 'coba', 'dimas08012004@gmail.com', '081212121212', 'asdasda', '1747810831_b525b6a8923170559339.pdf', 'asdasdasdasd'),
(11, 'cuy mau nanya', 'asdasd', 'dimas08012004@gmail.com', '0812331223', 'apa ya bingung', '1747972619_2f3a04c7a625a44b465f.jpg', 'wadigidaw'),
(12, 'butar butar', 'malas', 'lernaean.rlz@gmail.com', '081369747089', 'infokan tempat tobat', NULL, 'reza mbg');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_kerjasama`
--

CREATE TABLE `pengajuan_kerjasama` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_instansi_mitra` varchar(255) NOT NULL,
  `nama_pic_mitra` varchar(255) NOT NULL,
  `email_pic_mitra` varchar(255) NOT NULL,
  `no_telp_mitra` int(20) NOT NULL,
  `bidang_kerjasama` varchar(255) NOT NULL,
  `surat_permohonan` varchar(255) NOT NULL,
  `draft_permintaan_dokumen` varchar(255) NOT NULL,
  `status_surat` varchar(255) DEFAULT 'Menunggu',
  `status_dokumen` varchar(255) DEFAULT 'Menunggu',
  `rencana_kegiatan` varchar(255) NOT NULL,
  `deskripsi_kegiatan` text NOT NULL,
  `durasi` varchar(255) NOT NULL,
  `kategori_kegiatan` varchar(255) NOT NULL,
  `alasan_ditolak` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajuan_kerjasama`
--

INSERT INTO `pengajuan_kerjasama` (`id`, `user_id`, `nama_instansi_mitra`, `nama_pic_mitra`, `email_pic_mitra`, `no_telp_mitra`, `bidang_kerjasama`, `surat_permohonan`, `draft_permintaan_dokumen`, `status_surat`, `status_dokumen`, `rencana_kegiatan`, `deskripsi_kegiatan`, `durasi`, `kategori_kegiatan`, `alasan_ditolak`, `created_at`, `updated_at`) VALUES
(17, 30, 'PT Indah Berkarya', 'Asep Zakaria', 'asepzakaria@gmail.com', 2147483647, 'Dalam Negeri', '1749702175_e49e24b14d0ff783de4e.pdf', '1749702175_9dc70ff28ec66d5ed66d.pdf', 'Disetujui', 'Selesai', 'Pelatihan Dosen dan Instruktur', 'hurmmm ya begitulah', '2 tahun', 'Expo/Pameran', '', '2025-06-12 04:22:56', '2025-06-12 05:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `sejarah` text NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `tujuan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id`, `sejarah`, `visi`, `misi`, `tujuan`) VALUES
(1, 'Keberadaan Universitas Brawijaya didirikan atas jalinan kerja sama yang baik antara birokrat, tokoh masyarakat dan pengusaha-pengusaha di sekitar Malang. Pada awalnya kerja sama tersebut dalam rangka membangun Universitas Brawijaya secara fisik dan bantuan dalam proses pendidikan. Kemudian pada masa selanjutnya mengarah pada berbagai kegiatan yang saling menguntungkan masing-masing pihak. Hal ini dilakukan baik dengan instansi pemerintah lokal, regional, maupun pusat. Jalinan kerja sama ini bahkan berkembang hingga mencakup berbagai lembaga asing/luar negeri. Kerja sama luar negeri diawali dengan perguruan tinggi Australia pada tahun 1970-an melalui Program Asian-Australian Universities Coorperation Scheme (AAUCS), melalui kegiatan short course dan pengiriman dosen baik untuk jangka pendek maupun jangka panjang ke Australia. Di bidang penelitian kerja sama diawali dengan Cassava Research Project yang disponsori oleh International Development Research Centre (IDRC) Canada pada tahun 1975. \r\n\r\nSejak tahun 1976 kerja sama luar negeri dikembangkan dengan Wageningen Agricultural University (WAU) melalui proyek Netherlands Universities Foundation For International Cooperation (NUFFIC) dengan tujuan utama peningkatan kualitas proses belajar-mengajar. Pada saat itu, aktivitas kerja sama luar negeri dikoordinasikan oleh Direktur Penelitian dan Afiliasi. Selanjutnya, koordinasi kerja sama luar negeri dilakukan oleh seorang koordinator sebagai staf khusus Pembantu Rektor I (Bidang Akademik, Penelitian, dan Pengabdian Masyarakat). Berdasarkan Keputusan Menteri Pendidikan dan Kebudayaan Republik Indonesia Nomor 0197/0/1995 tentang Organisasi dan Tata Kerja Universitas Brawijaya, pengelolaan bidang kerja sama merupakan tanggung jawab Pembantu Rektor I dan Biro Administrasi Akademik dan Kemahasiswaan. Seiring dengan perkembangan organisasi Universitas Brawijaya dan dengan dilantiknya Pembantu Rektor IV, maka pada tahun 2002 sampai dengan tahun 2006 pengelolaan bidang kerja sama menjadi tanggung jawab Pembantu Rektor IV Bidang Perencanaan dan Kerja sama dan Biro Administrasi Perencanaan dan Sistem Informasi. Sejak tahun 2006 sesuai kebutuhan organisasi dan restrukturisasi pada waktu itu, maka jabatan Pembantu Rektor IV ditiadakan, sehingga pengelolaan kerja sama dibawah Biro Administrasi Perencanaan dan Sistem Informasi kembali dibawah tanggung jawab Pembantu Rektor I Bidang Akademik dan Kerja Sama. Dengan semakin meningkatnya jejaring kerja sama baik lingkup nasional maupun internasional, dan dengan ditetapkannya Universitas Brawijaya instansi pemerintah yang menerapkan pengelolaan keuangan badan layanan umum (PK-BLU) dari Kementerian Keuangan, maka pada tanggal pada tanggal 21 Februari 2012 terjadi perubahan struktur organisasi dan dibentuknya Bagian Kerja sama sebagai unsur pelaksana administrasi yang bertugas mengelola dan mengembangkan kerja sama secara optimal dengan dasar hukum Keputusan Rektor Nomor 091/SK/2012. \r\n\r\nSecara struktural, Bagian Kerja sama dipimpin oleh seorang Kepala Bagian berada di bawah koordinasi Biro Administrasi Akademik dan Kerja Sama serta Pembantu Rektor I Bidang Akademik dan Kerja Sama, dimana pada saat itu kerja sama terbagi menjadi 2 (dua) subbagian yakni Subbagian Kerjasama Dalam Negeri dan Subbagian Kerjasama Luar Negeri. Pada tahun 2016 Universitas Brawijaya melakukan perubahan Organisasi dan Tata Kerja dengan ditetapkannya Peraturan Rektor Nomor 20 Tahun 2016 tentang Susunan Organisasi dan Tata Kerja yang disahkan pada 14 April 2016, dalam Peraturan tersebut Susunan Wakil Rektor terbagi Kembali menjadi 4 (empat) Wakil Rektor, yang diantaranya adalah Wakil Rektor Bidang Perencanaan dan Kerja Sama, yang membawahkan Biro Akademik dan Kemahasiswan, sejak perubahan bagian kerjasama bertransformasi menjadi Bagian Perencanaan, Akademik, dan Kerjasama yang berada di bawah Biro Akademik dan Kemahasiswaan, dimana subbagian Kerjasama yang awalnya terbagi menjadi 2 (dua) subbagian digabung menjadi satu menjadi Subbagian Kerjasama. Pada Tahun 2020 Universitas Brawijaya Kembali melakukan perubahan Susunan Organisasi dan Tata Kerja dengan disahkannya Peraturan Rektor Nomor 25 Tahun 2020 tentang Susunan Organisasi dan Tata Kerja pada 26 Mei 2020 pada saat perubahan organisasi tersebut Subbagian Kerja Sama tidak mengalami perubahan susunan ataupun nomenklatur. Pada tahun 2021 Universitas Brawijaya secara resmi berubah status dari Perguruan Tinggi BLU menjadi Perguruan Tinggi Negeri Berbadan Hukum yang dikukuhkan melalui Peraturan Pemerintah Nomor 108 Tahun 2021 tentang Perguruan Tinggi Negeri Badan Hukum Universitas Brawijaya. Sejak disahkannya Peraturan Pemerintah tentang Status PTNBH Universitas Brawijaya, telah dilakukan beberapa kali perubahan susunan organisasi dan tata kerja Universitas Brawijaya, yang pertama dengan Peraturan Rektor Nomor 30 Tahun 2021 tentang Organisasi dan Tata Kerja Unsur yang Berada di Bawah Rektor yang disahkan pada 23 November 2021, dimana nomenklatur Wakil Rektor 4 berubah menjadi Wakil Rektor bidang Perencanaan, Kerja Sama, dan Internasionalisasi, nomenklatur Bagian Kerja Sama berubah menjadi Direktorat Kerja Sama dan Internasionalisasi, dan nomenklatur Subbagian Kerja Sama berubah menjadi Subdirektorat Kerja Sama Dalam Negeri. Pada tahun yang sama Subdirektorat Kerjas Sama Dalam Negeri berubah menjadi Pusat Kerja Sama dengan disahkannya Peraturan Rektor Nomor 93 Tahun 2021 tentang Organisasi dan Tata Kerja Unsur yang Berada di Bawah Rektor pada 28 Desember 2021. Di bawah pengelolaan Wakil Rektor bidang Perencanaan, Kerja Sama, dan Internasionalisasi bersama Direktorat Perencanaan, Direktorat Kerja Sama dan Internasionalisasi melalui Pusat Kerja Sama berusaha untuk menjalin kerja sama dengan mitra-mitra potensial melalui pengelolaan sistem kerja sama yang lebih dinamis dan berhasil memperoleh dua penghargaan di liga PTNBH sebagai Silver Winner dalam Sub Kategori Kerja Sama dengan Industri Terbaik dan Sub Kategori Pelaporan Kerja Sama (LAPKERMA terbaik) dalam ANUGERAH DIKTIRISTEK 2022 KEMENDIKBUDRISTEK yang disahkan dengan Keputusan Direktur Jenderal Pendidikan Tinggi, Riset, Dan Teknologi Kementerian Pendidikan, Kebudayaan, Riset, Dan Teknologi Republik Indonesia Nomor 216/E/KPT/2022 tentang Penerima Anugerah Kerja Sama Di Lingkungan Direktorat Jenderal Pendidikan Tinggi, Riset, Dan Teknologi Tahun 2022. \r\nPada tahun 2023 berdasarkan Peraturan Rektor Universitas Brawijaya Nomor 12 Tahun 2023 Tentang Organisasi dan Tata Kerja Unsur Yang Berada Di Bawah Rektor pada Pasal 41 dijelaskan bahwa Kerjasama Universitas Brawijaya dibawah naungan Wakil Rektor Bidang Bidang Perencanaan, Kerja Sama, Dan Internasionalisasi, pada Direktorat Kerja Sama dan Internasionalisasi Sub Direktorat Kerja Sama dengan tugas utama sebagai berikut: (1) Direktorat Kerja Sama dan Internasionalisasi mempunyai tugas: melaksanakan dan mengembangkan program kerja sama dalam negeri dan luar negeri; mengevaluasi dan melaporkan kinerja hasil program kerja; dan menyelenggarakan layanan prima sesuai dengan prinsip tata kelola perguruan tinggi yang baik. (2) Dalam melaksanakan tugas sebagaimana dimaksud pada ayat (1), Direktorat Kerja Sama dan Internasionalisasi memiliki fungsi: perencanaan, pengembangan, dan pelaksanaan kerja sama dalam negeri dan luar negeri; dan pengembangan dan pelayanan international office. (3) Direktorat Kerja Sama dan Internasionalisasi membawahkan: Subdirektorat Kerja Sama; Subdirektorat International Office; dan Kelompok Jabatan Fungsional. (4) Subdirektorat Kerja Sama sebagaimana dimaksud pada ayat (3) huruf a mempunyai tugas melaksanakan kebijakan, program, dan kegiatan perencanaan, pengembangan, dan pelaksanaan kerja sama dalam negeri dan luar negeri. (5) Subdirektorat International Office sebagaimana dimaksud pada ayat (3) huruf b mempunyai tugas melaksanakan kebijakan, program, dan kegiatan pengembangan dan pelayanan international office. (6) Kelompok Jabatan Fungsional sebagaimana dimaksud pada ayat ayat (3) huruf c terdiri atas sejumlah tenaga fungsional Dosen dan/atau pejabat fungsional lainnya.', 'Menjadi universitas unggul yang berstandar internasional dan mampu berperan aktif dalam pembangunan bangsa melalui proses pendidikan, penelitian dan pengabdian kepada masyarakat.', 'Menyelenggarakan pendidikan berstandar internasional agar peserta didik menjadi manusia yang berkemampuan akademik dan atau profesi atau vokasi yang berkualitas dan berkepribadian serta berjiwa dan/atau berkemampuan entrepreneur\r\nMelakukan pengembangan dan penyebarluasan ilmu pengetahuan, teknologi, humaniora dan seni, serta mengupayakan penggunaanya untuk meningkatkan taraf kehidupan masyarakat dan memperkaya kebudayaan nasional', 'Menghasilkan sumberdaya manusia yang berkualitas, bertaqwa kepada Tuhan Yang Maha Esa, mampu membelajarkan diri, memiliki wawasan yang luas memiliki disiplin dan etos kerja, sehingga menjadi tenaga akademis dan professional yang tangguh dan mampu bersaing di tingkat internasional\r\nMengembangkan ilmu pengetahuan, teknologi, dan seni guna mendorong pengembangan budaya\r\nMembantu pemberdayaan masyarakat melalui penerapan ilmu pengetahuan dan teknologi\r\nMaka sebagai salah satu upaya untuk mencapai hal-hal tersebut, Bagian Kerjasama Universitas Brawijaya dapat mengembangkan pengelolaan kerjasama dengan pihak lainnya atau bekerjasama dengan pihak ketiga didasarkan pada pertimbangan efisiensi dan efektivitas pelayanan publik, sinergi, dan saling menguntungkan. Data yang ada menunjukkan bahwa Universitas Brawijaya telah banyak melakukan kerjasama baik antar Perguruan Tinggi Negeri/Swasta dengan Pemerintah Pusat/Daerah, Perguruan Tinggi luar negeri yang kegiatannya sangat beragam sesuai dengan kebutuhan dan potensi Perguruan Tinggi. Diperlukan sistem pengolahan yang tepat di bagian kerjasama agar manfaat yang bisa diambil dari pelaksanaan kerjasama itu adalah dapat saling mengisi dan melengkapi, bersinergi dan tumbuh secara seimbang, serasi dan mampu memecahkan');

-- --------------------------------------------------------

--
-- Table structure for table `progja`
--

CREATE TABLE `progja` (
  `id` int(11) NOT NULL,
  `program_kerja` varchar(255) NOT NULL,
  `deskripsi_program` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `progja`
--

INSERT INTO `progja` (`id`, `program_kerja`, `deskripsi_program`, `status`) VALUES
(1, 'Mengangkat Keunggulan Komparatif UB ke Dunia Internasional', '1. Pendanaan Project GUB Tahap Lanjutan\r\n2. Pengembangan Program Inkubasi dan Internasionalisasi Project GUB (Workshop dan Pelatihan)', 'Aktif'),
(2, 'Peningkatan Kerja Sama Dengan Mitra Luar Negeri Potensial', '1. Hibah Dosen Berkarya\r\n2. Hibah Sabbatical Leave\r\n3. Student Global Leadership', 'Aktif'),
(3, 'Peningkatan Kerja Sama Dengan Mitra Dalam Negeri', '1. Pemetaan & penguatan kerjasama untuk Tridharma PT\r\n2. Pemetaan & penguatan kerjasama untuk Revenue Generating Activities melalui kerja sama dengan mitra potensial\r\n3. Pelatihan SDM di bidang public speaking, teknik negosiasi dan lobbying', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `sdm`
--

CREATE TABLE `sdm` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip_nik` int(11) NOT NULL,
  `pendidikan` text NOT NULL,
  `pengalaman_manajerial` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sdm`
--

INSERT INTO `sdm` (`id`, `nama`, `nip_nik`, `pendidikan`, `pengalaman_manajerial`, `gambar`, `id_jabatan`) VALUES
(5, 'Prof. Ir. AGUNG SUGENG WIDODO, ST.,MT.,Ph.D', 2147483647, '1) S1, Universitas Brawijaya Malang 2) S2, Universitas Gajah Mada, Yogyakarta – Indonesia 3) S3, University of Southern Queensland Australia', '-', '1749277628_e870be26157cee546e49.jpg', 3),
(6, 'Pantri Muthriana Erza Killian, S.I.P., M.IEF., Ph.D.', 19600324, '1) S1, Universitas Padjadjaran; 2) S2, The University Of Queensland', '-', '1749277820_6864ca681bdebe30d77a.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `statistik_mou`
--

CREATE TABLE `statistik_mou` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `id_mou` int(11) DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `statistik_mou`
--

INSERT INTO `statistik_mou` (`id`, `nama`, `tahun`, `id_mou`, `id_status`) VALUES
(2, 'MOU Tahun 2021', 2021, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Aktif'),
(2, 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `fakultas_unit` varchar(255) DEFAULT NULL,
  `instansi` varchar(255) NOT NULL,
  `kepentingan` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `level` varchar(225) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `fakultas_unit`, `instansi`, `kepentingan`, `status`, `level`, `keterangan`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', NULL, 'Direktorat Kerjasama Universitas Brawijaya', '', '', 'admin', NULL),
(17, 'sultan', 'sultanassaleh@student.ub.ac.id', '13fdbab7', NULL, 'Turu', 'Pengajuan kerjasama', 'approved', 'user', NULL),
(30, 'Dimas Kerjasama', 'dimasw694@gmail.com', 'e0e90741', 'Direktorat Kerjasama', 'Universitas Brawijaya', 'Sebagai Operator', 'approved', 'user', 'fakultas dan unit kerja'),
(31, 'Dimas Mitra', 'dimas08012004@gmail.com', '3c2869dd', NULL, 'PT Susah Banget', 'Pengajuan kerjasama', 'approved', 'user', 'mitra'),
(32, 'Dimas DK', 'msglowbeautiesbdl@gmail.com', '2411b680', 'Fakultas Hukum', 'Universitas Brawijaya', 'Sebagai Operator', 'approved', 'user', 'fakultas dan unit kerja');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori_berita` (`id_kategori_berita`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_dokumen_id` (`jenis_dokumen_id`),
  ADD KEY `id_status` (`id_status`);

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_status` (`id_status`);

--
-- Indexes for table `hero_content`
--
ALTER TABLE `hero_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jaminan_mutu`
--
ALTER TABLE `jaminan_mutu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_dokumen`
--
ALTER TABLE `jenis_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mou`
--
ALTER TABLE `mou`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_kerjasama`
--
ALTER TABLE `pengajuan_kerjasama`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_kerjasama_ibfk_1` (`user_id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progja`
--
ALTER TABLE `progja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sdm`
--
ALTER TABLE `sdm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `statistik_mou`
--
ALTER TABLE `statistik_mou`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mou` (`id_mou`),
  ADD KEY `id_status` (`id_status`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gambar`
--
ALTER TABLE `gambar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hero_content`
--
ALTER TABLE `hero_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jaminan_mutu`
--
ALTER TABLE `jaminan_mutu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jenis_dokumen`
--
ALTER TABLE `jenis_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mou`
--
ALTER TABLE `mou`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengajuan_kerjasama`
--
ALTER TABLE `pengajuan_kerjasama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `progja`
--
ALTER TABLE `progja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sdm`
--
ALTER TABLE `sdm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `statistik_mou`
--
ALTER TABLE `statistik_mou`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`id_kategori_berita`) REFERENCES `kategori_berita` (`id`),
  ADD CONSTRAINT `berita_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`jenis_dokumen_id`) REFERENCES `jenis_dokumen` (`id`),
  ADD CONSTRAINT `dokumen_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`);

--
-- Constraints for table `gambar`
--
ALTER TABLE `gambar`
  ADD CONSTRAINT `gambar_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`);

--
-- Constraints for table `pengajuan_kerjasama`
--
ALTER TABLE `pengajuan_kerjasama`
  ADD CONSTRAINT `pengajuan_kerjasama_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sdm`
--
ALTER TABLE `sdm`
  ADD CONSTRAINT `sdm_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`);

--
-- Constraints for table `statistik_mou`
--
ALTER TABLE `statistik_mou`
  ADD CONSTRAINT `statistik_mou_ibfk_1` FOREIGN KEY (`id_mou`) REFERENCES `mou` (`id`),
  ADD CONSTRAINT `statistik_mou_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
