-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 04:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_buah`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `kategori_produk` varchar(50) NOT NULL,
  `deskripsi_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `kategori_produk`, `deskripsi_produk`) VALUES
(1, 'Apel', 'Buah Segar', 'Apel segar, kaya akan serat dan vitamin. Cocok untuk camilan sehat dan olahan jus.'),
(2, 'Jeruk', 'Buah Segar', 'Jeruk segar penuh dengan vitamin C untuk menjaga daya tahan tubuh Anda.'),
(3, 'Mangga', 'Buah Segar', 'Mangga manis dan segar.'),
(4, 'Anggur', 'Buah Segar', 'Anggur segar, kaya akan antioksidan.'),
(5, 'Pisang', 'Buah Segar', 'Pisang segar dengan kandungan kalium tinggi.'),
(6, 'Jus Apel', 'Jus Segar', 'Jus apel segar yang terbuat dari apel berkualitas tinggi, kaya akan vitamin dan rasa manis alami.'),
(7, 'Jus Jeruk', 'Jus Segar', 'Jus jeruk segar yang menyegarkan, mengandung vitamin C yang tinggi dan rasa asam manis.'),
(8, 'Jus Mangga', 'Jus Segar', 'Jus mangga manis dan creamy, terbuat dari mangga matang yang memberikan rasa eksotis.'),
(9, 'Jus Strawberry', 'Jus Segar', 'Jus strawberry segar yang cerah dan penuh rasa, cocok untuk pencuci mulut atau minuman sehari-hari.'),
(10, 'Jus Campuran', 'Jus Segar', 'Campuran berbagai buah segar yang menyehatkan, nikmati kombinasi rasa yang unik.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
