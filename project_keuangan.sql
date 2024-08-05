-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Bulan Mei 2024 pada 14.52
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_keuangan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL,
  `bank_nama` varchar(255) NOT NULL,
  `bank_nomor` varchar(255) NOT NULL,
  `bank_pemilik` varchar(255) NOT NULL,
  `anggaran` bigint(20) NOT NULL,
  `bank_saldo` bigint(20) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_nama`, `bank_nomor`, `bank_pemilik`, `anggaran`, `bank_saldo`, `keterangan`) VALUES
(1, 'Uang Makan', 'Kecil', 'KC001', 1200000, 11950000, 'bumbu dapur dan lauk'),
(3, 'Uang Dapur', 'Kecil', 'KC002', 250000, 1700000, 'beras, galon dan alat dapur'),
(5, 'Uang Perlengkapan', 'Kecil', 'KC003', 250000, 250000, 'Keperluan Alat Pondok'),
(6, 'Uang Listrik', 'Kecil', 'KC004', 2000000, 19200000, 'token'),
(7, 'Uang Kebersihan', 'Kecil', 'KC005', 250000, 250000, 'alat kebersihan'),
(8, 'Uang Keamanan', 'Kecil', 'KC006', 250000, 250000, 'gembok, kunci dan lain-lain'),
(9, 'Uang Kesehatan', 'Kecil', 'KC007', 250000, 250000, 'obat dan perawatan sakit'),
(10, 'Uang Pendidikan', 'Kecil', 'KC008', 250000, 500000, 'kebutuhan ngaji dan berkas'),
(11, 'Uang Lain-Lain', 'Kecil', 'KC009', 250000, 250000, 'anggaran tak terduga'),
(12, 'Tabungan', 'Besar', 'KB001', 250000, 250000, ''),
(13, 'Sumbangan', 'Besar', 'KB002', 0, 0, ''),
(14, 'Pembayaran Bulanan', 'Besar', 'KB003', 0, 0, '');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `kriteria`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `kriteria` (
`bank_nama` varchar(255)
,`frek_penggunaan` decimal(23,0)
,`total_keluar` decimal(32,0)
,`saldo` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `santri`
--

CREATE TABLE `santri` (
  `no` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenjang` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `kamar` varchar(30) NOT NULL,
  `wali` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `santri`
--

INSERT INTO `santri` (`no`, `nama`, `jenjang`, `alamat`, `kamar`, `wali`) VALUES
(3, 'Andi F', 'Mahasiswa', 'Kesamben, Ngoro, Jombang', '1', 'Subandi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_alternatif`
--

CREATE TABLE `tabel_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama` text NOT NULL,
  `frek_penggunaan` bigint(30) NOT NULL,
  `kas_keluar` bigint(30) NOT NULL,
  `anggaran` bigint(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_alternatif`
--

INSERT INTO `tabel_alternatif` (`id_alternatif`, `nama`, `frek_penggunaan`, `kas_keluar`, `anggaran`) VALUES
(16, 'Uang Makan', 63, 165000, 460000),
(17, 'Uang Kesehatan', 26, 378000, 176000),
(26, 'Uang Pendidikan', 5, 260000, 378000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_kriteria`
--

CREATE TABLE `tabel_kriteria` (
  `id_kriteria` int(10) NOT NULL,
  `kriteria` text NOT NULL,
  `type` varchar(10) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_kriteria`
--

INSERT INTO `tabel_kriteria` (`id_kriteria`, `kriteria`, `type`, `bobot`) VALUES
(1, 'Frekuensi Penggunaan', 'cost', 2.5),
(2, 'Total Keluar', 'cost', 2.2),
(3, 'Anggaran', 'benefit', 2.1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_nilai`
--

CREATE TABLE `tabel_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_kriteria` int(10) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_nilai`
--

INSERT INTO `tabel_nilai` (`id_nilai`, `id_kriteria`, `id_alternatif`, `nilai`) VALUES
(77, 1, 16, 0.7),
(78, 2, 16, 0.3),
(79, 3, 16, 0.2),
(80, 1, 17, 0.3),
(81, 2, 17, 0.7),
(82, 3, 17, 0.8),
(104, 1, 26, 0.1),
(105, 2, 26, 0.5),
(106, 3, 26, 0.4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_tanggal` date NOT NULL,
  `transaksi_jenis` enum('Pengeluaran','Pemasukan') NOT NULL,
  `transaksi_kategori` int(11) NOT NULL,
  `transaksi_nominal` int(11) NOT NULL,
  `transaksi_keterangan` text NOT NULL,
  `transaksi_bank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_tanggal`, `transaksi_jenis`, `transaksi_kategori`, `transaksi_nominal`, `transaksi_keterangan`, `transaksi_bank`) VALUES
(1, '2019-06-21', 'Pemasukan', 3, 1000000, 'Anggaran Mingguan ', 3),
(4, '2019-06-21', 'Pengeluaran', 8, 50000, 'Makan-makan Tim Keamanan', 8),
(5, '2019-06-20', 'Pemasukan', 4, 1500000, '', 1),
(6, '2019-06-06', 'Pemasukan', 1, 12000000, 'Anggaran Awal', 1),
(8, '2019-06-14', 'Pemasukan', 6, 20000000, 'Pemasangan Gardu Pribadi', 6),
(9, '2019-06-22', 'Pengeluaran', 6, 200000, 'Token Habis', 6),
(10, '2019-06-22', 'Pemasukan', 3, 4000000, 'Pembelian Peralatan Dapur', 3),
(13, '2019-06-23', 'Pengeluaran', 6, 300000, 'Listrik Nunggak', 6),
(15, '2019-06-23', 'Pengeluaran', 6, 300000, 'Listrik bulanan', 6),
(16, '2019-06-23', 'Pemasukan', 4, 2000000, 'Penjualan Aplikasi Laba Rugi', 1),
(17, '2019-06-23', 'Pemasukan', 4, 2000000, 'Penjualan Aplikasi Akademik Sekolah SMP 888', 1),
(19, '2024-05-01', 'Pemasukan', 3, 1000000, 'Anggaran Bubuk Kopi', 3),
(20, '2024-05-02', 'Pengeluaran', 6, 2000000, 'banguna', 6),
(29, '2024-05-02', 'Pengeluaran', 1, 50000, 'Bahan Dapur', 0),
(30, '2024-05-24', 'Pemasukan', 5, 250000, 'Anggaran Uang Perlengkapan', 0),
(31, '2024-05-24', 'Pemasukan', 7, 250000, 'Anggaran Uang Kebersihan', 0),
(32, '2024-05-24', 'Pemasukan', 8, 250000, 'Anggaran Uang Keamanan', 0),
(33, '2024-05-24', 'Pemasukan', 9, 250000, 'Anggaran Uang Kesehatan', 0),
(34, '2024-05-24', 'Pemasukan', 10, 250000, 'Anggaran Uang Pendidikan', 0),
(35, '2024-05-24', 'Pemasukan', 11, 250000, 'Anggaran Uang Pendidikan', 0),
(36, '2024-05-24', 'Pemasukan', 12, 250000, 'Anggaran Untuk Tabungan', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL,
  `user_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`, `user_level`) VALUES
(1, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', '1015884418_logo.jpeg', 'administrator'),
(6, 'Maimun', 'pembimbing', '9d98460ff5d64814e7d341a965f38db1', '1318283371_logo.jpeg', 'pembimbing'),
(7, 'samsul', 'samsul', 'b5146ab5c012993e868d0f7f3ab2c092', '2137421188_logo.jpeg', 'administrator');

-- --------------------------------------------------------

--
-- Struktur untuk view `kriteria`
--
DROP TABLE IF EXISTS `kriteria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kriteria`  AS SELECT `bank`.`bank_nama` AS `bank_nama`, sum(case when `transaksi`.`transaksi_jenis` = 'Pemasukan' and `transaksi`.`transaksi_kategori` = `bank`.`bank_id` then 1 else 0 end) + sum(case when `transaksi`.`transaksi_jenis` = 'Pengeluaran' and `transaksi`.`transaksi_kategori` = `bank`.`bank_id` then 1 else 0 end) AS `frek_penggunaan`, sum(case when `transaksi`.`transaksi_jenis` = 'Pengeluaran' and `transaksi`.`transaksi_kategori` = `bank`.`bank_id` then `transaksi`.`transaksi_nominal` else 0 end) AS `total_keluar`, greatest(sum(case when `transaksi`.`transaksi_jenis` = 'Pemasukan' and `transaksi`.`transaksi_kategori` = `bank`.`bank_id` then `transaksi`.`transaksi_nominal` else 0 end) - sum(case when `transaksi`.`transaksi_jenis` = 'Pengeluaran' and `transaksi`.`transaksi_kategori` = `bank`.`bank_id` then `transaksi`.`transaksi_nominal` else 0 end),0) AS `saldo` FROM (`transaksi` join `bank`) GROUP BY `bank`.`bank_id` ORDER BY `bank`.`bank_id` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indeks untuk tabel `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `tabel_alternatif`
--
ALTER TABLE `tabel_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `tabel_kriteria`
--
ALTER TABLE `tabel_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `tabel_nilai`
--
ALTER TABLE `tabel_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `santri`
--
ALTER TABLE `santri`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tabel_alternatif`
--
ALTER TABLE `tabel_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tabel_kriteria`
--
ALTER TABLE `tabel_kriteria`
  MODIFY `id_kriteria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tabel_nilai`
--
ALTER TABLE `tabel_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tabel_nilai`
--
ALTER TABLE `tabel_nilai`
  ADD CONSTRAINT `tabel_nilai_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `tabel_kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tabel_nilai_ibfk_2` FOREIGN KEY (`id_alternatif`) REFERENCES `tabel_alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
