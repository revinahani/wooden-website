-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2022 at 06:24 PM
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
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `idBahan` varchar(10) NOT NULL,
  `bahan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `idBarang` varchar(11) NOT NULL,
  `idKategori` varchar(10) DEFAULT NULL,
  `gambar` blob NOT NULL,
  `berat` int(11) NOT NULL,
  `idBahan` varchar(10) NOT NULL,
  `custom` enum('Bisa','Tidak Bisa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(21, '16slPlBT1qnhE', 4, '2022-04-23 15:59:45', 'Confirmed'),
(23, '16DYK49IFIgdM', 4, '2022-04-30 16:12:41', 'Cart'),
(24, '16u1E9DDQQK1M', 14, '2022-04-30 16:14:30', 'Cart');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `idCustomer` varchar(10) NOT NULL,
  `gambar` blob NOT NULL,
  `namaCustomer` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `jenisKelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `jalan` varchar(30) NOT NULL,
  `idKabupaten` varchar(10) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`idCustomer`, `gambar`, `namaCustomer`, `username`, `password`, `tanggalLahir`, `jenisKelamin`, `telepon`, `email`, `jalan`, `idKabupaten`, `role`) VALUES
('1', 0x556e7469746c65642064657369676e2e706e67, 'Revina Hani Rahmadilla', 'revinarahmadilla', '$2y$10$6uOV72MZMYno5qyNhDFzeex', '2001-10-01', '', '081234546567', 'revinahani30@gmail.com', 'Jl. S. Parman', 'Jember', 'customer'),
('2', 0x6e796f6261206564697420332e6a7067, 'Revina Rahmadilla', 'revina10', '$2y$10$s4S4M.jwoEkYeC/S8D0w4eR', '2001-10-02', '', '081236786876', 'revinahani9@gmail.com', 'Jl. S. Parman GG', 'Jember', 'customer');

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
(39, '16DYK49IFIgdM', 2, 1),
(40, '16DYK49IFIgdM', 6, 1),
(41, '16u1E9DDQQK1M', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_barang`
--

CREATE TABLE `detail_barang` (
  `idBarang` varchar(10) NOT NULL,
  `idBahan` varchar(10) NOT NULL,
  `idKategori` varchar(10) CHARACTER SET utf8 NOT NULL,
  `namaBarang` varchar(30) NOT NULL,
  `bahan` enum('Jati','Mahoni','Sengon') NOT NULL,
  `stock` int(11) NOT NULL,
  `harga` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan_adminitrasi`
--

CREATE TABLE `karyawan_adminitrasi` (
  `idKaryawan` varchar(10) NOT NULL,
  `gambar` blob NOT NULL,
  `namaKaryawan` varchar(30) NOT NULL,
  `tanggalLahirKaryawan` date NOT NULL,
  `idAsal` varchar(10) NOT NULL,
  `teleponKaryawan` varchar(15) NOT NULL,
  `tanggalMasukKaryawan` date NOT NULL,
  `statusKaryawan` enum('Aktif','Cuti','Pensiun') NOT NULL,
  `keterangan` varchar(80) NOT NULL,
  `email` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan_adminitrasi`
--

INSERT INTO `karyawan_adminitrasi` (`idKaryawan`, `gambar`, `namaKaryawan`, `tanggalLahirKaryawan`, `idAsal`, `teleponKaryawan`, `tanggalMasukKaryawan`, `statusKaryawan`, `keterangan`, `email`, `password`, `role`) VALUES
('', 0x47726166696b2041727573204c696e65203220567320506572636f6261616e202853656b756e646572292e706e67, 'Jelang Fikri', '2022-04-15', 'Jakarta', '082345678654', '2022-04-15', 'Aktif', '', 'jelang', '$2y$10$jGv', 'admin');

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
  `tglsubmit` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`idkonfirmasi`, `orderid`, `userid`, `payment`, `namarekening`, `tglbayar`, `tglsubmit`) VALUES
(8, '16slPlBT1qnhE', 4, 'Bank BCA', 'Auliassisssss', '2022-04-25', '2022-04-24 18:16:54');

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
(0, 'admin', 'sana.jpeg', 'admin@gmail.com', '$2y$10$GJVGd4ji3QE8ikTBzNyA0uLQhiGd6MirZeSJV1O6nUpjSVp1eaKzS', '01234567867', 'Ambulu, Jember', '2020-03-16 11:31:17', 'admin', NULL),
(2, 'Guest', '', 'guest', '$2y$10$xXEMgj5pMT9EE0QAx3QW8uEn155Je.FHH5SuIATxVheOt0Z4rhK6K', '01234567890', 'Indonesia', '2020-03-16 11:30:40', 'Member', NULL),
(3, 'Dwi Budi Hardiks Dewantara', 'park2.jpg', 'dewa@gmail.com', '$2y$10$qFAbJKxmH.ay9xKYdhoHLO97Jau7evRLy5gYDuIUkSrGhdV2Ih/f.', '081217263545', 'Bukit Permai, Kebonsari, Jember', '2022-04-16 11:19:48', 'pemilik', NULL),
(4, 'Auliassisssss', 'ryujin.jpg', 'aulia@gmail.com', '$2y$10$SaRV7ula.p/P8ZeULfcQPuwkOc7iJ9Fbdmz4eC9e.3Gd5GfIUp85S', '082435678654', 'Arjasa, Jember', '2022-04-16 12:35:54', 'Member', NULL),
(7, 'Carenina', '', 'nina@gmail.com', '$2y$10$jSboHNjrnaylgnI9eVG/lejCJxB8fnw8X3NPiq.I8jv8wr9KN5uFy', '08976447656', 'jember', '2022-04-17 14:31:29', 'Member', NULL),
(8, 'Almas Firdaus', '', 'almas@gmail.com', '$2y$10$8m5bcnYiJxd1LoUSeev6o.xf4tBB6k24JOrDberdry4WijytMIXJy', '0898786545', 'jember', '2022-04-21 13:42:22', 'Member', NULL),
(13, 'jelang', '', 'jelang@gmail.com', '$2y$10$tsE5cvpRao4edB4uvm3HTukMu8bWfIj7RGLy0dT5pW2DO6eDIp0wS', '081217263547', 'jl. kalimantan no 63', '2022-04-30 14:02:38', 'admin', NULL),
(14, 'Nafisah Hani Azzahra', '', 'nafisah@gmail.com', '$2y$10$Z0YoFIHeO77w7QMN5fLU6uqe2I5y2PG1SjmHPe7uyDFpbY065vFuG', '082435678659', 'Jalan Sumatra 56', '2022-04-30 16:14:13', 'Member', NULL);

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
-- Table structure for table `pemilik usaha`
--

CREATE TABLE `pemilik usaha` (
  `idPemilikUsaha` varchar(10) NOT NULL,
  `gambar` blob NOT NULL,
  `namaUsaha` varchar(30) NOT NULL,
  `jenisUsaha` varchar(30) NOT NULL,
  `tahunBerdiri` year(4) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `teleponPerusahaan` varchar(15) NOT NULL,
  `namaPemilikUsaha` varchar(30) NOT NULL,
  `tempatLahir` varchar(30) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `jalan` varchar(30) NOT NULL,
  `idKabupaten` varchar(10) NOT NULL,
  `email` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'pemilik'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemilik usaha`
--

INSERT INTO `pemilik usaha` (`idPemilikUsaha`, `gambar`, `namaUsaha`, `jenisUsaha`, `tahunBerdiri`, `keterangan`, `teleponPerusahaan`, `namaPemilikUsaha`, `tempatLahir`, `tanggalLahir`, `jalan`, `idKabupaten`, `email`, `password`, `role`) VALUES
('1', '', 'Wooden Furniture', 'Meubel', 0000, '-', '08123456786', 'Hartono', 'Jember', '1972-04-05', 'Rambipuji', 'Jember', 'hartono@gm', 'pemilik', 'pemilik');

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
(2, 3, 'Set Meja dan Kursi', 'produk/16vl4skANeGB6.jpeg', 'Meja kursi satu set  ', 0, 778000, 659000, '2019-12-20 09:24:13'),
(3, 6, 'Meja Rias', 'produk/16LMFWfly6i9Y.jpg', 'Meja rias kayu ', 0, 790000, 640000, '2020-03-16 12:16:53'),
(4, 3, 'kursi meja ruang tamu', 'produk/164MUoUUq0nZY.jpg', 'Simple Elegant', 0, 3500000, 3200000, '2022-04-19 18:40:13'),
(5, 4, 'Kursi ayunan', 'produk/16j5r0dzUCi7o.jpg', 'Kursi ayunan minimalis ', 0, 650000, 560000, '2022-04-23 22:10:45'),
(6, 2, 'Meja Belajar Aesthetic', 'produk/16Y9KU4XQ4sNI.jpg', 'Meja Belajar (Tanpa Kursi) ', 0, 589000, 449000, '2022-04-24 14:31:54'),
(7, 5, 'Lemari pakaian', 'produk/169XE6xl.XPRU.jpg', 'Lemari Pakaian ', 0, 1300000, 1250000, '2022-04-24 14:34:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`idBahan`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idBarang`),
  ADD UNIQUE KEY `kategori` (`idKategori`),
  ADD KEY `idBahan` (`idBahan`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idcart`),
  ADD UNIQUE KEY `orderid` (`orderid`),
  ADD KEY `orderid_2` (`orderid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idCustomer`),
  ADD KEY `idKabupaten` (`idKabupaten`);

--
-- Indexes for table `detailorder`
--
ALTER TABLE `detailorder`
  ADD PRIMARY KEY (`detailid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `idproduk` (`idproduk`);

--
-- Indexes for table `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD PRIMARY KEY (`idBarang`),
  ADD UNIQUE KEY `idKategori` (`idKategori`),
  ADD KEY `idBahan` (`idBahan`);

--
-- Indexes for table `karyawan_adminitrasi`
--
ALTER TABLE `karyawan_adminitrasi`
  ADD PRIMARY KEY (`idKaryawan`),
  ADD KEY `idAsal` (`idAsal`);
ALTER TABLE `karyawan_adminitrasi` ADD FULLTEXT KEY `username` (`email`);
ALTER TABLE `karyawan_adminitrasi` ADD FULLTEXT KEY `password` (`password`);

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
-- Indexes for table `pemilik usaha`
--
ALTER TABLE `pemilik usaha`
  ADD PRIMARY KEY (`idPemilikUsaha`),
  ADD KEY `idKabupaten` (`idKabupaten`);

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
  MODIFY `idcart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `detailorder`
--
ALTER TABLE `detailorder`
  MODIFY `detailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `idkonfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
