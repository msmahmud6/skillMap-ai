-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2025 at 09:05 PM
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
-- Database: `meal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `username`, `password`) VALUES
(1, 'w_akram', 'akram1888'),
(2, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bazar`
--

CREATE TABLE `bazar` (
  `id` int(11) NOT NULL,
  `bazar_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `buyer` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bazar`
--

INSERT INTO `bazar` (`id`, `bazar_date`, `amount`, `buyer`, `description`) VALUES
(1, '2025-11-03', 4845.00, 'Wasim Akram', ''),
(2, '2025-11-06', 1020.00, 'Wasim Akram', '');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `deposit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `member_id`, `amount`, `deposit_date`) VALUES
(2, 1, 1500.00, '2025-11-06'),
(3, 3, 1000.00, '2025-11-06'),
(4, 2, 800.00, '2025-11-06'),
(5, 5, 500.00, '2025-11-06'),
(6, 6, 500.00, '2025-11-06'),
(7, 7, 500.00, '2025-11-06'),
(8, 8, 700.00, '2025-11-06'),
(9, 10, 1000.00, '2025-11-06'),
(10, 11, 500.00, '2025-11-06'),
(11, 13, 500.00, '2025-11-06'),
(12, 14, 1000.00, '2025-11-06'),
(13, 17, 500.00, '2025-11-06'),
(16, 9, 1000.00, '2025-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `meal_date` date NOT NULL,
  `meals` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `member_id`, `meal_date`, `meals`) VALUES
(21, 4, '2025-11-04', 1.00),
(22, 4, '2025-11-05', 1.50),
(23, 4, '2025-11-06', 1.50),
(51, 6, '2025-11-04', 2.00),
(52, 6, '2025-11-05', 2.50),
(53, 6, '2025-11-06', 2.50),
(82, 10, '2025-11-05', 2.50),
(83, 10, '2025-11-06', 0.50),
(112, 1, '2025-11-05', 2.50),
(113, 1, '2025-11-06', 2.00),
(141, 14, '2025-11-04', 2.00),
(142, 14, '2025-11-05', 2.00),
(143, 14, '2025-11-06', 2.00),
(528, 15, '2025-11-04', 1.00),
(529, 15, '2025-11-05', 1.00),
(530, 16, '2025-11-05', 1.00),
(531, 16, '2025-11-06', 0.50),
(532, 12, '2025-11-04', 2.00),
(533, 12, '2025-11-05', 1.50),
(534, 12, '2025-11-06', 2.50),
(535, 3, '2025-11-04', 2.00),
(536, 3, '2025-11-05', 2.50),
(537, 3, '2025-11-06', 2.50),
(538, 13, '2025-11-04', 2.00),
(539, 13, '2025-11-05', 2.50),
(540, 13, '2025-11-06', 2.50),
(541, 8, '2025-11-04', 2.00),
(542, 8, '2025-11-05', 2.50),
(543, 8, '2025-11-06', 1.50),
(544, 9, '2025-11-04', 2.00),
(545, 9, '2025-11-05', 2.50),
(546, 9, '2025-11-06', 2.50),
(547, 17, '2025-11-06', 2.50),
(548, 5, '2025-11-04', 4.00),
(549, 5, '2025-11-05', 5.00),
(550, 5, '2025-11-06', 1.00),
(551, 7, '2025-11-04', 2.00),
(552, 7, '2025-11-05', 2.50),
(553, 7, '2025-11-06', 2.50),
(554, 2, '2025-11-04', 2.00),
(555, 2, '2025-11-05', 2.50),
(556, 2, '2025-11-06', 2.50),
(557, 11, '2025-11-05', 1.50);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `room` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `phone`, `join_date`, `room`) VALUES
(1, 'Aritra', '', '2025-11-06', '4'),
(2, 'Tihan', '', '2025-11-06', '1'),
(3, 'Mahmud', '01743080269', '2025-11-06', '1'),
(4, 'Akram', '', '2025-11-06', '1'),
(5, 'Shafikul', '', '2025-11-06', '3'),
(6, 'Amit', '', '2025-11-06', '3'),
(7, 'Siyam', '', '2025-11-06', '4'),
(8, 'Nobi', '', '2025-11-06', '1'),
(9, 'Osman Vai', '', '2025-11-06', '4'),
(10, 'Arafat', '', '2025-11-06', '3'),
(11, 'Yasin', '', '2025-11-06', '3'),
(12, 'Mahbub', '', '2025-11-06', '1'),
(13, 'Monmoy', '', '2025-11-06', '4'),
(14, 'Dinar', '', '2025-11-06', '4'),
(15, 'Hasan Vai', '', '2025-11-06', '4'),
(16, 'Imran', '', '2025-11-06', '3'),
(17, 'Sazid', '', '2025-11-06', '4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `bazar`
--
ALTER TABLE `bazar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bazar`
--
ALTER TABLE `bazar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=558;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `meals_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
