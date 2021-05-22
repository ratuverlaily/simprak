-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2021 at 01:20 AM
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
  `id_posting` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `komentar` varchar(225) NOT NULL,
  `tanggal` varchar(100) NOT NULL
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
(1, 'JOB SHEET PRAKTIKUM SMK (JOB 1)', 'Instalasi Penerangan \r\nKWh, MCB, dan \r\nSakelar Tunggal\r\n', '1', 'JOB_SHEET_1.pdf', 'pdf', '2021-05-21'),
(2, 'JOB SHEET PRAKTIKUM SMK (JOB 2)', 'Instalasi Penerangan \r\nKWh, MCB, dan Sakelar \r\nSeri\r\n', '1', 'JOB_SHEET_2.pdf', 'pdf', '2021-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `posting_status`
--

CREATE TABLE `posting_status` (
  `id_posting` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `posting` varchar(225) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_kelas` varchar(50) NOT NULL,
  `file` varchar(100) DEFAULT NULL,
  `link_web` varchar(225) NOT NULL,
  `link_youtube` varchar(225) NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_praktikum` int(11) NOT NULL,
  `create_date` varchar(50) NOT NULL,
  `update_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posting_status`
--

INSERT INTO `posting_status` (`id_posting`, `judul`, `posting`, `id_user`, `kode_kelas`, `file`, `link_web`, `link_youtube`, `status`, `id_praktikum`, `create_date`, `update_date`) VALUES
(6, 'JOB SHEET PRAKTIKUM SMK (JOB 1)', '', 4, 'NiiQ', NULL, '', '', 'praktikum', 1, '2021-05-21 01:35:22', '2021-05-21 01:35:22'),
(7, 'JOB SHEET PRAKTIKUM SMK (JOB 1)', '', 4, 'iK1W', NULL, '', '', 'praktikum', 2, '2021-05-21 02:28:37', '2021-05-21 02:28:37'),
(13, 'Materi Pembelajaran Praktikum 1', 'Belajar Praktikum 1', 3, 'NiiQ', '1621599397_7ec73d80eb00d2d2b19e.pdf', '', '', 'info', 0, '2021-05-21 07:16:37', '2021-05-21 07:16:37'),
(14, 'Materi Pembelajaran Praktikum 2', 'jhkhkjhjkhj', 3, 'NiiQ', '1621606361_44d21dfa7d7ae9bffec8.pdf', '', '', 'info', 0, '2021-05-21 09:12:41', '2021-05-21 09:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `praktikum`
--

CREATE TABLE `praktikum` (
  `id_praktikum` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `komentar` varchar(5000) NOT NULL,
  `kode_praktikum` varchar(20) NOT NULL,
  `id_games` int(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `praktikum`
--

INSERT INTO `praktikum` (`id_praktikum`, `judul`, `komentar`, `kode_praktikum`, `id_games`, `id_user`) VALUES
(1, 'JOB SHEET PRAKTIKUM SMK (JOB 1)', 'nkbskdjasjkd', 'DmubPk', 1, 4),
(2, 'JOB SHEET PRAKTIKUM SMK (JOB 1) 2', 'INDIKATOR:/\r\n1. Teknik instalasi kWh meter, MCB, dan sakelartunggal dapat dipahami/\r\n2. Instalasi kWhmeter, MCB, dan sakelar tunggal dapat dipasang sesuai ketentuan/\r\n3. Instalasi kWh meter, MCB, dan sakelar tunggal diuji coba dengan benar/\r\n', 'gjuKDn', 1, 4);

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
(10, 1, 'NiiQ', '2021-05-21', '13:35:00', '2021-05-30', '13:35:00'),
(11, 2, 'iK1W', '2021-05-21', '15:27:00', '2021-05-30', '00:05:00');

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
(1, 'Instalasi Penerangan Simulasi 1', 1, '', '', 'https://www.google.com/'),
(2, 'Instalasi Penerangan Simulasi 2', 2, '', '', 'https://www.google.com/');

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
  `update_date` varchar(225) NOT NULL DEFAULT current_timestamp(),
  `create_date` varchar(225) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(6, 1, 3, 'NiiQ', 0, '2021-05-21 03:18:42', '0000-00-00 00:00:00');

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
(3, 'ratuverlaily', 'Ratu Verlaili E', 'Perempuan', 'ratuverlaily@yahoo.co.id', '087825216163', 'Serang Banten Raya 1', 'ratu1234567', 1, '1619490697_db612d4f4a914234f61a.png', '@ratuverlaily', '@ratuverlaily', '@ratuverlaily', '@ratuverlaily', '608a655d1bee2', 1, '0000-00-00 00:00:00', '2021-05-04 12:53:21'),
(4, 'verlailyratu', 'Verlaili Utari Ratu', 'Perempuan', 'verlailyratu@students.itb.ac.id', '087825216163', 'Serang Banten Raya', 'verla123456', 2, '1621530319_f31e0d6ef2daeb0cbe70.jpg', '@verlailyratu', '@verlailyratu', '@verlailyratu', '@verlailyratu', '608a655d1bee2', 1, '0000-00-00 00:00:00', '2021-04-27 08:38:39'),
(5, 'lugiverlaily', 'Lugi Dahlia Sari', 'Perempuan', 'lugiverlaily@gmail.com', '087825216163', 'Bandung Barat ', 'lugi123456', 1, '1619515828_c80686bcbc34ad30e073.jpg', '@lugidahlia', '@lugidahlia', '@lugidahlia', '@lugidahlia', '608a655d1bee2', 1, '0000-00-00 00:00:00', '2021-04-27 04:34:00');

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
-- Indexes for table `posting_status`
--
ALTER TABLE `posting_status`
  ADD PRIMARY KEY (`id_posting`);

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
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posting_status`
--
ALTER TABLE `posting_status`
  MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `praktikum`
--
ALTER TABLE `praktikum`
  MODIFY `id_praktikum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `praktikum_dikelas`
--
ALTER TABLE `praktikum_dikelas`
  MODIFY `id_kelasprak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `praktikum_games`
--
ALTER TABLE `praktikum_games`
  MODIFY `id_games` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `praktikum_getvalue`
--
ALTER TABLE `praktikum_getvalue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `praktikum_status_games`
--
ALTER TABLE `praktikum_status_games`
  MODIFY `id_status_games` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
