-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2019 at 12:38 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csy2028_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `user_id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`user_id`, `fullName`, `email`, `username`, `password`, `permission`) VALUES
(8, 'MR. Bhandari', 'amirbhandari72@gmail.com', 'amir', '$2y$10$gYQH2Cp.1GJDZOniTJ/1Iefw3j3vmDCMpzPyU/naKT/Qoanu9TP9e', 'YES'),
(19, 'User Login', 'user@login.com', 'user', '$2y$10$mU32MyAUuSsiZJ7hU1fbDettu92xJ2bUHeAXaGb.HhgvHniUWO8nS', 'NO'),
(20, 'Admin', 'admin@login.com', 'admin', '$2y$10$2cPpkQPZYI5OOgG/FVCUHep2bydLQNDbRtPt0e3uiizodmkyb7ZT6', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `categories_db`
--

CREATE TABLE `categories_db` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories_db`
--

INSERT INTO `categories_db` (`category_id`, `category_name`, `category_description`) VALUES
(4, 'Gaming', 'games are played by everyone'),
(10, 'Camera', 'We have lots of cameras that you may like it.'),
(12, 'Phone', 'Phone is a electronic devices.'),
(13, 'TV', 'This is the demo description');

-- --------------------------------------------------------

--
-- Table structure for table `products_db`
--

CREATE TABLE `products_db` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_cost` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_db`
--

INSERT INTO `products_db` (`product_id`, `product_name`, `product_description`, `product_cost`, `product_quantity`, `category_id`, `featured`) VALUES
(43, 'Mi A1', 'This is the demo description of Phone', 2500, 12, 12, 'YES'),
(44, 'Panasonic', 'This is a demo description', 54000, 10, 13, 'YES'),
(45, 'Huwai', 'This is a demo descript', 45000, 15, 12, 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `approval` varchar(255) NOT NULL,
  `review_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `product_id`, `approval`, `review_description`) VALUES
(1, 44, 'AGREE', 'ads'),
(2, 44, 'AGREE', 'this is nice ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `categories_db`
--
ALTER TABLE `categories_db`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `products_db`
--
ALTER TABLE `products_db`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_categories_db` (`category_id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `categories_db`
--
ALTER TABLE `categories_db`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products_db`
--
ALTER TABLE `products_db`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products_db`
--
ALTER TABLE `products_db`
  ADD CONSTRAINT `fk_categories_db` FOREIGN KEY (`category_id`) REFERENCES `categories_db` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
