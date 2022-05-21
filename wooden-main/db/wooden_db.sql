-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2022 at 10:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wooden_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `idcart` int(11) NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `tglorder` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'Cart'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`idcart`, `orderid`, `userid`, `tglorder`, `status`) VALUES
(11, '15Swf8Ye0Fm.M', 2, '2020-03-16 12:17:34', 'Cart'),
(12, '15PzF03ejd8W2', 1, '2020-05-13 02:40:48', 'Selesai'),
(13, '16wU6mNgPzlvg', 1, '2022-04-16 09:07:00', 'Selesai'),
(14, '16.zWI9fH0rws', 3, '2022-04-16 11:23:09', 'Selesai'),
(15, '16XR5pWbGbY1w', 3, '2022-04-16 11:38:17', 'Selesai'),
(16, '164GSD/28EeFI', 4, '2022-04-16 12:38:16', 'Selesai'),
(17, '16Uc1BpS3kO0w', 4, '2022-04-16 13:19:10', 'Selesai'),
(18, '16Dmy7X3aaOcU', 4, '2022-04-19 18:29:50', 'Selesai'),
(19, '16EW.sM3M6bH.', 4, '2022-04-21 07:37:18', 'Selesai'),
(20, '16XLam8PFKAPI', 4, '2022-04-21 16:29:38', 'Selesai'),
(21, '16slPlBT1qnhE', 4, '2022-04-23 15:59:45', 'Pengiriman'),
(23, '16DYK49IFIgdM', 4, '2022-04-30 16:12:41', 'Confirmed'),
(24, '16u1E9DDQQK1M', 14, '2022-04-30 16:14:30', 'Cart'),
(25, '16eyfw6XWrnik', 4, '2022-05-11 15:23:46', 'Payment'),
(26, '163maQ4T6z2nY', 4, '2022-05-11 15:34:30', 'Payment'),
(27, '16j5/u.1MC3Yg', 4, '2022-05-11 15:37:14', 'Payment'),
(28, '16SCXcGfndz1o', 4, '2022-05-17 17:24:39', 'Payment'),
(50, '161WIBlaHorGo', 4, '2022-05-21 08:10:04', 'Cart');

-- --------------------------------------------------------

--
-- Table structure for table `detailorder`
--

CREATE TABLE `detailorder` (
  `detailid` int(11) NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detailorder`
--

INSERT INTO `detailorder` (`detailid`, `orderid`, `idproduk`, `qty`) VALUES
(14, '15PzF03ejd8W2', 2, 1),
(19, '164GSD/28EeFI', 3, 5),
(21, '16Dmy7X3aaOcU', 2, 2),
(24, '16EW.sM3M6bH.', 4, 1),
(31, '16XLam8PFKAPI', 4, 1),
(38, '16slPlBT1qnhE', 6, 1),
(39, '16DYK49IFIgdM', 2, 4),
(40, '16DYK49IFIgdM', 6, 1),
(41, '16u1E9DDQQK1M', 5, 1),
(42, '16eyfw6XWrnik', 2, 5),
(43, '163maQ4T6z2nY', 3, 1),
(44, '163maQ4T6z2nY', 7, 1),
(45, '16j5/u.1MC3Yg', 4, 1),
(46, '16j5/u.1MC3Yg', 3, 1),
(47, '16j5/u.1MC3Yg', 8, 1),
(48, '16SCXcGfndz1o', 3, 2),
(71, '161WIBlaHorGo', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `namakategori` varchar(20) NOT NULL,
  `tgldibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`, `tgldibuat`) VALUES
(1, 'Kursi', '2019-12-20 07:28:34'),
(2, 'Meja', '2019-12-20 07:34:17'),
(3, 'Set Kursi Meja', '2020-03-16 12:15:40'),
(4, 'ayunan', '2022-04-15 10:09:24'),
(5, 'Lemari', '2022-04-24 14:34:14'),
(6, 'Meja Rias', '2022-04-30 16:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `idkonfirmasi` int(11) NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment` varchar(10) NOT NULL,
  `namarekening` varchar(25) NOT NULL,
  `tglbayar` date NOT NULL,
  `tglsubmit` timestamp NOT NULL DEFAULT current_timestamp(),
  `alamatpengiriman` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`idkonfirmasi`, `orderid`, `userid`, `payment`, `namarekening`, `tglbayar`, `tglsubmit`, `alamatpengiriman`) VALUES
(9, '16DYK49IFIgdM', 4, 'Bank Mandi', 'Salsabila Ramadhani', '2022-05-11', '2022-05-11 15:13:51', 'Jl. Kalimantan no 189 RT 04');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `userid` int(11) NOT NULL,
  `namalengkap` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tgljoin` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(7) NOT NULL DEFAULT 'Member',
  `lastlogin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userid`, `namalengkap`, `image`, `email`, `password`, `notelp`, `alamat`, `tgljoin`, `role`, `lastlogin`) VALUES
(0, 'admin', 'twice.jpg', 'admin@gmail.com', '$2y$10$GJVGd4ji3QE8ikTBzNyA0uLQhiGd6MirZeSJV1O6nUpjSVp1eaKzS', '081217263547', 'Ambulu, Jember', '2020-03-16 11:31:17', 'admin', NULL),
(2, 'Guest', '', 'guest', '$2y$10$xXEMgj5pMT9EE0QAx3QW8uEn155Je.FHH5SuIATxVheOt0Z4rhK6K', '01234567890', 'Indonesia', '2020-03-16 11:30:40', 'Member', NULL),
(3, 'Dwi Budi Hardiks Dewantara', 'park2.jpg', 'dewa@gmail.com', '$2y$10$qFAbJKxmH.ay9xKYdhoHLO97Jau7evRLy5gYDuIUkSrGhdV2Ih/f.', '081217263545', 'Bukit Permai, Kebonsari, Jember', '2022-04-16 11:19:48', 'pemilik', NULL),
(4, 'Auliasis Dwi Putri', 'ryujin.jpg', 'aulia@gmail.com', '$2y$10$SaRV7ula.p/P8ZeULfcQPuwkOc7iJ9Fbdmz4eC9e.3Gd5GfIUp85S', '0824356786587', 'Kaliwates, Jember', '2022-04-16 12:35:54', 'Member', NULL),
(7, 'Carenina', '', 'nina@gmail.com', '$2y$10$jSboHNjrnaylgnI9eVG/lejCJxB8fnw8X3NPiq.I8jv8wr9KN5uFy', '08976447656', 'jember', '2022-04-17 14:31:29', 'Member', NULL),
(8, 'Almas Firdaus', '', 'almas@gmail.com', '$2y$10$8m5bcnYiJxd1LoUSeev6o.xf4tBB6k24JOrDberdry4WijytMIXJy', '0898786545', 'jember', '2022-04-21 13:42:22', 'Member', NULL),
(13, 'Jelang Fikri', '', 'jelang@gmail.com', '$2y$10$tsE5cvpRao4edB4uvm3HTukMu8bWfIj7RGLy0dT5pW2DO6eDIp0wS', '081217263547', 'jl. kalimantan no 63', '2022-04-30 14:02:38', 'admin', NULL),
(14, 'Nafisah Hani Azzahra', '', 'nafisah@gmail.com', '$2y$10$Z0YoFIHeO77w7QMN5fLU6uqe2I5y2PG1SjmHPe7uyDFpbY065vFuG', '082435678659', 'Jalan Sumatra 56', '2022-04-30 16:14:13', 'Member', NULL),
(15, 'Bachiar Diaz Dzulfikar', 'habibieee.jpeg', 'diaz@gmail.com', '$2y$10$UJU7C/n3cb4nxMRkAO3k8uQx.uFx3HuPLaWxnWxPGRujjKMqSJaee', '0812897878yuy', 'Jl. Jawa 676', '2022-05-07 03:42:23', 'Member', NULL),
(16, 'Salsabila Ramadhani R', 'twice_sana_style_.jpg', 'salsa@gmail.com', '$2y$10$Fs2zb5ZLzAwAeg.TFJsSnO2vecHXaGd4FfPMU38GhEc5sDU5GIvUS', '08128567767', 'Jl. Sriwijaya 02', '2022-05-07 04:06:31', 'Member', NULL),
(17, 'Aulia dwi putri', '', 'lia@gmail.com', '$2y$10$sQRLnMKuFfQ.TaJFZbC/geL0RWbl507UwuKG.qg5LHpI5vhBPviKe', '081214363540', 'Wuluhan, jember, Jawa Timur', '2022-05-07 04:16:24', 'admin', NULL),
(18, 'Putri Maharani', '', 'rani@gmail.com', '$2y$10$DFQzIm1bV99VVUDBlm24pOr0aMkla5G8UgDoMpScelbhtXHJVhMEq', '081253545345', 'Sumbersari, Jember', '2022-05-10 14:16:20', 'Member', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no` int(11) NOT NULL,
  `metode` varchar(25) NOT NULL,
  `norek` varchar(25) NOT NULL,
  `logo` text DEFAULT NULL,
  `an` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`no`, `metode`, `norek`, `logo`, `an`) VALUES
(1, 'Bank BCA', '13131231231', 'images/bca.jpg', 'Wooden Furniture'),
(2, 'Bank Mandiri', '943248844843', 'images/mandiri.jpg', 'Wooden Furniture'),
(3, 'DANA', '0882313132123', 'images/dana.png', 'Wooden Furniture');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `namaproduk` varchar(30) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `rate` int(11) NOT NULL,
  `hargabefore` int(11) NOT NULL,
  `hargaafter` int(11) NOT NULL,
  `tgldibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `idkategori`, `namaproduk`, `gambar`, `deskripsi`, `rate`, `hargabefore`, `hargaafter`, `tgldibuat`) VALUES
(2, 3, 'Set Meja dan Kursi', 'produk/16LMFWfly6i9Y.jpg', 'Meja kursi satu set  ', 0, 778000, 658000, '2019-12-20 09:24:13'),
(3, 6, 'Meja Rias Kayu ', 'produk/16oVRKPvDJJ2I.jpg', 'Meja rias kayu cantik', 0, 790000, 560000, '2020-03-16 12:16:53'),
(4, 3, 'kursi meja ruang tamu', 'produk/164MUoUUq0nZY.jpg', 'Simple Elegant', 0, 3500000, 3200000, '2022-04-19 18:40:13'),
(5, 4, 'Kursi ayunan', 'produk/16j5r0dzUCi7o.jpg', 'Kursi ayunan minimalis ', 0, 650000, 560000, '2022-04-23 22:10:45'),
(6, 2, 'Meja Belajar Aesthetic', 'produk/16Y9KU4XQ4sNI.jpg', 'Meja Belajar (Tanpa Kursi) ', 0, 589000, 449000, '2022-04-24 14:31:54'),
(7, 5, 'Lemari pakaian', 'produk/169XE6xl.XPRU.jpg', 'Lemari Pakaian ', 0, 1300000, 1250000, '2022-04-24 14:34:57'),
(8, 6, 'Meja rias cantik sekali', 'produk/16LMFWfly6i9Y.jpg', 'Meja rias ', 0, 970000, 710000, '2022-05-07 04:12:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idcart`),
  ADD UNIQUE KEY `orderid` (`orderid`),
  ADD KEY `orderid_2` (`orderid`);

--
-- Indexes for table `detailorder`
--
ALTER TABLE `detailorder`
  ADD PRIMARY KEY (`detailid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `idproduk` (`idproduk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`idkonfirmasi`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `idkategori` (`idkategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `idcart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `detailorder`
--
ALTER TABLE `detailorder`
  MODIFY `detailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `idkonfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailorder`
--
ALTER TABLE `detailorder`
  ADD CONSTRAINT `idproduk` FOREIGN KEY (`idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderid` FOREIGN KEY (`orderid`) REFERENCES `cart` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `login` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `idkategori` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
