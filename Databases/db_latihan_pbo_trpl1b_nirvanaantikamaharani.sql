-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2026 at 02:58 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihan_pbo_trpl1b_nirvanaantikamaharani`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_tiket`
--

CREATE TABLE `tabel_tiket` (
  `id_tiket` int NOT NULL,
  `nama_film` varchar(100) NOT NULL,
  `jadwal_tayang` datetime NOT NULL,
  `jumlah_kursi` int NOT NULL,
  `harga_dasar_tiket` decimal(10,2) NOT NULL,
  `jenis_studio` enum('Regular','IMAX','Velvet') NOT NULL,
  `tipe_audio` varchar(50) DEFAULT NULL,
  `lokasi_baris` varchar(50) DEFAULT NULL,
  `kacamata_3d_id` varchar(50) DEFAULT NULL,
  `efek_gerak_fitur` varchar(100) DEFAULT NULL,
  `bantal_selimut_pack` varchar(50) DEFAULT NULL,
  `layanan_butler` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_tiket`
--

INSERT INTO `tabel_tiket` (`id_tiket`, `nama_film`, `jadwal_tayang`, `jumlah_kursi`, `harga_dasar_tiket`, `jenis_studio`, `tipe_audio`, `lokasi_baris`, `kacamata_3d_id`, `efek_gerak_fitur`, `bantal_selimut_pack`, `layanan_butler`) VALUES
(1, 'Mean Girls', '2026-06-20 13:00:00', 50, 40000.00, 'Regular', 'Dolby Digital', 'Row A', NULL, NULL, NULL, NULL),
(2, 'Mean Girls', '2026-06-20 16:00:00', 50, 40000.00, 'Regular', 'Dolby Digital', 'Row B', NULL, NULL, NULL, NULL),
(3, 'Clueless', '2026-06-21 14:00:00', 45, 35000.00, 'Regular', 'Standard Stereo', 'Row C', NULL, NULL, NULL, NULL),
(4, 'Legally Blonde', '2026-06-21 19:00:00', 45, 45000.00, 'Regular', 'Standard Stereo', 'Row D', NULL, NULL, NULL, NULL),
(5, 'The Devil Wears Prada', '2026-06-22 10:00:00', 60, 35000.00, 'Regular', 'Dolby Digital', 'Row E', NULL, NULL, NULL, NULL),
(6, 'The Princess Diaries', '2026-06-22 15:00:00', 60, 40000.00, 'Regular', 'Dolby Digital', 'Row F', NULL, NULL, NULL, NULL),
(7, '13 Going on 30', '2026-06-23 13:00:00', 50, 40000.00, 'Regular', 'Dolby Digital', 'Row G', NULL, NULL, NULL, NULL),
(8, 'Moana', '2026-06-20 14:00:00', 100, 75000.00, 'IMAX', 'Dolby Atmos', 'Row IMAX-A', 'GLASSES-3D-M1', 'Water Splash FX', NULL, NULL),
(9, 'Moana', '2026-06-20 18:00:00', 100, 75000.00, 'IMAX', 'Dolby Atmos', 'Row IMAX-B', 'GLASSES-3D-M2', 'Water Splash FX', NULL, NULL),
(10, 'Frozen 2', '2026-06-21 13:00:00', 80, 70000.00, 'IMAX', 'IMAX 6-Track', 'Row Center', 'GLASSES-3D-F1', 'Snow & Wind FX', NULL, NULL),
(11, 'Frozen 2', '2026-06-21 17:00:00', 80, 70000.00, 'IMAX', 'IMAX 6-Track', 'Row Upper', 'GLASSES-3D-F2', 'Snow & Wind FX', NULL, NULL),
(12, 'Tangled', '2026-06-22 19:00:00', 90, 80000.00, 'IMAX', 'Dolby Atmos', 'Row A', 'GLASSES-3D-T1', 'Light & Sparkle FX', NULL, NULL),
(13, 'Barbie as the Princess and the Pauper', '2026-06-22 22:00:00', 90, 80000.00, 'IMAX', 'Dolby Atmos', 'Row B', NULL, 'Magic Vibration', NULL, NULL),
(14, 'Enchanted', '2026-06-23 16:00:00', 80, 70000.00, 'IMAX', 'Dolby Atmos', 'Row C', NULL, 'Subwoofer Bass', NULL, NULL),
(15, 'Gossip Girl: The Movie Event', '2026-06-20 20:00:00', 20, 150000.00, 'Velvet', NULL, 'Sofa Lounge 1', NULL, NULL, 'Pink Silk Blanket', 'Macarons & Tea Service'),
(16, 'Gossip Girl: The Movie Event', '2026-06-21 20:00:00', 20, 150000.00, 'Velvet', NULL, 'Sofa Lounge 2', NULL, NULL, 'Pink Silk Blanket', 'Macarons & Tea Service'),
(17, 'High School Musical', '2026-06-22 13:00:00', 15, 120000.00, 'Velvet', NULL, 'Suite A', NULL, NULL, 'Premium Quilt Pack', 'Snacks & Cupcakes Butler'),
(18, 'Camp Rock', '2026-06-22 17:00:00', 15, 120000.00, 'Velvet', NULL, 'Suite B', NULL, NULL, 'Premium Quilt Pack', 'Snacks & Cupcakes Butler'),
(19, 'Mamma Mia!', '2026-06-23 19:00:00', 25, 130000.00, 'Velvet', NULL, 'VIP Row 1', NULL, NULL, 'Luxury Soft Pillow', 'Full Service Butler'),
(20, 'Wild Child', '2026-06-23 21:30:00', 25, 130000.00, 'Velvet', NULL, 'VIP Row 2', NULL, NULL, 'Luxury Velvet Blanket', 'Personal Butler Service');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  MODIFY `id_tiket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
