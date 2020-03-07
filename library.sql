-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 09 Jan 2019 pada 08.08
-- Versi Server: 5.6.14
-- Versi PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `library`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailkarir`
--

CREATE TABLE IF NOT EXISTS `detailkarir` (
  `id_karir` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengantin` char(11) NOT NULL,
  `perusahaan` varchar(50) NOT NULL,
  `tahun` char(4) NOT NULL,
  `pihak` char(1) NOT NULL,
  PRIMARY KEY (`id_karir`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `detailkarir`
--

INSERT INTO `detailkarir` (`id_karir`, `id_pengantin`, `perusahaan`, `tahun`, `pihak`) VALUES
(1, 'CP180526001', 'LP3I Tasikmalaya', '2014', 'P'),
(3, 'CP180526001', 'Gatsu', '2018', 'W');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailpdd`
--

CREATE TABLE IF NOT EXISTS `detailpdd` (
  `id_pdd` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengantin` char(11) NOT NULL,
  `tingkat` varchar(5) NOT NULL,
  `namasekolah` varchar(50) NOT NULL,
  `tahun` char(4) NOT NULL,
  `pihak` char(1) NOT NULL,
  PRIMARY KEY (`id_pdd`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `detailpdd`
--

INSERT INTO `detailpdd` (`id_pdd`, `id_pengantin`, `tingkat`, `namasekolah`, `tahun`, `pihak`) VALUES
(1, 'CP180526001', 'SD', 'SDN 3 Gunungcupu', '2011', 'P'),
(3, 'CP180526001', 'SD', 'SDN 3 Baregbeg', '2011', 'W'),
(4, 'CP180526001', 'SMP', 'Mts Persis Sindangkasih', '2018', 'P'),
(6, 'CP180526001', 'SMP', 'MTS Persis Sindangkasih', '2014', 'W');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailsaudara`
--

CREATE TABLE IF NOT EXISTS `detailsaudara` (
  `id_saudara` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengantin` char(11) NOT NULL,
  `nama_saudara` varchar(50) NOT NULL,
  `pihak` char(1) NOT NULL,
  PRIMARY KEY (`id_saudara`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `detailsaudara`
--

INSERT INTO `detailsaudara` (`id_saudara`, `id_pengantin`, `nama_saudara`, `pihak`) VALUES
(6, 'CP180526001', 'Fauzi', 'W'),
(7, 'CP180527002', 'Jajang', 'P'),
(8, 'CP180527002', 'Ujang', 'P');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenisvendor`
--

CREATE TABLE IF NOT EXISTS `jenisvendor` (
  `id_jenisvendor` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_vendor` varchar(20) NOT NULL,
  `opsi` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_jenisvendor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `jenisvendor`
--

INSERT INTO `jenisvendor` (`id_jenisvendor`, `jenis_vendor`, `opsi`) VALUES
(2, 'VENUE / GEDUNG', 'single'),
(3, 'MAKEUP', 'single'),
(4, 'WARDROBE', 'single'),
(5, 'CATERING', 'single'),
(6, 'PHOTO', 'single'),
(7, 'VIDEO', 'single');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE IF NOT EXISTS `paket` (
  `id_paket` int(11) NOT NULL AUTO_INCREMENT,
  `nama_paket` varchar(50) NOT NULL,
  `detail_paket` text NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `detail_paket`, `harga`, `foto`, `id_vendor`) VALUES
(3, 'Paket Hemat', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Ukuran 10 x 10&nbsp;</p>\r\n<p>WC 2</p>\r\n<p>AC</p>\r\n</body>\r\n</html>', 1000000, '1-Paket_Hemat.jpg', 1),
(5, 'Paket Special', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Ukuran 10 x 10</p>\r\n<p>Kamar Mandi</p>\r\n<p>AC</p>\r\n</body>\r\n</html>', 1000000, '1-Paket_Special.jpg', 1),
(6, 'Paket Lebarang', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Ukuran 9 x 8</p>\r\n<p>AC</p>\r\n<p>Kamar mandi</p>\r\n<p>Dapur</p>\r\n</body>\r\n</html>', 8000000, '3-Paket_Lebarang.jpg', 3),
(7, 'Paket 1000 Porsi', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Ayam Suwir</p>\r\n<p>Sayur Soap</p>\r\n<p>Mustafa</p>\r\n</body>\r\n</html>', 5000000, '2-Paket_1000_Porsi.jpg', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengantin`
--

CREATE TABLE IF NOT EXISTS `pengantin` (
  `id_pengantin` char(11) NOT NULL,
  `tgl_event` date NOT NULL,
  `nama_pp` varchar(50) NOT NULL,
  `nohppp` varchar(13) NOT NULL,
  `tempatlahir_pp` varchar(50) NOT NULL,
  `tgl_lahir_pp` date NOT NULL,
  `namaayah_pp` varchar(50) NOT NULL,
  `namaibu_pp` varchar(50) NOT NULL,
  `alamat_pp` varchar(100) NOT NULL,
  `nama_pw` varchar(50) NOT NULL,
  `nohppw` varchar(13) NOT NULL,
  `tempatlahir_pw` varchar(50) NOT NULL,
  `tgl_lahir_pw` date NOT NULL,
  `namaayah_pw` varchar(50) NOT NULL,
  `namaibu_pw` varchar(50) NOT NULL,
  `alamat_pw` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pengantin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengantin`
--

INSERT INTO `pengantin` (`id_pengantin`, `tgl_event`, `nama_pp`, `nohppp`, `tempatlahir_pp`, `tgl_lahir_pp`, `namaayah_pp`, `namaibu_pp`, `alamat_pp`, `nama_pw`, `nohppw`, `tempatlahir_pw`, `tgl_lahir_pw`, `namaayah_pw`, `namaibu_pw`, `alamat_pw`) VALUES
('CP180526001', '2018-06-01', 'Adam Abdi Al Ala', '12232323', 'Ciamis', '1993-07-16', 'Edien', 'Tety', '', 'Fitriani Nur hidayah', '898908089080', 'Ciamis', '2018-05-22', 'Engkus', '-', ''),
('CP180527002', '2018-06-01', 'Muhamad Aripin', '08978675661', 'Tasikmalaya', '2018-05-01', 'Maman', 'Mimin', '', 'Ayu Sri Rahayu', '089767897712', 'Tasikmalaya', '2018-04-01', 'Momon', 'Mumun', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `plan_fixed`
--

CREATE TABLE IF NOT EXISTS `plan_fixed` (
  `id_plan` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` char(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id_plan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data untuk tabel `plan_fixed`
--

INSERT INTO `plan_fixed` (`id_plan`, `id_client`, `id_paket`, `harga`) VALUES
(47, 'CP180526001', 5, 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmpkarir`
--

CREATE TABLE IF NOT EXISTS `tmpkarir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perusahaan` varchar(50) NOT NULL,
  `tahun` char(4) NOT NULL,
  `pihak` char(1) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmppdd`
--

CREATE TABLE IF NOT EXISTS `tmppdd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tingkat` varchar(5) NOT NULL,
  `namasekolah` varchar(50) NOT NULL,
  `tahun` char(4) NOT NULL,
  `pihak` char(1) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmpsaudara`
--

CREATE TABLE IF NOT EXISTS `tmpsaudara` (
  `id_saudara` int(11) NOT NULL AUTO_INCREMENT,
  `nama_saudara` varchar(50) NOT NULL,
  `pihak` char(1) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_saudara`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password`) VALUES
(1, 'Adam Abdi Al A''la', 'adam', 'adam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `id_vendor` int(11) NOT NULL AUTO_INCREMENT,
  `nama_vendor` varchar(50) NOT NULL,
  `id_jenisvendor` int(11) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_vendor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `nama_vendor`, `id_jenisvendor`, `foto`) VALUES
(1, 'Gedung Dakwah Tasikmalaya', 2, 'Gedung_Dakwah_Tasikmalaya.jpg'),
(2, 'Samudra Resto', 5, '2-Samudra_Resto.jpg'),
(3, 'Gedung Renald', 2, NULL),
(4, 'Aulia Hall Centre', 2, NULL),
(5, 'Gedung Dakwah Sindangkasih', 2, NULL),
(6, 'Gedung Dakwah Cikoneng', 2, 'Gedung_Dakwah_Cikoneng.JPG');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
