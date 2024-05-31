-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 08:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(125) NOT NULL,
  `kategori_buku` varchar(125) NOT NULL,
  `penerbit_buku` varchar(125) NOT NULL,
  `pengarang` varchar(125) NOT NULL,
  `tahun_terbit` varchar(125) NOT NULL,
  `isbn` int(50) NOT NULL,
  `j_buku_baik` varchar(125) NOT NULL,
  `j_buku_rusak` varchar(125) NOT NULL,
  `tipe_buku` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `kategori_buku`, `penerbit_buku`, `pengarang`, `tahun_terbit`, `isbn`, `j_buku_baik`, `j_buku_rusak`, `tipe_buku`) VALUES
(1, 'Cantik Itu Luka', 'Novel ', 'Mizan Pustaka', 'Eka Kurniawan', '2002', 2147483647, '38', '2', 'Hard Copy'),
(2, 'Home Sweet Loan', 'Novel ', 'Gramedia Pustaka Utama', 'Almira Bastari', '2022', 2147483647, '40', '0', 'E-Book'),
(3, 'Heartbreak Motel', 'Novel ', 'Gramedia Pustaka Utama', 'Ika Natassa', '2022', 2147483647, '40', '0', 'E-Book'),
(4, 'Buku Test PSTI', 'Karya Ilmiah', 'Erlangga', 'Samosir ', '2005', 12345678, '25', '5', 'Hard Copy'),
(5, 'Diktat Pemrograman', 'Diktat', 'Bentang Pustaka', 'Inggriani Liem', '2003', 240032, '17', '3', 'E-Book');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id_identitas` int(11) NOT NULL,
  `nama_app` varchar(50) NOT NULL,
  `alamat_app` text NOT NULL,
  `email_app` varchar(125) NOT NULL,
  `nomor_hp` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_app`, `alamat_app`, `email_app`, `nomor_hp`) VALUES
(1, 'PustakaAlumni', 'Jl. Ir. Sutami No.36A, Jebres, Kota Surakarta, Jawa Tengah 57126', 'PustakaAlumniTI@uns.com', '62812345678910');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kode_kategori` varchar(50) NOT NULL,
  `nama_kategori` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kode_kategori`, `nama_kategori`) VALUES
(1, 'KT-001', 'Novel '),
(3, 'KT-003', 'Ensiklopedi'),
(4, 'KT-004', 'Biografi'),
(5, 'KT-005', 'Catatan Harian'),
(6, 'KT-006', 'Karya Ilmiah'),
(8, 'KT-008', 'Panduan (how to)'),
(9, 'KT-009', 'Majalah'),
(10, 'KT-010', 'Antologi'),
(11, 'KT-011', 'Diktat');

-- --------------------------------------------------------

--
-- Table structure for table `pemberitahuan`
--

CREATE TABLE `pemberitahuan` (
  `id_pemberitahuan` int(11) NOT NULL,
  `isi_pemberitahuan` varchar(255) NOT NULL,
  `level_user` varchar(125) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemberitahuan`
--

INSERT INTO `pemberitahuan` (`id_pemberitahuan`, `isi_pemberitahuan`, `level_user`, `status`) VALUES
(1, '<i class=\'fa fa-exchange\'></i> #Reza  Saputra Telah meminjam Buku', 'Admin', 'Sudah dibaca'),
(2, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(3, '<i class=\'fa fa-exchange\'></i> #ipipaa Telah meminjam Buku', 'Admin', 'Sudah dibaca'),
(4, '<i class=\'fa fa-repeat\'></i> #ipipaa Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(5, '<i class=\'fa fa-exchange\'></i> #opopa Telah meminjam Buku', 'Admin', 'Sudah dibaca'),
(6, '<i class=\'fa fa-repeat\'></i> #opopa Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(7, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengajukan Buku Baru', 'Admin', 'Sudah dibaca');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `nama_anggota` varchar(125) NOT NULL,
  `judul_buku` varchar(125) NOT NULL,
  `tanggal_peminjaman` varchar(125) NOT NULL,
  `tenggat_peminjaman` varchar(125) NOT NULL,
  `tanggal_pengembalian` varchar(50) NOT NULL,
  `kondisi_buku_saat_dipinjam` varchar(125) NOT NULL,
  `kondisi_buku_saat_dikembalikan` varchar(125) NOT NULL,
  `denda` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `nama_anggota`, `judul_buku`, `tanggal_peminjaman`, `tenggat_peminjaman`, `tanggal_pengembalian`, `kondisi_buku_saat_dipinjam`, `kondisi_buku_saat_dikembalikan`, `denda`) VALUES
(1, 'Reza  Saputra', 'Cantik Itu Luka', '08-08-2023', '22-08-2023', '08-08-2023', 'Baik', 'Baik', 'Tidak ada'),
(2, 'ipipaa', 'Heartbreak Motel', '19-05-2024', '02-06-2024', '19-05-2024', 'Baik', 'Baik', 'Tidak ada'),
(3, 'opopa', 'Diktat Pemrograman', '19-05-2024', '02-06-2024', '19-05-2024', 'Baik', 'Baik', 'Tidak ada');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `kode_penerbit` varchar(125) NOT NULL,
  `nama_penerbit` varchar(50) NOT NULL,
  `verif_penerbit` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `kode_penerbit`, `nama_penerbit`, `verif_penerbit`) VALUES
(1, 'P001', 'Gramedia Pustaka Utama', 'Terverifikasi'),
(2, 'P002', 'Mizan Pustaka', 'Terverifikasi'),
(3, 'P003', 'Bentang Pustaka', 'Terverifikasi'),
(4, 'P004', 'Erlangga', 'Terverifikasi'),
(5, 'P005', 'Republika', 'Terverifikasi');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `judul_pesan` varchar(50) NOT NULL,
  `judul_buku` varchar(125) NOT NULL,
  `kategori_buku` varchar(125) NOT NULL,
  `penerbit_buku` varchar(125) NOT NULL,
  `pengarang` varchar(125) NOT NULL,
  `tahun_terbit` varchar(125) NOT NULL,
  `isbn` int(50) NOT NULL,
  `tipe_buku` varchar(50) DEFAULT NULL,
  `jumlah_buku_baik` varchar(125) NOT NULL,
  `jumlah_buku_rusak` varchar(125) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal_kirim` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id_pengajuan`, `penerima`, `pengirim`, `judul_pesan`, `judul_buku`, `kategori_buku`, `penerbit_buku`, `pengarang`, `tahun_terbit`, `isbn`, `tipe_buku`, `jumlah_buku_baik`, `jumlah_buku_rusak`, `status`, `tanggal_kirim`) VALUES
(6, 'Administrator', 'Reza  Saputra', 'Pengajuan buku baru', 'Diktat Teknik Industri Semester 3', 'Diktat', 'Erlangga', 'Sitompul', '2005', 12131241, 'E-book', '13', '2', 'Belum dibaca', '21-05-2024'),
(7, 'Administrator', 'Reza  Saputra', 'test', 'test', 'test', 'test', 'test', '2006', 120876, 'Hardcopy', '15', '7', 'Sudah dibaca', '21-05-2024');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `judul_pesan` varchar(50) NOT NULL,
  `isi_pesan` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal_kirim` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `penerima`, `pengirim`, `judul_pesan`, `isi_pesan`, `status`, `tanggal_kirim`) VALUES
(2, 'opopa', 'golden', 'test 1', 'testtt\r\n', 'Sudah dibaca', '20-05-2024'),
(4, 'Administrator', 'golden', 'test123', 'test1234\r\n', 'Belum dibaca', '21-05-2024'),
(6, 'golden', 'Reza  Saputra', 'test111', 'testttt\r\n', 'Belum dibaca', '21-05-2024');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `kode_user` varchar(25) NOT NULL,
  `nim` char(20) NOT NULL,
  `fullname` varchar(125) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `verif` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `join_date` varchar(125) NOT NULL,
  `terakhir_login` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `kode_user`, `nim`, `fullname`, `username`, `password`, `kelas`, `alamat`, `verif`, `role`, `join_date`, `terakhir_login`) VALUES
(1, '-', '-', 'Administrator', 'admin', 'admin', '-', '-', 'Iya', 'Admin', '04-05-2021', '21-05-2024 ( 13:45:30 )'),
(2, 'AP001', '100011', 'Reza  Saputra', 'reza', 'Reza', '2022', 'Desa Sambiroto, Kecamatan Tayu, Kabupatem Pati', 'Tidak', 'Anggota', '08-08-2022', '21-05-2024 ( 13:46:05 )'),
(4, 'AP002', '240111', 'opopa', 'opop', 'opop', '2020', 'hohohohiohoihioaaaaa', 'Tidak', 'Anggota', '19-05-2024', '20-05-2024 ( 02:30:39 )'),
(5, 'AP003', '444411111', 'ipipaa', 'ipip', 'ipip', '2021', 'asdasddasdsadopopopop', 'Tidak', 'Anggota', '19-05-2024', '20-05-2024 ( 00:11:16 )'),
(7, '-', '-', 'golden', 'gold', 'gold', '-', '-', 'Iya', 'Admin', '19-05-2024', '21-05-2024 ( 13:49:50 )');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id_identitas`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  ADD PRIMARY KEY (`id_pemberitahuan`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id_identitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  MODIFY `id_pemberitahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
