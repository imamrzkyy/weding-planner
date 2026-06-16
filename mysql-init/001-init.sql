-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2026 at 03:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wo_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `password_admin` varchar(100) NOT NULL,
  `ses_level` enum('admin') DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email_admin`, `password_admin`, `ses_level`) VALUES
(1, 'imam', 'imam@gmail.com', 'admin123', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `paketpernikahan`
--

CREATE TABLE `paketpernikahan` (
  `idPaket` varchar(50) NOT NULL,
  `namaPaket` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi_lengkap` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paketpernikahan`
--

INSERT INTO `paketpernikahan` (`idPaket`, `namaPaket`, `deskripsi`, `harga`, `gambar`, `deskripsi_lengkap`) VALUES
('paket1', 'Paket Silver', 'Paket pernikahan lengkap untuk acara intimate dan elegan dengan dekorasi, makeup, dokumentasi, MC, dan berbagai bonus menarik.', 25000000.00, '1780503070_6a20521ed397e.png', '✨ DEKORASI\r\n• Full Cover Tenda + Dinding Maks 100m\r\n• Full Karpet\r\n• Karpet Jalan\r\n• Pelaminan + Panggung Maks 4-5 Meter\r\n• Taman Pelaminan\r\n• Kursi Pelaminan\r\n• 2 Standing Bunga\r\n• 1 Set Meja + Kursi Akad\r\n• 2 Kotak Amplop (Gembok dari Pengantin)\r\n• 2 Unit Blower\r\n• 50 Kursi Futura + Cover Kursi\r\n• 50 Kursi Plastik + Cover Kursi\r\n• 200 Set Piring, Sendok, Garpu\r\n• 1 Meja Prasmanan\r\n• 5 Rolltop (Ukuran 6 Liter)\r\n• 2 Set Gubukan\r\n• 2 Juicer / Aquarium Es\r\n• 1 Toples Kerupuk\r\n• 1 Sangku Nasi & Termos Nasi\r\n• 1 Meja Penerima Tamu\r\n• 2 Meja Bulat\r\n• 4 Kotak Acrylic Lantai\r\n• Welcome Gate\r\n• Welcome Sign\r\n• Peralatan Masak Standar\r\n\r\n✨ MUA\r\n• Makeup Calon Pengantin\r\n• 2x Retouch Makeup\r\n• 1 Busana Akad CPP & CPW\r\n• 2 Busana Resepsi CPP & CPW\r\n• Hijabdo\r\n• Selop Pengantin\r\n• Makeup & Busana Ibu CPP & CPW\r\n• Busana Bapak CPP & CPW\r\n• Makeup & Busana 4 Pagar Ayu\r\n• Melati Akad CPW\r\n• Kalung Melati CPP\r\n\r\n✨ BONUS / FREE\r\n• Pemakaian Siger Sunda / Solo Putri Hijab / Betawi Hijab\r\n• Henna\r\n• Kuku Palsu\r\n• Softlens Normal\r\n\r\n✨ DOKUMENTASI\r\n• Album Kolase\r\n• Video Cinematic 2-3 Menit\r\n• Soft File Foto Flashdisk\r\n• Edit & Belum Edit\r\n• Maksimal Kerja Sampai Pukul 20.00 WIB\r\n\r\n✨ FREE++\r\n• 1 Pcs Janur (Tanpa Bambu)\r\n• 2 Buku Tamuu'),
('paket2', 'Paket Gold', 'Paket pernikahan dengan fasilitas lebih lengkap dan dekorasi yang lebih luas, cocok untuk pasangan yang menginginkan suasana pernikahan yang meriah dan istimewa.', 27000000.00, '1780509934_6a206ceec4ed5.png', '✨ DEKORASI\r\n• Full Cover Tenda + Dinding Maks 120m\r\n• Full Karpet\r\n• Karpet Jalan\r\n• Pelaminan + Panggung Maks 4-7 Meter\r\n• Taman Pelaminan\r\n• Kursi Pelaminan\r\n• 2 Standing Bunga\r\n• 1 Set Meja + Kursi Akad\r\n• 2 Kotak Amplop (Gembok dari Pengantin)\r\n• 2 Unit Blower\r\n• 100 Kursi Futura + Cover Kursi\r\n• 200 Set Piring, Sendok, Garpu\r\n• 1 Meja Prasmanan\r\n• 5 Rolltop (Ukuran 6 Liter)\r\n• 2 Set Gubukan\r\n• 2 Juicer / Aquarium Es\r\n• 1 Toples Kerupuk\r\n• 1 Sangku Nasi & Termos Nasi\r\n• 1 Meja Penerima Tamu\r\n• 2 Meja Bulat\r\n• 4 Kotak Acrylic Lantai\r\n• Lampu Jalan\r\n• Gazebo\r\n• Welcome Gate\r\n• Welcome Sign Mirror\r\n• Peralatan Masak Standar\r\n\r\n✨ MUA\r\n• Makeup Calon Pengantin\r\n• 2x Retouch Makeup\r\n• 1 Busana Akad CPP & CPW\r\n• 2 Busana Resepsi CPP & CPW\r\n• Hijabdo\r\n• Selop Pengantin\r\n• Makeup & Busana Ibu CPP & CPW\r\n• Busana Bapak CPP & CPW\r\n• Makeup & Busana 4 Pagar Ayu\r\n• Melati Akad CPW\r\n• Kalung Melati CPP\r\n\r\n✨ BONUS / FREE\r\n• Pemakaian Siger Sunda / Solo Putri Hijab / Betawi Hijab\r\n• Henna\r\n• Kuku Palsu\r\n• Softlens Normal\r\n\r\n✨ DOKUMENTASI\r\n• Album Kolase\r\n• Video Cinematic 2-3 Menit\r\n• Soft File Foto Flashdisk\r\n• Edit & Belum Edit\r\n• Maksimal Kerja Sampai Pukul 20.00 WIB\r\n\r\n✨ FREE++\r\n• 1 Pcs Janur (Tanpa Bambu)\r\n• 2 Buku Tamu'),
('paket3', 'Paket Platinum', 'Paket pernikahan premium dengan fasilitas eksklusif dan layanan terbaik untuk menghadirkan pengalaman pernikahan yang mewah, elegan, dan tak terlupakan.', 30000000.00, '1780513087_6a20793fa360c.png', '✨ DEKORASI\r\n• Full Cover Tenda + Dinding Maks 160m\r\n• Full Karpet\r\n• Karpet Jalan\r\n• Pelaminan + Panggung Maks 4-8 Meter\r\n• Taman Pelaminan\r\n• Kursi Pelaminan\r\n• 4 Standing Bunga\r\n• 1 Set Meja + Kursi Akad\r\n• 2 Kotak Amplop (Gembok dari Pengantin)\r\n• 3 Unit Blower\r\n• 100 Kursi Futura + Cover Kursi\r\n• 20 Kursi Plastik + Cover Kursi\r\n• 200 Set Piring, Sendok, Garpu\r\n• 2 Meja Prasmanan\r\n• 5 Rolltop (Ukuran 9 Liter)\r\n• 5 Pcs Semi Rolltop\r\n• 3 Set Gubukan\r\n• 2 Juicer / Aquarium Es\r\n• 2 Toples Kerupuk\r\n• 2 Sangku Nasi & Termos Nasi\r\n• 2 Meja Penerima Tamu\r\n• 2 Meja Bulat\r\n• 12 Kotak Acrylic Lantai\r\n• Lampu Jalan\r\n• Gazebo\r\n• Welcome Gate\r\n• Welcome Sign Mirror\r\n• Peralatan Masak Standar\r\n\r\n✨ MUA\r\n• Makeup Calon Pengantin\r\n• 2x Retouch Makeup\r\n• 1 Busana Akad CPP & CPW\r\n• 2 Busana Resepsi CPP & CPW\r\n• Hijabdo / Hairdo\r\n• Selop Pengantin\r\n• Makeup & Busana Ibu CPP & CPW\r\n• Busana Bapak CPP & CPW\r\n• Makeup & Busana 4 Pagar Ayu\r\n• Melati Akad CPW\r\n• Kalung Melati CPP\r\n\r\n✨ BONUS / FREE\r\n• Pemakaian Siger Sunda / Solo Putri Hijab / Betawi Hijab / Sumatera Hijab\r\n• Henna\r\n• Kuku Palsu\r\n• Softlens Normal\r\n\r\n✨ DOKUMENTASI\r\n• Album Kolase\r\n• Video Cinematic 2-3 Menit\r\n• Soft File Foto Flashdisk\r\n• Edit & Belum Edit\r\n• Maksimal Kerja Sampai Pukul 20.00 WIB\r\n\r\n✨ FREE++\r\n• 1 Pcs Janur (Tanpa Bambu)\r\n• 2 Buku Tamu');

-- --------------------------------------------------------

--
-- Table structure for table `paket_gambar_detail`
--

CREATE TABLE `paket_gambar_detail` (
  `idGambar` int(11) NOT NULL,
  `idPaket` varchar(20) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_gambar_detail`
--

INSERT INTO `paket_gambar_detail` (`idGambar`, `idPaket`, `gambar`) VALUES
(2, 'paket1', '1780505553_6a205bd185a13.png'),
(3, 'paket1', '1780506597_6a205fe5d0e55.jpeg'),
(4, 'paket2', '1780509934_6a206ceec713e.jpeg'),
(5, 'paket2', '1780509934_6a206ceec89f3.png'),
(6, 'paket3', '1780513087_6a20793fa50af.jpeg'),
(7, 'paket3', '1780513087_6a20793fa63f6.png');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idPelanggan` varchar(50) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `ses_level` enum('user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idPelanggan`, `nama`, `email`, `password`, `alamat`, `telepon`, `ses_level`) VALUES
('P001', 'joko', 'joko@gmail.com', 'joko', 'joko', '08976373728', 'user'),
('P002', 'satria', 'satria@gmail.com', 'satria', 'prabumulih', '089733527828', 'user'),
('P003', 'mulyono', 'mulyono@gmail.com', 'hana', 'hdhdhdhjdjdjdd', '08227899999', 'user'),
('P004', 'dyas', 'dyas@gmail.com', 'dyas', 'bandar lampung', '9865775445', 'user'),
('P005', 'nuril', 'nuril@gmail.com', 'nuril', 'lampung', '26546557575', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `idPelanggan` varchar(50) DEFAULT NULL,
  `idPaket` varchar(50) DEFAULT NULL,
  `tanggalPesan` date DEFAULT NULL,
  `statusPesanan` varchar(50) DEFAULT NULL,
  `statusPembayaran` varchar(50) DEFAULT NULL,
  `jumlahPembayaran` decimal(15,2) DEFAULT NULL,
  `tanggalPembayaran` date DEFAULT NULL,
  `metodePembayaran` varchar(50) DEFAULT NULL,
  `transactionId` text NOT NULL,
  `Tambahan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `idPelanggan`, `idPaket`, `tanggalPesan`, `statusPesanan`, `statusPembayaran`, `jumlahPembayaran`, `tanggalPembayaran`, `metodePembayaran`, `transactionId`, `Tambahan`) VALUES
(19, 'P001', 'paket2', '2026-04-24', 'selesai', 'Lunas', 8000000.00, NULL, 'Lunas', 'c68ee150-51fa-4be7-a5ea-ff231d6ccc69', NULL),
(20, 'P001', 'paket2', '2026-05-14', 'selesai', 'Lunas', 8000000.00, NULL, 'Lunas', '6228f7c9-0c11-466d-a342-84771884184d', NULL),
(21, 'P001', 'paket2', '2026-05-14', 'selesai', 'Lunas', 20000000.00, NULL, 'Lunas', '90386d48-6208-40fa-976b-ba7b0b3fdb58', NULL),
(25, 'P001', 'paket2', '2026-05-19', 'selesai', 'Lunas', 8000000.00, NULL, 'Lunas', 'd1f9f482-2b35-48fc-a6f2-3ddd522be8f4', NULL),
(26, 'P001', 'paket2', '2026-05-20', 'selesai', 'Lunas', 8000000.00, NULL, 'Lunas', 'b6e3b50a-9623-4576-a006-43ecff3f918a', NULL),
(27, 'P001', 'paket3', '2026-05-25', 'selesai', 'Lunas', 15270000.00, NULL, 'Lunas', '45a2c665-2fda-41cb-a15d-4c6218e1e273', 'Fotografer: 1,\nMakeup: 1,\nBaju: 1,\nAlat Makan: 1,\nMC: 1,\nCatering: 1'),
(29, 'P001', 'paket2', '2026-05-28', 'selesai', 'Lunas', 8000000.00, '2026-05-27', 'Lunas', '5bb8d546-7880-4639-b934-219161374059', 'Fotografer: 0,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(30, 'P001', 'paket2', '2026-05-25', 'selesai', 'Lunas', 8000000.00, NULL, 'Lunas', 'd4dedd87-9797-4c19-9cc2-79d99424d8e7', 'Fotografer: 0,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(31, 'P001', 'paket2', '2026-05-22', 'selesai', 'Lunas', 8000000.00, NULL, 'Lunas', '49a26322-522e-466c-a741-6c84b8d06ef1', 'Fotografer: 0,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(32, 'P001', 'paket3', '2026-05-21', 'selesai', 'Lunas', 14000000.00, NULL, 'Lunas', '70934a03-cd94-45b5-a418-2663972f9056', 'Fotografer: 1,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 1,\nCatering: 0'),
(40, 'P001', 'paket2', '2026-05-13', 'selesai', 'Lunas', 8000000.00, '2026-06-01', 'Lunas', '2a5baaf6-47e2-4c44-910b-e2168f3a8f36', 'Fotografer: 0,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(41, 'P001', 'paket3', '2026-05-31', 'selesai', 'Lunas', 12000000.00, '2026-05-09', 'Lunas', '30643fb5-512c-4a44-b7aa-36e44273afa3', 'Fotografer: 0,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(42, 'P001', 'paket2', '2026-05-27', 'selesai', 'Lunas', 8000000.00, NULL, 'Lunas', '761da98a-fd59-4760-b689-88b098409eed', 'Fotografer: 0,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(43, 'P002', 'paket1', '2026-05-22', 'selesai', 'Lunas', 5000000.00, '2026-05-18', 'Lunas', '03d48855-4809-4ef7-8263-05b678f78473', 'Fotografer: 0,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(44, 'P001', 'paket1', '2026-05-18', 'selesai', 'Lunas', 9570000.00, NULL, 'Lunas', '424f1303-966c-4a7e-abad-cf8f92d6dd88', 'Fotografer: 2,\nMakeup: 3,\nBaju: 0,\nAlat Makan: 1,\nMC: 1,\nCatering: 1'),
(46, 'P002', 'paket3', '2026-05-22', 'selesai', 'Lunas', 20940000.00, NULL, 'Lunas', '36d02b6b-92ae-4654-afae-46c94d709022', 'Fotografer: 2,\nMakeup: 2,\nBaju: 2,\nAlat Makan: 2,\nMC: 2,\nCatering: 50'),
(47, 'P002', 'paket3', '2026-05-30', 'selesai', 'Lunas', 31000000.00, NULL, 'Lunas', 'c1c71934-f467-4368-b883-3cf22f388ac9', 'adat: 1,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(48, 'P002', 'paket2', '2026-06-04', 'selesai', 'Lunas', 28000000.00, NULL, 'Lunas', 'c72810e1-afe9-4b6c-812c-c19e0ee24305', 'adat: 1,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(49, 'P002', 'paket3', '2026-06-02', 'selesai', 'Lunas', 35000000.00, '2026-05-27', 'Lunas', '82769da2-6550-4088-b299-1ca24061b24b', 'adat: 5,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(50, 'P001', 'paket3', '2026-06-10', 'selesai', 'Lunas', 30000000.00, '2026-05-28', 'Lunas', 'ec3ffbbc-a427-4f7f-83c5-e3a760bcec13', 'adat: 0,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(51, 'P001', 'paket3', '2026-06-19', 'selesai', 'Lunas', 30000000.00, '2026-06-01', 'Lunas', '99a52f62-e12b-494e-b63b-219509aacf9f', 'adat: 0,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(52, 'P005', 'paket3', '2026-06-30', 'selesai', 'Lunas', 30000000.00, '2026-06-04', 'Lunas', '6bfbd20b-776c-465f-a456-771770741ca4', 'adat: 0,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(53, 'P001', 'paket3', '2026-06-30', 'selesai', 'Lunas', 30000000.00, '2026-06-04', 'Lunas', '815cf03a-25ae-4812-a6ef-dcab5c391fd6', 'adat: 0,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(54, 'P005', 'paket3', '2026-06-29', 'selesai', 'Lunas', 30000000.00, '2026-06-04', 'Lunas', '71f3159c-1461-4814-b376-8f893cbb8f07', 'adat: 0,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(55, 'P001', 'paket3', '2026-06-20', 'selesai', 'Lunas', 31000000.00, '2026-06-06', 'Lunas', '6c174709-d134-4bd1-bd39-9a710cd74f2c', 'adat: 1,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0'),
(56, 'P005', 'paket2', '2026-06-29', NULL, 'settlement', 27000000.00, '2026-06-06', 'Lunas', 'a6a555a2-b831-495b-8272-83f1314745d3', 'adat: 0,\nMakeup: 0,\nBaju: 0,\nAlat Makan: 0,\nMC: 0,\nCatering: 0');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `idTestimoni` varchar(50) NOT NULL,
  `idPelanggan` varchar(50) DEFAULT NULL,
  `isiTestimoni` text DEFAULT NULL,
  `tanggalTestimoni` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`idTestimoni`, `idPelanggan`, `isiTestimoni`, `tanggalTestimoni`) VALUES
('TST007', 'P005', 'keren sekalii', '2026-06-06'),
('TST008', 'P005', 'bagus banget', '2026-06-06'),
('TST6a23d39c6d086', 'P001', 'Acara pernikahan kami sangat berkesan. Pelayanan yang luar biasa dari awal hingga akhir. Terima kasih banyak!', '2026-06-06'),
('TST6a23d3fe77c85', 'P002', 'Konsep dan dekorasi sangat sesuai dengan impian kami. Semua tamu pun sangat puas. Highly recommended!', '2026-06-06'),
('TST6a23d44b425b8', 'P005', 'Tim WO sangat ramah dan profesional. Tidak ada yang perlu dikhawatirkan di hari H. Semua berjalan sempurna!', '2026-06-06'),
('TST6a23d73644daa', 'P005', 'waw', '2026-06-06'),
('TST6a23d741b7881', 'P005', 'masyaaallah', '2026-06-06'),
('TST6a23d74e5707b', 'P005', 'sangat bagus', '2026-06-06'),
('TST6a23d75d5ace7', 'P005', 'rekomendasi woo!!!', '2026-06-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email_admin` (`email_admin`);

--
-- Indexes for table `paketpernikahan`
--
ALTER TABLE `paketpernikahan`
  ADD PRIMARY KEY (`idPaket`);

--
-- Indexes for table `paket_gambar_detail`
--
ALTER TABLE `paket_gambar_detail`
  ADD PRIMARY KEY (`idGambar`),
  ADD KEY `idPaket` (`idPaket`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idPelanggan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPelanggan` (`idPelanggan`),
  ADD KEY `idPaket` (`idPaket`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`idTestimoni`),
  ADD KEY `idPelanggan_2` (`idPelanggan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paket_gambar_detail`
--
ALTER TABLE `paket_gambar_detail`
  MODIFY `idGambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `paket_gambar_detail`
--
ALTER TABLE `paket_gambar_detail`
  ADD CONSTRAINT `paket_gambar_detail_ibfk_1` FOREIGN KEY (`idPaket`) REFERENCES `paketpernikahan` (`idPaket`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`idPelanggan`) REFERENCES `pelanggan` (`idPelanggan`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`idPaket`) REFERENCES `paketpernikahan` (`idPaket`);

--
-- Constraints for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD CONSTRAINT `fk_testimoni_pelanggan` FOREIGN KEY (`idPelanggan`) REFERENCES `pelanggan` (`idPelanggan`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
