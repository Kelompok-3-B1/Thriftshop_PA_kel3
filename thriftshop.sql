-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 04:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thriftshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(10) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
(11, 'Sepatu'),
(12, 'Topi'),
(13, 'Sweater'),
(14, 'Celana'),
(15, 'T-Shirt'),
(16, 'Tas'),
(20, 'Kemeja'),
(23, 'Cardigan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ongkir`
--

CREATE TABLE `tb_ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_ongkir`
--

INSERT INTO `tb_ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Samarinda', 10000),
(2, 'Balikpapan', 15000),
(3, 'Bontang', 20000),
(4, 'Penajam', 25000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti_pembayaran`) VALUES
(1, 12, 'Yaya', 'BCA', 660000, '2023-05-09', '20230509185511f4ce2e63ec7be0e549d6de826ecb3de6.jpg'),
(2, 12, 'Yaya', 'BCA', 660000, '2023-05-09', '20230509185636f4ce2e63ec7be0e549d6de826ecb3de6.jpg'),
(3, 13, 'Yaya', 'BCA', 660000, '2023-05-09', '20230509201942f4ce2e63ec7be0e549d6de826ecb3de6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending',
  `resi_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id_pembelian`, `id_user`, `id_ongkir`, `tgl_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(12, 3, 1, '2023-05-09', 859000, 'Samarinda', 10000, 'Jl. Pramuka', 'barang dikirim', 'ABC123'),
(13, 3, 2, '2023-05-09', 260000, 'Balikpapan', 15000, 'Jl. Klamono 1', 'barang dikirim', 'resi1'),
(14, 3, 2, '2023-05-10', 715000, 'Balikpapan', 15000, 'Jl. MT. Haryono', 'sudah kirim pembayaran', ''),
(15, 3, 4, '2023-05-10', 3221000, 'Penajam', 25000, 'Jl. Proklamasi', 'sudah kirim pembayaran', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian_produk`
--

CREATE TABLE `tb_pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pembelian_produk`
--

INSERT INTO `tb_pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama_produk`, `harga_produk`, `subharga`) VALUES
(6, 7, 19, 1, 'Tiger T-Shirt \"KENZO\"', 550000, 550000),
(7, 7, 18, 1, 'Jogger Pants ', 95000, 95000),
(8, 8, 19, 1, 'Tiger T-Shirt \"KENZO\"', 550000, 550000),
(9, 9, 19, 1, 'Tiger T-Shirt \"KENZO\"', 550000, 550000),
(10, 10, 18, 1, 'Jogger Pants ', 95000, 95000),
(11, 10, 9, 1, 'NY Cap', 150000, 150000),
(12, 11, 19, 1, 'Tiger T-Shirt \"KENZO\"', 550000, 550000),
(13, 11, 18, 1, 'Jogger Pants ', 95000, 95000),
(14, 12, 19, 1, 'Tiger T-Shirt \"KENZO\"', 550000, 550000),
(15, 12, 21, 1, 'Woven slingback pumps', 299000, 299000),
(16, 13, 18, 1, 'Jogger Pants ', 95000, 95000),
(17, 13, 9, 1, 'NY Cap', 150000, 150000),
(18, 14, 19, 1, 'Tiger T-Shirt \"KENZO\"', 550000, 550000),
(19, 14, 9, 1, 'NY Cap', 150000, 150000),
(20, 15, 11, 1, 'Nike Air', 2000000, 2000000),
(21, 15, 10, 1, 'Adidas Superstar', 1196000, 1196000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(30) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `img_produk` varchar(100) NOT NULL,
  `status_produk` tinyint(1) NOT NULL,
  `data_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `deskripsi_produk`, `img_produk`, `status_produk`, `data_created`) VALUES
(9, 12, 'NY Cap', 150000, '<p>NY Cap (black)</p>\r\n', 'produk1682508470.jpeg', 1, '2023-04-26 11:27:50'),
(10, 11, 'Adidas Superstar', 1196000, '<p>Adidas Superstar (Black)</p>\r\n', 'produk1682526288.jpg', 1, '2023-04-26 11:28:34'),
(11, 11, 'Nike Air', 2000000, '<p>Nike Air (grey)</p>\r\n', 'produk1682508572.jpg', 1, '2023-04-26 11:29:32'),
(12, 14, 'Long pants ', 299000, '<p>Long pants (black)</p>\r\n', 'produk1682517581.jpeg', 1, '2023-04-26 11:43:07'),
(14, 13, 'Sweatshirt ', 200000, '<p>Sweatshirt (Size M)</p>\r\n', 'produk1682517360.jpeg', 1, '2023-04-26 11:53:08'),
(15, 13, 'Oversized Sweater ', 180000, '<p>Oversized Sweater (Size L)</p>\r\n', 'produk1682510070.jpg', 1, '2023-04-26 11:54:30'),
(18, 14, 'Jogger Pants ', 95000, '<p>Jogger Pants Adidas (Size S)</p>\r\n', 'produk1682517527.jpeg', 1, '2023-04-26 11:59:07'),
(19, 15, 'Tiger T-Shirt \"KENZO\"', 550000, '<p>Kenzo Tiger T-Shirt (Black, Size M)</p>\r\n', 'produk1682510759.jpeg', 1, '2023-04-26 12:05:59'),
(20, 15, 'Attack on Titan T-Shirt ', 150000, '<p>Attack on Titan T-Shirt (Beige, Size L)</p>\r\n', 'produk1682511043.jpg', 1, '2023-04-26 12:10:43'),
(21, 11, 'Woven slingback pumps', 299000, '<p>slingback pumps &quot;Charles &amp; Keith&quot; (pink)</p>\r\n', 'produk1682525530.jpeg', 1, '2023-04-26 16:12:10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_telp` varchar(20) NOT NULL,
  `user_address` text NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `user_email`, `user_telp`, `user_address`, `level`) VALUES
(1, 'Melinda', 'admin01', 'admin1', 'thriftshop@gmail.com', '0821835923', 'Jl. Pahlawan No. 18', 'admin'),
(2, 'Chorine', 'staff01', 'staff1', 'staff@gmail.com', '0811582105', 'Jl. Trisari No. 22', 'staff'),
(3, 'Yaya', 'user01', 'user1', 'user@gmail.com', '0811588888', 'Jl. Pemuda No. 8', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `tb_pembelian_produk`
--
ALTER TABLE `tb_pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_pembelian_produk`
--
ALTER TABLE `tb_pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
