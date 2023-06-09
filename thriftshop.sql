-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 04:17 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti_pembayaran`) VALUES
(1, 12, 'Yaya', 'BCA', 660000, '2023-05-09', '20230509185511f4ce2e63ec7be0e549d6de826ecb3de6.jpg'),
(2, 12, 'Yaya', 'BCA', 660000, '2023-05-09', '20230509185636f4ce2e63ec7be0e549d6de826ecb3de6.jpg'),
(3, 13, 'Yaya', 'BCA', 660000, '2023-05-09', '20230509201942f4ce2e63ec7be0e549d6de826ecb3de6.jpg'),
(8, 16, 'Yaya', 'Mandiri', 499000, '2023-05-10', '20230510082346f4ce2e63ec7be0e549d6de826ecb3de6.jpg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id_pembelian`, `id_user`, `id_ongkir`, `tgl_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(12, 3, 1, '2023-05-09', 859000, 'Samarinda', 10000, 'Jl. Pramuka', 'barang dikirim', 'ABC123'),
(13, 3, 2, '2023-05-09', 260000, 'Balikpapan', 15000, 'Jl. Klamono 1', 'barang dikirim', 'resi1'),
(16, 3, 3, '2023-05-10', 499000, 'Bontang', 20000, 'Jl. MT. Haryono', 'sudah kirim pembayaran', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(21, 15, 10, 1, 'Adidas Superstar', 1196000, 1196000),
(22, 16, 15, 1, 'Oversized Sweater ', 180000, 180000),
(23, 16, 12, 1, 'Long pants ', 299000, 299000);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `deskripsi_produk`, `img_produk`, `status_produk`, `data_created`) VALUES
(9, 12, 'NY Cap', 150000, '<p>NY Cap (black)</p>\r\n', 'produk1683727816.jpg', 1, '2023-04-26 11:27:50'),
(10, 11, 'Adidas Superstar', 1196000, '<p>Adidas Superstar (Black)</p>\r\n', 'produk1682526288.jpg', 1, '2023-04-26 11:28:34'),
(11, 11, 'Nike Air', 2000000, '<p>Nike Air (grey)</p>\r\n', 'produk1682508572.jpg', 1, '2023-04-26 11:29:32'),
(12, 14, 'ZARA Long pants ', 299000, '<p>Long pants (black)</p>\r\n', 'produk1682517581.jpeg', 1, '2023-04-26 11:43:07'),
(14, 13, 'H&M Sweatshirt ', 200000, '<p>Sweatshirt (Size M)</p>\r\n', 'produk1682517360.jpeg', 1, '2023-04-26 11:53:08'),
(15, 13, 'OFF-WHITE Oversized Sweater ', 180000, '<p>Oversized Sweater (Size L)</p>\r\n', 'produk1682510070.jpg', 1, '2023-04-26 11:54:30'),
(18, 14, 'Jogger Pants ', 95000, '<p>Jogger Pants Adidas (Size S)</p>\r\n', 'produk1682517527.jpeg', 1, '2023-04-26 11:59:07'),
(19, 15, 'Tiger T-Shirt \"KENZO\"', 550000, '<p>Kenzo Tiger T-Shirt (Black, Size M)</p>\r\n', 'produk1682510759.jpeg', 1, '2023-04-26 12:05:59'),
(20, 15, 'Attack on Titan T-Shirt ', 150000, '<p>Attack on Titan T-Shirt (Beige, Size L)</p>\r\n', 'produk1682511043.jpg', 1, '2023-04-26 12:10:43'),
(21, 11, 'Woven slingback pumps', 299000, '<p>slingback pumps &quot;Charles &amp; Keith&quot; (pink)</p>\r\n', 'produk1683727838.jpg', 1, '2023-04-26 16:12:10'),
(23, 11, 'Nike Air Max Flyknit Racer', 1000000, '<p>Nike Air Max Flyknit Racer Men&#39;s Shoes (Black, Size 40)</p>\r\n', 'produk1683726339.jpeg', 1, '2023-05-10 13:45:39'),
(24, 23, 'Y2K Floral Print Knit Cardigan Sweater', 300000, '<p>Y2K Floral Print Knit Cardigan Sweater Long Sleeve (Blue, Size M)</p>\r\n', 'produk1683726411.jpg', 1, '2023-05-10 13:46:51'),
(25, 23, 'UV protection supima cotton ', 250000, '<p>UV protection supima cotton V neck long sleeve (Cream, Size L)</p>\r\n', 'produk1683726535.jpg', 1, '2023-05-10 13:48:55'),
(26, 20, 'UNIQLO Kemeja Katun', 85000, '<p>UNIQLO Kemeja Katun (Dark Blue, Sise XL)</p>\r\n', 'produk1683726664.jpg', 1, '2023-05-10 13:51:04'),
(27, 20, 'UNIQLO Kemeja Katun', 85000, '<p>UNIQLO Kemeja katun (Green, Size M)</p>\r\n', 'produk1683726711.jpg', 1, '2023-05-10 13:51:51'),
(28, 20, 'UNIQLO Kemeja Flannel', 100000, '<p>UNIQLO Kemeja Flannel Long Sleeve (Size M)</p>\r\n', 'produk1683726813.jpg', 1, '2023-05-10 13:53:33'),
(29, 20, 'Kemeja Stretch Twill Oversized', 185000, '<p>Kemeja Stretch Twill Oversized (Size L)</p>\r\n', 'produk1683726858.jpg', 1, '2023-05-10 13:54:18'),
(30, 16, 'Tas Chain Quilted Braided Micaela', 150000, '<p>Tas Chain Quilted Braided Micaela (Green)</p>\r\n', 'produk1683726912.jpg', 1, '2023-05-10 13:55:12'),
(31, 16, 'Nylon Body Bag', 85000, '<p>Nylon Body Bag(Green)</p>\r\n', 'produk1683726950.jpg', 1, '2023-05-10 13:55:50'),
(32, 16, 'Tas Selempang Cardinal', 75000, '<p>Tas Selempang Cardinal (Brown)</p>\r\n', 'produk1683726999.jpg', 1, '2023-05-10 13:56:39'),
(33, 16, 'Tas Ransel Roll Top', 175000, '<p>Tas Ransel Roll Top (Black)</p>\r\n', 'produk1683727042.jpg', 1, '2023-05-10 13:57:22'),
(34, 16, 'Peonia Korea Seira Bag', 200000, '<p>Peonia Korea Seira Bag (Black &amp; Pink)</p>\r\n', 'produk1683727091.jpg', 1, '2023-05-10 13:58:11'),
(35, 16, 'Hush Puppies Canvas Bag', 75000, '<p>Hush Puppies Canvas Bag (Black)</p>\r\n', 'produk1683727134.png', 1, '2023-05-10 13:58:54'),
(36, 12, 'Aonijie M-30 Warm Beanie Hat', 125000, '<p>Aonijie M-30 Warm Beanie Hat (Cream)</p>\r\n', 'produk1683727198.jpg', 1, '2023-05-10 13:59:58'),
(37, 12, 'Topi Roger Federer', 85000, '<p>Topi Roger Federer (Black &amp; Gold)</p>\r\n', 'produk1683727308.jpg', 1, '2023-05-10 14:01:48'),
(38, 15, 'T-shirt Kleid', 90000, '<p>T-shirt Kleid (Purple, Size M)</p>\r\n', 'produk1683727366.jpeg', 1, '2023-05-10 14:02:46'),
(39, 15, 'Striped Long Sleeve T-shirt', 200000, '<p>Striped Long Sleeve T-shirt (Brown &amp; Black, Size M)</p>\r\n', 'produk1683727419.jpg', 1, '2023-05-10 14:03:39'),
(40, 15, 'Plain Long Sleeve T-shirt', 75000, '<p>Plain Long Sleeve T-shirt (Black, Size M)</p>\r\n', 'produk1683727466.jpg', 1, '2023-05-10 14:04:26'),
(41, 15, 'Striped Mens Rugby Shirt', 100000, '<p>Striped Mens Rugby Shirt Long Sleeve (Navy &amp; White, Size L)</p>\r\n', 'produk1683727547.jpg', 1, '2023-05-10 14:05:47'),
(42, 14, 'Celana Work Denim', 250000, '<p>Celana Work Denim (Cream, Size 33)</p>\r\n', 'produk1683727588.jpg', 1, '2023-05-10 14:06:28'),
(43, 14, 'Celana Ankle Relax', 225000, '<p>Celana Ankle Relax Katun (Green, Size 32)</p>\r\n', 'produk1683727638.jpg', 1, '2023-05-10 14:07:18'),
(44, 11, 'Sepatu Vans Old Skool', 400000, '<p>Sepatu Vans Old Skool (Black &amp; White, Size 40)</p>\r\n', 'produk1683727706.jpg', 1, '2023-05-10 14:08:26'),
(45, 11, 'New Balance The 574 Sneakers', 500000, '<p>New Balance The 574 Sneakers (Grey, Size 41)</p>\r\n', 'produk1683727767.jpg', 1, '2023-05-10 14:09:27');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_pembelian_produk`
--
ALTER TABLE `tb_pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
