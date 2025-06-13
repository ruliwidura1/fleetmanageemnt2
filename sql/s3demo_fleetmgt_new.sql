-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2025 pada 10.37
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s3demo_fleetmgt_new`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_jenis_merkkendaraan`
--

CREATE TABLE `a_jenis_merkkendaraan` (
  `id` int(2) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `utype` varchar(255) NOT NULL,
  `no_pol` varchar(255) NOT NULL,
  `kapasitas_mesin` varchar(255) NOT NULL,
  `warna` varchar(255) NOT NULL,
  `is_active` int(2) NOT NULL,
  `merk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `a_jenis_merkkendaraan`
--

INSERT INTO `a_jenis_merkkendaraan` (`id`, `nama`, `utype`, `no_pol`, `kapasitas_mesin`, `warna`, `is_active`, `merk`) VALUES
(1, 'Mitsubishi Fuso Fighter X FN61FS', 'Pickup', 'F 123 FF', '2000', 'Hitam', 1, 'Daihatsu Hijet 1000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_modules`
--

CREATE TABLE `a_modules` (
  `identifier` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `path` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '',
  `level` int(1) NOT NULL DEFAULT 0 COMMENT 'depth level of menu, 0 mean outer 3 deeper submenu',
  `has_submenu` int(1) NOT NULL DEFAULT 0 COMMENT '1 mempunyai submenu, 2 tidak mempunyai submenu',
  `children_identifier` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_default` enum('allowed','denied') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'denied',
  `is_visible` int(1) NOT NULL DEFAULT 1,
  `priority` int(3) NOT NULL DEFAULT 0 COMMENT '0 mean higher 999 lower',
  `fa_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'fa fa-home' COMMENT 'font-awesome icon on menu',
  `utype` varchar(48) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'internal' COMMENT 'type module internal, external',
  `pov` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `a_modules`
--

INSERT INTO `a_modules` (`identifier`, `name`, `path`, `level`, `has_submenu`, `children_identifier`, `is_active`, `is_default`, `is_visible`, `priority`, `fa_icon`, `utype`, `pov`) VALUES
('dashboard', 'Dashboard', '/', 0, 0, NULL, 1, 'denied', 1, 1, 'fa fa-home', 'internal', 'admin'),
('erpmaster', 'ERP Master', '#', 0, 1, NULL, 1, 'denied', 1, 20, 'fa fa-hdd-o', 'internal', 'admin'),
('erpmaster_aset', 'Aset', 'erpmaster/aset', 1, 0, 'erpmaster', 1, 'denied', 1, 12, 'fa fa-home', 'internal', 'admin'),
('erpmaster_pengguna', 'Pengguna', 'erpmaster/pengguna', 1, 0, 'erpmaster', 1, 'denied', 1, 12, 'fa fa-home', 'internal', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_pengguna`
--

CREATE TABLE `a_pengguna` (
  `id` int(5) UNSIGNED NOT NULL,
  `a_company_id` int(5) UNSIGNED DEFAULT NULL,
  `a_jabatan_id` int(4) UNSIGNED DEFAULT NULL,
  `username` varchar(24) NOT NULL DEFAULT '',
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL DEFAULT 'admin',
  `foto` varchar(255) DEFAULT NULL,
  `is_deleted` int(1) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `a_pengguna`
--

INSERT INTO `a_pengguna` (`id`, `a_company_id`, `a_jabatan_id`, `username`, `nama`, `email`, `password`, `tipe`, `foto`, `is_deleted`, `is_active`) VALUES
(1, NULL, NULL, 'adminAsetMgt', 'Admin', 'admin@gmail.com', '$2y$10$mZHrcZ2t/6MYU73uGvJ7VuVWKkqNhWrJUPJx/IIDpm51iOneamTw.', 'admin', NULL, 0, 1),
(2, NULL, NULL, 'AdmIndah', 'Indah', 'indah@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', NULL, 0, 1),
(3, NULL, NULL, 'AdmRuli', 'Ruli', 'ruli@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', NULL, 0, 1),
(4, NULL, NULL, 'AdmTia', 'Tia', 'tia@gmail.com', '$2y$10$jZozRvP.Pmhq7UMy6mpEzetF4gtCQmZEM2SEzvEgJTYrvPViZyBz2', 'admin', NULL, 0, 1),
(5, NULL, NULL, 'Adm1', 'Admin1', 'adm1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_pengguna_module`
--

CREATE TABLE `a_pengguna_module` (
  `id` int(8) UNSIGNED NOT NULL,
  `a_pengguna_id` int(6) UNSIGNED DEFAULT NULL,
  `a_modules_identifier` varchar(255) DEFAULT NULL,
  `rule` enum('allowed','disallowed','allowed_except','disallowed_except') NOT NULL DEFAULT 'allowed',
  `tmp_active` enum('N','Y') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='hak akses pengguna';

--
-- Dumping data untuk tabel `a_pengguna_module`
--

INSERT INTO `a_pengguna_module` (`id`, `a_pengguna_id`, `a_modules_identifier`, `rule`, `tmp_active`) VALUES
(1, 1, NULL, 'allowed_except', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_vehicle`
--

CREATE TABLE `a_vehicle` (
  `id` int(5) NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `utype` enum('Pickup','Van','Box','Engkel','Double','Fuso','Tronton','Trintin','Trinton','Wingbox','Trailer') NOT NULL DEFAULT 'Engkel',
  `no_pol` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `merk` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `warna` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `kapasitas_mesin` int(5) NOT NULL DEFAULT 1,
  `kapasitas_angkutan` int(5) NOT NULL DEFAULT 1,
  `availability` enum('Tersedia','Digunakan','Diperbaiki') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Tersedia',
  `is_active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `a_vehicle`
--

INSERT INTO `a_vehicle` (`id`, `nama`, `utype`, `no_pol`, `merk`, `warna`, `kapasitas_mesin`, `kapasitas_angkutan`, `availability`, `is_active`) VALUES
(1, 'Mitsubishi Colt Diesel Fe 71 ps11d', 'Box', 'B 1234 N', 'Mitsubishi', 'Kuning', 3908, 3000, 'Tersedia', 1),
(2, 'Mitsubishi Fuso Fighter', 'Fuso', 'N 4321 Z', 'Mitsubishi', 'Orange', 7545, 20000, 'Digunakan', 1),
(3, 'Suzuki New Carry', 'Pickup', 'F 4938 H', 'Suzuki', 'Putih', 1462, 1000, 'Diperbaiki', 0),
(4, 'Mitsubishi New Colt L300 ', 'Pickup', 'C 6284 B', 'Mitsubishi', 'Hitam', 2268, 2345, 'Digunakan', 1),
(5, 'Hino Lohan FM260JW Long Bak Besi', 'Engkel', 'G 3108 T', 'Hino', 'Hijau', 7684, 26000, 'Diperbaiki', 0),
(6, 'Dyna 136HT HI-Gear 4x2 6MT (PTO)', 'Engkel', 'O 5581 T', 'Toyota', 'Merah', 4009, 4000, 'Tersedia', 1),
(7, 'Hino Dutro 130HD', 'Engkel', 'O 3462 F', 'Hino', 'Hijau', 4009, 4900, 'Tersedia', 1),
(8, 'Gran Max PU 1.5 STD FH E4', 'Pickup', 'O 3478 Z', 'Daihatsu', 'Putih', 1495, 1500, 'Tersedia', 1),
(9, 'Ranger Cargo FLX 280 JW', 'Box', 'Z 3462 F', 'Hino Dutro', 'Hijau', 7684, 32000, 'Diperbaiki', 0),
(10, ' Gran Max MB Blind Van 1.3 STD', 'Van', 'G 6621 F', 'Daihatsu', 'Putih', 1289, 720, 'Tersedia', 1),
(11, 'Mitsubishi Fuso Center FE 73', 'Fuso', 'H 5643 D', 'Mitsubishi', 'kuning', 3907, 7000, 'Tersedia', 1),
(12, 'Mitsubishi Fuso Center FE 71', 'Box', 'H 3643 B', 'Mitsubishi', 'Kuning', 3907, 5150, 'Tersedia', 1),
(13, 'Mitsubishi Fuso Center FE 48G', 'Fuso', 'F 6643 D', 'Mitsubishi', 'Kuning', 3907, 8500, 'Tersedia', 1),
(14, 'Mitsubishi Fuso Fighter X FN61FS', 'Fuso', 'B 6734 D', 'Mitsubishi', 'Kuning', 7545, 26000, 'Tersedia', 1),
(15, 'Mitsubishi Fuso Fighter X FN62F TH', 'Fuso', 'G 7736 F', 'Mitsubishi', 'Putih', 7545, 26000, 'Digunakan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `b_bensin`
--

CREATE TABLE `b_bensin` (
  `id` int(3) NOT NULL,
  `a_vehicle_id` varchar(255) NOT NULL,
  `tgl_beli` date NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `kapasitas` varchar(255) NOT NULL,
  `jumlah_beli` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `total_harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `b_bensin`
--

INSERT INTO `b_bensin` (`id`, `a_vehicle_id`, `tgl_beli`, `jenis`, `kapasitas`, `jumlah_beli`, `harga`, `total_harga`) VALUES
(1, '1', '2025-05-23', 'Pertamax', '11', '211', '20000', '135000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `b_driver`
--

CREATE TABLE `b_driver` (
  `id` int(3) NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `sim` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `b_driver`
--

INSERT INTO `b_driver` (`id`, `nama`, `is_active`, `sim`) VALUES
(1, 'Setyo Indrawan', 1, ''),
(2, 'Gegen Yosea', 1, ''),
(3, 'Irwan Novanto', 1, ''),
(4, 'Jorse Winton', 1, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `b_pajak`
--

CREATE TABLE `b_pajak` (
  `id` int(5) NOT NULL,
  `a_vehicle_id` varchar(255) NOT NULL,
  `tahun_pembuatan` date NOT NULL,
  `berlaku` date NOT NULL,
  `nominal_pajak` varchar(255) NOT NULL,
  `perpanjang_pajak` date NOT NULL,
  `is_active` int(2) NOT NULL,
  `jenis_kendaraan` varchar(255) NOT NULL,
  `no_pol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `b_pajak`
--

INSERT INTO `b_pajak` (`id`, `a_vehicle_id`, `tahun_pembuatan`, `berlaku`, `nominal_pajak`, `perpanjang_pajak`, `is_active`, `jenis_kendaraan`, `no_pol`) VALUES
(1, '1', '0000-00-00', '2025-05-23', '1000000000', '2025-05-23', 1, '1', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `c_acservice`
--

CREATE TABLE `c_acservice` (
  `id` int(3) NOT NULL,
  `pelanggan_nama` varchar(255) NOT NULL,
  `pk` varchar(255) NOT NULL,
  `teknisi_1_nama` varchar(255) NOT NULL,
  `teknisi_2_nama` varchar(255) NOT NULL,
  `teknisi_3_nama` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `tanggal_perbaikan` date NOT NULL,
  `deskripsi_kerusakan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `c_acservice`
--

INSERT INTO `c_acservice` (`id`, `pelanggan_nama`, `pk`, `teknisi_1_nama`, `teknisi_2_nama`, `teknisi_3_nama`, `telp`, `tanggal_perbaikan`, `deskripsi_kerusakan`) VALUES
(19, 'Jihan Fahriza Amalina ', '0.15', 'Abdul Hamid ', 'Erik Hasibuan', 'Wage Rudolf Supratman ', '123456789012', '2025-06-13', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
(20, 'Muhammad Yamin', '12', 'Qarib Abdullah Shakil', 'Riordan Kevin Widagda', 'Robert Ed Stewart', '02266280611', '2025-06-15', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `c_arrival`
--

CREATE TABLE `c_arrival` (
  `id` int(11) NOT NULL,
  `cdate` date NOT NULL,
  `b_driver_id` int(10) NOT NULL,
  `a_vehicle_id` int(10) NOT NULL,
  `jam_masuk` time NOT NULL,
  `destination` varchar(255) NOT NULL,
  `is_completed` int(1) NOT NULL DEFAULT 0,
  `is_active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `c_arrival`
--

INSERT INTO `c_arrival` (`id`, `cdate`, `b_driver_id`, `a_vehicle_id`, `jam_masuk`, `destination`, `is_completed`, `is_active`) VALUES
(1, '2024-07-30', 2, 1, '22:00:00', 'Bandung, Jakarta', 1, 1),
(2, '2025-06-05', 3, 7, '12:12:00', 'Tegalkembang', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `c_departure`
--

CREATE TABLE `c_departure` (
  `id` int(11) NOT NULL,
  `cdate` date NOT NULL,
  `b_driver_id` int(5) NOT NULL,
  `a_vehicle_id` int(5) NOT NULL,
  `jam_keluar` time NOT NULL,
  `area_tujuan` varchar(150) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `is_departure` int(1) NOT NULL DEFAULT 0,
  `is_active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `c_departure`
--

INSERT INTO `c_departure` (`id`, `cdate`, `b_driver_id`, `a_vehicle_id`, `jam_keluar`, `area_tujuan`, `destination`, `is_departure`, `is_active`) VALUES
(1, '2024-07-29', 1, 4, '16:30:00', '2', 'Bandung, Jakarta', 0, 1),
(2, '2024-08-02', 2, 1, '09:30:00', '2', 'Surabaya, Semarang', 0, 1),
(3, '2025-06-07', 1, 3, '12:12:00', '2', 'Tegalkembang', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `c_monitoring`
--

CREATE TABLE `c_monitoring` (
  `id` int(5) NOT NULL,
  `integrasi_gps_tracking` varchar(255) NOT NULL,
  `pelacakan_posisi_realtime_kendaraan` varchar(255) NOT NULL,
  `riwayat_rute_perjalanan` varchar(255) NOT NULL,
  `alert_perjalanan_berlebih` varchar(255) NOT NULL,
  `geofencing` varchar(255) NOT NULL,
  `is_active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `c_monitoring`
--

INSERT INTO `c_monitoring` (`id`, `integrasi_gps_tracking`, `pelacakan_posisi_realtime_kendaraan`, `riwayat_rute_perjalanan`, `alert_perjalanan_berlebih`, `geofencing`, `is_active`) VALUES
(1, 'Kp. Cimareme2 Des. Cibodas, Kec.Kutawringin2, Kab.bandung2', '50 Km', '450 Jam', '800.000', 'Berada di jalur', 1),
(2, 'Kp. Cimareme Des. Cibodas, Kec.Kutawringin, Kab.bandung', '50 Km', '24 Jam', '300.000', 'Berada di jalur 2', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `c_muatan`
--

CREATE TABLE `c_muatan` (
  `id` int(11) NOT NULL,
  `cdate` date NOT NULL,
  `b_driver_id` int(3) NOT NULL,
  `a_vehicle_id` int(5) NOT NULL,
  `barang` varchar(150) NOT NULL,
  `jumlah_muatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `satuan` varchar(43) NOT NULL,
  `berat` varchar(20) NOT NULL,
  `kapasitas_kendaraan` int(1) NOT NULL DEFAULT 1 COMMENT '1 = sesuai, 2 = kurang, 3 = lebih',
  `is_active` int(1) NOT NULL DEFAULT 1,
  `a_vehicle_utype` varchar(255) DEFAULT '',
  `a_vehicle_no_pol` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `c_muatan`
--

INSERT INTO `c_muatan` (`id`, `cdate`, `b_driver_id`, `a_vehicle_id`, `barang`, `jumlah_muatan`, `satuan`, `berat`, `kapasitas_kendaraan`, `is_active`, `a_vehicle_utype`, `a_vehicle_no_pol`) VALUES
(1, '2024-07-15', 2, 1, 'Kain Cotton ', '103 ', 'ROLL', '2482', 3, 1, '', ''),
(2, '2024-07-17', 3, 5, 'Kasur Busa', '31 ', 'PCS', '677', 1, 1, '', ''),
(3, '2024-07-18', 1, 4, 'Kain Cotton', '50', 'ROLL', '650', 2, 1, '', ''),
(4, '2024-07-25', 1, 2, 'Semen Tiga Roda', '100', 'SAK', '1043', 2, 1, '', ''),
(5, '2024-08-05', 3, 3, 'Batu Bata', '1000', 'PCS', '3000', 3, 1, '', ''),
(6, '2025-06-06', 3, 4, 'Barang anti karat', '10', '121212', '3', 1, 1, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `d_kirim`
--

CREATE TABLE `d_kirim` (
  `id` int(10) NOT NULL,
  `cdate` date DEFAULT NULL,
  `b_driver_id` int(11) NOT NULL,
  `a_vehicle_id` int(11) NOT NULL,
  `d_pengiriman_id` int(11) NOT NULL,
  `c_muatan_id` int(11) NOT NULL,
  `c_departure_id` int(11) NOT NULL,
  `c_arrival_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `a_vehicle_merk` varchar(255) NOT NULL,
  `a_vehicle_no_pol` varchar(255) NOT NULL,
  `a_vehicle_nama` varchar(255) NOT NULL,
  `d_pengiriman_kode` varchar(255) NOT NULL,
  `c_muatan_jumlah_muatan` varchar(255) NOT NULL,
  `c_muatan_berat` varchar(255) NOT NULL,
  `d_pengiriman_tujuan` varchar(255) NOT NULL,
  `d_pengiriman_kabkota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `d_kirim`
--

INSERT INTO `d_kirim` (`id`, `cdate`, `b_driver_id`, `a_vehicle_id`, `d_pengiriman_id`, `c_muatan_id`, `c_departure_id`, `c_arrival_id`, `is_active`, `a_vehicle_merk`, `a_vehicle_no_pol`, `a_vehicle_nama`, `d_pengiriman_kode`, `c_muatan_jumlah_muatan`, `c_muatan_berat`, `d_pengiriman_tujuan`, `d_pengiriman_kabkota`) VALUES
(1, '2024-07-16', 1, 4, 1, 3, 1, 1, 1, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `d_pengiriman`
--

CREATE TABLE `d_pengiriman` (
  `id` int(11) NOT NULL,
  `cdate` date NOT NULL,
  `kode` varchar(50) NOT NULL,
  `c_muatan_id` int(11) DEFAULT NULL,
  `tujuan` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kabkota` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `negara` varchar(50) DEFAULT NULL,
  `kodepos` varchar(10) DEFAULT NULL,
  `is_delivered` int(1) NOT NULL DEFAULT 2 COMMENT '2 = batal, 1 = diterima, 0 = dikirim'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `d_pengiriman`
--

INSERT INTO `d_pengiriman` (`id`, `cdate`, `kode`, `c_muatan_id`, `tujuan`, `alamat`, `kelurahan`, `kecamatan`, `kabkota`, `provinsi`, `negara`, `kodepos`, `is_delivered`) VALUES
(1, '2024-07-25', 'KCT-001', 1, 'PT. Mitra Husada', 'Kp. Tegal Kembang Rt/Rw 001/008', 'Kutawaringin', 'Kutawaringin', 'Kabupaten Bandung', 'Jawa Barat', 'Indonesia', '40911', 0),
(2, '2024-07-31', 'PPB - 012', 3, 'PT. Indosigma', 'Kp. Bojong Loa', 'Kutawaringin', 'Kutawaringin', 'Kabupaten Bandung', 'Jawa Barat', 'Indonesia', '40911', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `a_jenis_merkkendaraan`
--
ALTER TABLE `a_jenis_merkkendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `a_modules`
--
ALTER TABLE `a_modules`
  ADD PRIMARY KEY (`identifier`);

--
-- Indeks untuk tabel `a_pengguna`
--
ALTER TABLE `a_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_jabatan_id` (`a_jabatan_id`),
  ADD KEY `a_company_id` (`a_company_id`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_is_deleted` (`is_deleted`),
  ADD KEY `idx_is_active` (`is_active`);

--
-- Indeks untuk tabel `a_pengguna_module`
--
ALTER TABLE `a_pengguna_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_a_pengguna_id` (`a_pengguna_id`),
  ADD KEY `fk_a_modules_identifier` (`a_modules_identifier`);

--
-- Indeks untuk tabel `a_vehicle`
--
ALTER TABLE `a_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `b_bensin`
--
ALTER TABLE `b_bensin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `b_driver`
--
ALTER TABLE `b_driver`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `b_pajak`
--
ALTER TABLE `b_pajak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `c_acservice`
--
ALTER TABLE `c_acservice`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `c_arrival`
--
ALTER TABLE `c_arrival`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `c_departure`
--
ALTER TABLE `c_departure`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `c_monitoring`
--
ALTER TABLE `c_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `c_muatan`
--
ALTER TABLE `c_muatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `d_kirim`
--
ALTER TABLE `d_kirim`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `d_pengiriman`
--
ALTER TABLE `d_pengiriman`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `a_jenis_merkkendaraan`
--
ALTER TABLE `a_jenis_merkkendaraan`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `a_pengguna`
--
ALTER TABLE `a_pengguna`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `a_pengguna_module`
--
ALTER TABLE `a_pengguna_module`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3168;

--
-- AUTO_INCREMENT untuk tabel `a_vehicle`
--
ALTER TABLE `a_vehicle`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `b_bensin`
--
ALTER TABLE `b_bensin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `b_driver`
--
ALTER TABLE `b_driver`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `b_pajak`
--
ALTER TABLE `b_pajak`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `c_acservice`
--
ALTER TABLE `c_acservice`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `c_arrival`
--
ALTER TABLE `c_arrival`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `c_departure`
--
ALTER TABLE `c_departure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `c_monitoring`
--
ALTER TABLE `c_monitoring`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `c_muatan`
--
ALTER TABLE `c_muatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `d_kirim`
--
ALTER TABLE `d_kirim`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `d_pengiriman`
--
ALTER TABLE `d_pengiriman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
