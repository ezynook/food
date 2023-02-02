-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2023 at 05:09 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` varchar(20) NOT NULL,
  `config` varchar(100) DEFAULT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `config`, `value`) VALUES
('cookie', 'จดจำการเข้าสู่ระบบ', 1),
('print', 'พิมพ์สลีปหลังการขาย', 1),
('stock', 'ขายสินค้าที่หมดสต๊อกได้', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` varchar(20) NOT NULL,
  `cus_name` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `update_dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `cus_name`, `contact`, `update_dt`) VALUES
('1', 'ลูกค้าทั่วไป', '-', '2023-01-30 01:41:30'),
('64595', 'nine', '0937395253', '2023-01-30 01:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `food_table`
--

CREATE TABLE `food_table` (
  `id` int(11) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `timediff` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_table`
--

INSERT INTO `food_table` (`id`, `table_name`, `timediff`, `status`) VALUES
(1, 'โต๊ะ 1', '2023-02-02 22:14:37', 1),
(2, 'โต๊ะ 2', '2023-02-02 21:52:54', 0),
(3, 'โต๊ะ 3', '0000-00-00 00:00:00', 0),
(4, 'โต๊ะ 4', '0000-00-00 00:00:00', 0),
(5, 'โต๊ะ 5', '2023-01-18 22:08:02', 0),
(6, 'ลูกค้าทั่วไป', '0000-00-00 00:00:00', 0),
(7, 'ซื้อกลับบ้าน', '2023-01-30 01:22:22', 0),
(8, 'โต๊ะvip1', '2023-01-18 22:07:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `import_product`
--

CREATE TABLE `import_product` (
  `id` int(11) NOT NULL,
  `import_date` datetime NOT NULL DEFAULT current_timestamp(),
  `supplier` varchar(100) NOT NULL,
  `food_id` int(11) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `qty` decimal(7,0) NOT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `import_product`
--

INSERT INTO `import_product` (`id`, `import_date`, `supplier`, `food_id`, `price`, `qty`, `type`) VALUES
(1, '2023-01-29 19:11:49', '7-11', 11, '0.00', '10', 'นำเข้า'),
(2, '2023-01-29 19:54:54', 'ร้านขายไก่', 11, '0.00', '10', 'นำเข้า');

-- --------------------------------------------------------

--
-- Table structure for table `import_temp`
--

CREATE TABLE `import_temp` (
  `id` int(11) NOT NULL,
  `import_date` datetime NOT NULL DEFAULT current_timestamp(),
  `supplier` varchar(100) NOT NULL,
  `food_id` int(11) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `qty` decimal(7,0) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `price1` decimal(7,2) NOT NULL,
  `price2` decimal(7,2) NOT NULL,
  `qty` decimal(7,0) NOT NULL,
  `update_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `img_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `food_name`, `price1`, `price2`, `qty`, `update_dt`, `img_path`) VALUES
(2, 'คั่วกบหรอย', '12.00', '23.00', '4', '2023-01-20 17:58:44', '0101231672570771.jpeg'),
(3, 'โค๊ก', '15.00', '20.00', '8', '2023-01-29 19:31:13', '0101231672570949.jpeg'),
(4, 'แกงส้ม', '40.00', '80.00', '4', '2023-01-29 19:56:30', '0101231672571025.jpeg'),
(5, 'เบียร์ช้าง', '50.00', '67.00', '43', '2023-01-22 14:39:16', '0101231672571258.jpeg'),
(6, 'ถั่วเค็ม', '12.00', '40.00', '25', '2023-01-01 18:08:36', '0101231672571317.jpeg'),
(7, 'น้ำแข็ง', '42.00', '50.00', '110', '2023-01-01 18:09:13', '0101231672571353.jpeg'),
(8, 'สปาย', '54.00', '75.00', '134', '2023-01-01 18:10:26', '0101231672571426.jpeg'),
(9, 'รีเจนซี่', '120.00', '150.00', '21', '2023-01-01 18:12:09', '0101231672571530.jpeg'),
(10, 'ลาบไก่', '90.00', '150.00', '22', '2023-01-01 18:15:13', '0101231672571714.jpeg'),
(11, 'ไก่ทอด', '0.00', '50.00', '70', '2023-01-30 01:48:38', '2901231675018118.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `sale_h`
--

CREATE TABLE `sale_h` (
  `id` int(11) NOT NULL,
  `sale_date` datetime NOT NULL,
  `customer` int(11) NOT NULL,
  `table_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_h`
--

INSERT INTO `sale_h` (`id`, `sale_date`, `customer`, `table_id`) VALUES
(1, '2023-01-27 23:16:03', 1130, 1),
(2, '2023-01-27 23:17:00', 1130, 1),
(3, '2023-01-27 23:17:58', 1130, 1),
(4, '2023-01-27 23:18:43', 1130, 1),
(5, '2023-01-30 04:27:56', 1, 1),
(6, '2023-02-01 22:48:46', 1, 1),
(7, '2023-02-01 22:49:10', 1, 1),
(8, '2023-02-01 23:48:41', 1, 1),
(9, '2023-02-01 23:51:30', 1, 1),
(10, '2023-02-02 21:53:11', 1, 1),
(11, '2023-02-02 21:55:10', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale_l`
--

CREATE TABLE `sale_l` (
  `pkey` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `qty` decimal(7,0) NOT NULL,
  `total` decimal(7,2) NOT NULL,
  `update_dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_l`
--

INSERT INTO `sale_l` (`pkey`, `id`, `food_id`, `price`, `qty`, `total`, `update_dt`) VALUES
(1, 1, 4, '80.00', '2', '160.00', '2023-01-27 23:16:07'),
(2, 1, 2, '23.00', '1', '23.00', '2023-01-27 23:16:07'),
(3, 2, 6, '40.00', '1', '40.00', '2023-01-27 23:17:03'),
(4, 2, 9, '150.00', '1', '150.00', '2023-01-27 23:17:03'),
(5, 3, 6, '40.00', '1', '40.00', '2023-01-27 23:18:00'),
(6, 3, 7, '50.00', '1', '50.00', '2023-01-27 23:18:00'),
(7, 4, 7, '50.00', '2', '100.00', '2023-01-27 23:18:46'),
(8, 5, 3, '20.00', '3', '60.00', '2023-01-30 04:27:58'),
(9, 6, 3, '20.00', '1', '20.00', '2023-02-01 22:48:48'),
(10, 6, 4, '80.00', '1', '80.00', '2023-02-01 22:48:48'),
(11, 7, 3, '20.00', '2', '40.00', '2023-02-01 22:49:13'),
(13, 9, 4, '80.00', '1', '80.00', '2023-02-01 23:51:32'),
(14, 9, 7, '50.00', '1', '50.00', '2023-02-01 23:51:32'),
(15, 9, 6, '40.00', '1', '40.00', '2023-02-01 23:51:32'),
(16, 9, 3, '20.00', '1', '20.00', '2023-02-01 23:51:32'),
(17, 10, 4, '80.00', '3', '240.00', '2023-02-02 21:53:14'),
(18, 11, 2, '23.00', '2', '46.00', '2023-02-02 21:55:13');

-- --------------------------------------------------------

--
-- Table structure for table `sale_temp`
--

CREATE TABLE `sale_temp` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `qty` decimal(7,0) NOT NULL,
  `total` decimal(7,2) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_temp`
--

INSERT INTO `sale_temp` (`id`, `food_id`, `price`, `qty`, `total`, `user_id`, `table_id`) VALUES
(145, 3, '20.00', '1', '20.00', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `update_dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `update_dt`) VALUES
(1, 'admin', 'admin', '2023-01-21 00:16:51'),
(2, 'nook', '2909', '2023-01-01 11:31:34'),
(4, 'nine', '1234', '2023-02-02 22:55:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `food_table`
--
ALTER TABLE `food_table`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `import_product`
--
ALTER TABLE `import_product`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `import_temp`
--
ALTER TABLE `import_temp`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sale_h`
--
ALTER TABLE `sale_h`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sale_l`
--
ALTER TABLE `sale_l`
  ADD PRIMARY KEY (`pkey`) USING BTREE;

--
-- Indexes for table `sale_temp`
--
ALTER TABLE `sale_temp`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_table`
--
ALTER TABLE `food_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `import_product`
--
ALTER TABLE `import_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `import_temp`
--
ALTER TABLE `import_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sale_h`
--
ALTER TABLE `sale_h`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sale_l`
--
ALTER TABLE `sale_l`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sale_temp`
--
ALTER TABLE `sale_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
