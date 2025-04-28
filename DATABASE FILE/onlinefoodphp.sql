-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2025 at 11:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinefoodphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(2, 'test', '$2y$10$iqz4UVl396J1PSFbvRjy.eVO4ga5J6QSmkDAcX0hE.T9OJiKCwcby', 'qqwe@gmail.com', '', '2025-02-19 15:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `d_id` int(222) NOT NULL,
  `rs_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `slogan` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`d_id`, `rs_id`, `title`, `slogan`, `price`, `img`) VALUES
(18, 5, 'asdasd', 'asdadwawd', 13123.00, '67c8a0521a290.jpg'),
(19, 13, 'kebab', 'indian food na kinamay', 12312312.00, '67d5f36a4a295.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE `remark` (
  `id` int(11) NOT NULL,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `rs_id` int(222) NOT NULL,
  `c_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `url` varchar(222) NOT NULL,
  `o_hr` varchar(222) NOT NULL,
  `c_hr` varchar(222) NOT NULL,
  `o_days` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`rs_id`, `c_id`, `title`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `image`, `date`) VALUES
(5, 5, 'chomps', 'gagi123@gmail.com', '09360769706', 'asdasd.com.ph', '6am', '3am', '24hr-x7', 'asdasdasd', '67c89f6deba07.jpg', '2025-03-05 19:01:01'),
(6, 7, 'chomps', 'gagi123@gmail.com', '09360769706', 'asdasd.com.ph', '8am', '5pm', 'Mon-Thu', 'chingchong', '67cd875701c48.png', '2025-03-09 12:19:35'),
(7, 7, 'chomps', 'gagi123@gmail.com', '09360769706', 'asdasd.com.ph', '8am', '5pm', 'Mon-Thu', 'chingchong', '67cd878c4ecc7.png', '2025-03-09 12:20:28'),
(8, 7, 'asdasdasd', 'adasd', 'asdasdas', 'asdasd.com.ph', '8am', '4pm', 'Mon-Tue', 'asdasda', '67cd87a792e2a.png', '2025-03-09 12:20:55'),
(9, 7, 'asdasdasd', 'adasd', 'asdasdas', 'asdasd.com.ph', '8am', '4pm', 'Mon-Tue', 'asdasda', '67cd87dba958d.png', '2025-03-09 12:21:47'),
(10, 7, 'asdasdasd', 'adasd', 'asdasdas', 'asdasd.com.ph', '8am', '4pm', 'Mon-Tue', 'asdasda', '67cd8917bbab9.png', '2025-03-09 12:27:03'),
(11, 5, 'isabels treat - basista pangasinan', 'gagi123@gmail.com', '09360769706', 'asdasd.com.ph', '8am', '12am', 'Mon-Wed', 'asdasdasda asda sda asd', '67cd8935c24c9.png', '2025-03-09 12:27:33'),
(12, 5, 'isabels treat - basista pangasinan', 'gagi123@gmail.com', '09360769706', 'asdasd.com.ph', '8am', '12am', 'Mon-Wed', 'asdasdasda asda sda asd', '67cd9995d1c98.png', '2025-03-09 13:37:25'),
(13, 8, '495 kitchen', 'gagi123@gmail.com', '09360769706', '495kitchen.com', '6am', '3pm', 'Mon-Tue', 'asdasd asd asd asdas dasd', '67d5f2f3f1dff.jpg', '2025-03-15 21:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `res_category`
--

CREATE TABLE `res_category` (
  `c_id` int(222) NOT NULL,
  `c_name` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `res_category`
--

INSERT INTO `res_category` (`c_id`, `c_name`, `date`) VALUES
(5, 'seafood', '2025-03-05 19:00:21'),
(7, 'chinese food', '2025-03-09 12:18:54'),
(8, 'indian food', '2025-03-15 21:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `status` int(222) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` enum('user','admin','superadmin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`, `role`) VALUES
(11, 'test', 'test', 'test', '123@gmail.com', '12345678911', '202cb962ac59075b964b07152d234b70', '1233', 1, '2025-03-08 03:53:25', 'user'),
(17, 'admin', '123', '123', 'admin@gmail.com', '11111111111', '202cb962ac59075b964b07152d234b70', '', 1, '2025-03-08 07:02:53', 'admin'),
(18, 'neljonel', 'asd', 'asdasd', 'user1@gmail.com', '09360769706', '$2y$10$SXM.ED3dXL1Ws0xjXvRDTu/7ctMPAIiS7ylSbd1rfJppEFDMdQYrC', 'asdasd', 1, '2025-03-08 17:23:13', 'user'),
(19, 'test1', 'neil', 'ark', 'test@example.com', '09360769706', '$2y$10$Sho9FqAUZfa8V8HYVj.GqOFwK55syOGPTvyIHPJUZmVR1G1ZSE8PW', '123', 1, '2025-03-09 04:07:35', 'superadmin'),
(21, 'test0', 'asd', 'asd', 'asd@gmail.com', '123123123', '$2y$10$nCg8M7oCsL1L2j3mrditEOCsRmSf1eN4yRiWROnOOmoCMKPHmXveC', 'asdasd', 1, '2025-03-09 05:18:02', 'superadmin'),
(22, 'test3', 'asd', 'asd', 'asd@gmail.com', '123', '$2y$10$gsKmD8rlxYGiiPsgUytcSOePU.nURjXxpRYSZ4i7Jg5F8lrhkkrn2', '123', 1, '2025-03-09 05:21:07', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

CREATE TABLE `users_orders` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','ready to pickup','delivered','rejected') DEFAULT 'pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gnumber` varchar(255) NOT NULL,
  `gref` varchar(255) NOT NULL,
  `payment_mode` varchar(50) NOT NULL DEFAULT 'COD',
  `cod_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `title`, `quantity`, `price`, `status`, `date`, `gnumber`, `gref`, `payment_mode`, `cod_address`) VALUES
(15, 19, 'asdasd', 1, 13123.00, 'pending', '2025-03-15 20:47:22', '', '', 'COD', 'asdasdasd'),
(16, 19, 'asdasd', 11, 13123.00, 'pending', '2025-03-15 21:25:46', '123', '1231', 'GCash', 'asdasdasd'),
(18, 19, 'asdasd', 1, 13123.00, 'pending', '2025-03-15 22:14:59', '333', '1231', 'GCash', 'asdasdasd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`rs_id`);

--
-- Indexes for table `res_category`
--
ALTER TABLE `res_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `d_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `remark`
--
ALTER TABLE `remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `rs_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `res_category`
--
ALTER TABLE `res_category`
  MODIFY `c_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
