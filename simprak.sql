-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2021 at 11:32 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simprak`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status_aktif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kode`, `nama`, `jurusan`, `jumlah`, `status_aktif`) VALUES
(1, 'NiiQ', 'XII EL001', 'Jaringan Komputer', 30, 1),
(2, 'sFFO', 'XII EL002', 'Elektronika 1', 50, 0),
(3, 'MXQH', 'XII EL003', 'Elektronika 2', 35, 0),
(6, 'iic0', 'XII EL004', 'Elektronika 3', 35, 0),
(7, 'iK1W', 'XII EL002', 'Elektronika ', 50, 0),
(8, 'fvnT', 'XII EL003', 'Informatika', 32, 0);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_praktikum` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL,
  `komentar` varchar(225) NOT NULL,
  `kode_kelas` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id_modul` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `link` varchar(225) NOT NULL,
  `format` varchar(100) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `judul`, `keterangan`, `status`, `link`, `format`, `tanggal`) VALUES
(1, 'Modul Listrik Dasar Pada Perumahan', 'Praktikum Listrik Dasar 1', '', 'link pdf', 'pdf', '2021-03-03'),
(2, 'Modul Listrik Dasar Pada Hotel', 'Praktikum Listrik Dasar 2', '', 'link pdf', 'pdf', '2021-03-03'),
(3, 'Modul Listrik Dasar Pada Kantor', 'Praktikum Listrik Dasar 3', '', 'link pdf', 'pdf', '2021-03-03'),
(4, 'Modul Listrik Dasar Pada Gudang', 'Praktikum Listrik Dasar 4', '', 'link pdf', 'pdf', '2021-03-03'),
(5, 'Modul Listrik Dasar Pada Gudang 1', 'Praktikum Listrik Dasar 5', '', 'link pdf', 'pdf', '2021-03-03'),
(6, 'Modul Listrik Dasar Bandara', 'Praktikum Listrik Dasar 6', '', 'link pdf', 'pdf', '2021-03-03'),
(7, 'Modul Listrik Dasar Pasar', 'Praktikum Listrik Dasar 7', '', 'link pdf', 'pdf', '2021-03-03'),
(8, 'Modul Listrik Dasar Stasiun', 'Praktikum Listrik Dasar 7', '', 'link pdf', 'pdf', '2021-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `praktikum`
--

CREATE TABLE `praktikum` (
  `id_praktikum` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `komentar` varchar(500) NOT NULL,
  `kode_praktikum` varchar(20) NOT NULL,
  `id_games` int(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `praktikum`
--

INSERT INTO `praktikum` (`id_praktikum`, `judul`, `komentar`, `kode_praktikum`, `id_games`, `id_user`) VALUES
(1, 'Praktikum Listrik Dasar Perumahan', 'Selamat Siang, Silahkan lakukan simulasi praktikum listrik dasar melalui aplikasi game praktikum yang sudah di sediakan. Sebelum melakukan praktikum lebih baik download modul praktikum agar dapat mengikuti kegiatan praktikum ini. Persiakan diri dan materi terkait kelistrikan karena akan ada soal pre test, pos test dan experiment. terimakasih. ', 'snZpjk', 1, 4),
(2, 'Praktikum Listrik Dasar Pada Hotel', 'Selamat Siang, Silahkan melakukan praktikum yang 2. terimakasih', 'CnnUjk', 2, 4),
(3, 'Praktikum Listrik Dasar Pada Hotel', 'Assalamualaikum wr wb. Silahkan anak2 melakukan praktikum listrik dasar pada pada lingkungan hotel dengan metode bembelajaran simulasi game praktikum. Untuk lebih detail nya dapat kalian coba dengan cara klik link dibawah ini. terimakasih. selamat mencoba ', 'znBuji', 2, 4),
(4, 'Praktikum Listrik Dasar Pada Kantor', 'Assalamualaikum, Silakan melakukan praktikum virtual  dirumah masing-masing dengan cara klik play pada praktikum dibawah ini. Semangat belajar walaupun sedang pandemic. terimakasih', 'mnKujL', 3, 4),
(5, 'Praktikum Listrik Dasar Pada Gudang', 'Assalamualaikum Wr Wb. \r\nSilahkan melakukan praktikum listrik gudang di rumah masih-masing melalui software yang sudah terinstal pada windows kalian. selamat mencoba', 'znZujk', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `praktikum_dikelas`
--

CREATE TABLE `praktikum_dikelas` (
  `id_kelasprak` int(11) NOT NULL,
  `id_praktikum` int(11) NOT NULL,
  `kode_kelas` varchar(100) NOT NULL,
  `tgl_publis` date NOT NULL,
  `waktu_publis` time NOT NULL,
  `tgl_batas` date NOT NULL,
  `waktu_batas` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `praktikum_dikelas`
--

INSERT INTO `praktikum_dikelas` (`id_kelasprak`, `id_praktikum`, `kode_kelas`, `tgl_publis`, `waktu_publis`, `tgl_batas`, `waktu_batas`) VALUES
(1, 1, 'NiiQ', '2021-04-01', '00:00:08', '2021-04-06', '00:00:08'),
(2, 1, 'sFFO', '2021-04-01', '00:00:08', '2021-04-06', '00:00:08'),
(3, 1, 'MXQH', '2021-04-01', '00:00:08', '2021-04-06', '00:00:08'),
(4, 2, 'sFFO', '2021-04-12', '00:00:08', '2021-04-17', '00:00:08'),
(5, 3, 'NiiQ', '2021-04-11', '00:00:08', '2021-04-14', '00:00:08'),
(6, 4, 'NiiQ', '2021-05-01', '07:30:00', '2021-05-01', '10:20:00'),
(7, 4, 'iK1W', '2021-05-01', '07:30:00', '2021-05-01', '10:20:00'),
(8, 5, 'NiiQ', '2021-05-02', '07:30:00', '2021-05-02', '10:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `praktikum_games`
--

CREATE TABLE `praktikum_games` (
  `id_games` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `id_modul` int(11) NOT NULL,
  `photo` varchar(225) NOT NULL,
  `link_vidio` varchar(225) NOT NULL,
  `link_games` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `praktikum_games`
--

INSERT INTO `praktikum_games` (`id_games`, `judul`, `id_modul`, `photo`, `link_vidio`, `link_games`) VALUES
(1, 'Praktikum 1', 1, '', '', 'https://www.google.com/'),
(2, 'Praktikum 2', 2, '', '', 'https://www.google.com/'),
(3, 'Praktikum 3', 3, '', '', 'https://www.google.com/'),
(4, 'Praktikum 4', 4, '', '', 'https://www.google.com/'),
(5, 'Praktikum 5', 5, '', '', 'https://www.google.com/'),
(6, 'Praktikum 6', 6, '', '', 'https://www.google.com/'),
(7, 'Praktikum 7', 7, '', '', 'https://www.google.com/'),
(8, 'Praktikum 8', 8, '', '', 'https://www.google.com/');

-- --------------------------------------------------------

--
-- Table structure for table `praktikum_getvalue`
--

CREATE TABLE `praktikum_getvalue` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_praktikum` int(11) NOT NULL,
  `pre_status` varchar(10) NOT NULL,
  `pre_waktu_games` varchar(50) NOT NULL,
  `pre_fault_counter` varchar(225) NOT NULL,
  `post_status` varchar(10) NOT NULL,
  `post_fault_counter` varchar(225) NOT NULL,
  `post_waktu_pengerjaan` varchar(200) NOT NULL,
  `expe_waktu_pengerjaan` varchar(200) NOT NULL,
  `expe_status` varchar(50) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `praktikum_getvalue`
--

INSERT INTO `praktikum_getvalue` (`id`, `id_user`, `id_praktikum`, `pre_status`, `pre_waktu_games`, `pre_fault_counter`, `post_status`, `post_fault_counter`, `post_waktu_pengerjaan`, `expe_waktu_pengerjaan`, `expe_status`, `update_date`, `create_date`) VALUES
(7, 3, 1, 'berhasil', '3 jam 1 menit', '5', 'berhasil', '3', '3 jam 10 menit', '2 jam 15 menit', 'gagal', '0000-00-00 00:00:00', '2021-05-02 16:33:27');

-- --------------------------------------------------------

--
-- Table structure for table `praktikum_status_games`
--

CREATE TABLE `praktikum_status_games` (
  `id_status_games` int(11) NOT NULL,
  `id_praktikum` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_kelas` varchar(100) NOT NULL,
  `game_selesai` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `praktikum_status_games`
--

INSERT INTO `praktikum_status_games` (`id_status_games`, `id_praktikum`, `id_user`, `kode_kelas`, `game_selesai`, `create_date`, `update_date`) VALUES
(4, 1, 3, 'NiiQ', 1, '2021-05-02 10:52:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `praktikum_status_siswa`
--

CREATE TABLE `praktikum_status_siswa` (
  `id_status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `praktikum_status_siswa`
--

INSERT INTO `praktikum_status_siswa` (`id_status`, `id_user`, `status`, `tanggal`) VALUES
(1, 1, 1, '2021-04-05');

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `id_sekolah` varchar(225) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `no_tlp` varchar(100) NOT NULL,
  `no_fax` varchar(100) NOT NULL,
  `kode_pos` varchar(100) NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id_sekolah`, `nama`, `alamat`, `no_tlp`, `no_fax`, `kode_pos`, `id_guru`) VALUES
('608a655d1bee2', 'SMK Tarakan 6', 'Jl Hj Sanwani no 5 Rt 03 rw 01  serang banten', '087825216163', '123432', '08921', 0);

-- --------------------------------------------------------

--
-- Table structure for table `status_reg`
--

CREATE TABLE `status_reg` (
  `id_doc` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `photo` int(11) NOT NULL,
  `identitas` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `sekolah` int(11) NOT NULL,
  `akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_reg`
--

INSERT INTO `status_reg` (`id_doc`, `id_user`, `photo`, `identitas`, `kelas`, `sekolah`, `akses`) VALUES
(16, 3, 1, 1, 1, 1, 0),
(17, 5, 1, 1, 1, 1, 0),
(18, 4, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelas_user`
--

CREATE TABLE `tbl_kelas_user` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_kelas` varchar(50) NOT NULL,
  `kelas_aktif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kelas_user`
--

INSERT INTO `tbl_kelas_user` (`id`, `id_user`, `kode_kelas`, `kelas_aktif`) VALUES
(2, 4, 'NiiQ', 1),
(5, 3, 'NiiQ', 0),
(6, 5, 'NiiQ', 0),
(7, 4, 'iK1W', 0),
(8, 4, 'fvnT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fullname` varchar(225) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telpon` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `user_image` text DEFAULT NULL,
  `facebook` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `tweter` varchar(50) NOT NULL,
  `linkedIn` varchar(50) NOT NULL,
  `id_sekolah` varchar(225) DEFAULT NULL,
  `status_regis` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `fullname`, `jenis_kelamin`, `email`, `no_telpon`, `alamat`, `password`, `level`, `user_image`, `facebook`, `instagram`, `tweter`, `linkedIn`, `id_sekolah`, `status_regis`, `created_at`, `updated_at`) VALUES
(3, 'ratuverlaily', 'Ratu Verlaili E', 'Perempuan', 'ratuverlaily@yahoo.co.id', '087825216163', 'Serang Banten 1', 'ratu123456', 1, '1619490697_db612d4f4a914234f61a.png', '@ratuverlaily', '@ratuverlaily', '@ratuverlaily', '@ratuverlaily', '608a655d1bee2', 1, '0000-00-00 00:00:00', '2021-04-27 02:04:37'),
(4, 'verlailyratu', 'Verlaili Utari Ratu', 'Perempuan', 'verlailyratu@students.itb.ac.id', '087825216163', 'Serang Banten Raya', 'verla123456', 2, '1619573863_411a5fa9bfef505edb54.jpg', '@verlailyratu', '@verlailyratu', '@verlailyratu', '@verlailyratu', '608a655d1bee2', 1, '0000-00-00 00:00:00', '2021-04-27 08:38:39'),
(5, 'lugiverlaily', 'Lugi Dahlia Sari', 'Perempuan', 'lugiverlaily@gmail.com', '087825216163', 'Bandung Barat ', 'lugi123456', 1, '1619515828_c80686bcbc34ad30e073.jpg', '@lugidahlia', '@lugidahlia', '@lugidahlia', '@lugidahlia', NULL, 1, '0000-00-00 00:00:00', '2021-04-27 04:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_group`
--

CREATE TABLE `tbl_user_group` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_group`
--

INSERT INTO `tbl_user_group` (`id`, `id_user`, `nama`) VALUES
(1, 1, 'siswa'),
(2, 2, 'guru');

-- --------------------------------------------------------

--
-- Table structure for table `token_api_games`
--

CREATE TABLE `token_api_games` (
  `id` int(11) NOT NULL,
  `token` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token_api_games`
--

INSERT INTO `token_api_games` (`id`, `token`) VALUES
(1, 'cGlaTU5ZeEFqM2VhazM5aFpMeTBMZz09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indexes for table `praktikum`
--
ALTER TABLE `praktikum`
  ADD PRIMARY KEY (`id_praktikum`);

--
-- Indexes for table `praktikum_dikelas`
--
ALTER TABLE `praktikum_dikelas`
  ADD PRIMARY KEY (`id_kelasprak`);

--
-- Indexes for table `praktikum_games`
--
ALTER TABLE `praktikum_games`
  ADD PRIMARY KEY (`id_games`);

--
-- Indexes for table `praktikum_getvalue`
--
ALTER TABLE `praktikum_getvalue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `praktikum_status_games`
--
ALTER TABLE `praktikum_status_games`
  ADD PRIMARY KEY (`id_status_games`);

--
-- Indexes for table `praktikum_status_siswa`
--
ALTER TABLE `praktikum_status_siswa`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indexes for table `status_reg`
--
ALTER TABLE `status_reg`
  ADD PRIMARY KEY (`id_doc`);

--
-- Indexes for table `tbl_kelas_user`
--
ALTER TABLE `tbl_kelas_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `email` (`email`);

--
-- Indexes for table `tbl_user_group`
--
ALTER TABLE `tbl_user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token_api_games`
--
ALTER TABLE `token_api_games`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `praktikum`
--
ALTER TABLE `praktikum`
  MODIFY `id_praktikum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `praktikum_dikelas`
--
ALTER TABLE `praktikum_dikelas`
  MODIFY `id_kelasprak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `praktikum_games`
--
ALTER TABLE `praktikum_games`
  MODIFY `id_games` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `praktikum_getvalue`
--
ALTER TABLE `praktikum_getvalue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `praktikum_status_games`
--
ALTER TABLE `praktikum_status_games`
  MODIFY `id_status_games` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `praktikum_status_siswa`
--
ALTER TABLE `praktikum_status_siswa`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status_reg`
--
ALTER TABLE `status_reg`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_kelas_user`
--
ALTER TABLE `tbl_kelas_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user_group`
--
ALTER TABLE `tbl_user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `token_api_games`
--
ALTER TABLE `token_api_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
