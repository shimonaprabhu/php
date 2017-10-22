-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 08, 2017 at 07:39 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `E-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'Levis'),
(2, 'Hidesign'),
(3, 'Polo'),
(4, 'Ginger'),
(5, 'Woodland'),
(6, 'Van Heusen'),
(7, 'Clarks');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(1, 'Men', 0),
(2, 'Women', 0),
(5, 'Shirts', 1),
(6, 'Pants', 1),
(7, 'Shoes', 1),
(8, 'Accessories', 1),
(9, 'Shirts', 2),
(10, 'Pants', 2),
(11, 'Shoes', 2),
(12, 'Bags', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`, `deleted`) VALUES
(1, 'Red Shirt', '750.00', '1000.00', 1, '5', '/E-Commerce/images/products/M1.jpg', 'A shirt for everyday in a vibrant hue of vermilion. Available in a variety of sizes . Limited stock!', 1, 'S:10,M:10,L:10,XL:10', 0),
(2, 'White Trousers', '699.00', '1599.00', 1, '6', '/E-Commerce/images/products/M3.jpg', 'Look dapper in a pair of suave white trousers. Available in a variety of sizes . Limited stocks!', 1, '28:10,30:10,32:10,34:10', 0),
(3, 'Tan Leather Shoes', '2599.00', '3999.00', 1, '7', '/E-Commerce/images/products/M2.jpg', 'Classy pair of shoes perfect for every occasion. Available in a variety of sizes . Limited stocks!', 1, '6:10,7:10,8:10,9:10', 0),
(4, 'Wallet', '499.00', '599.00', 1, '8', '/E-Commerce/images/products/M4.jpg', 'Spacious Wallets available in 2 subtle shades, ready to be paired with any outfit.', 1, '', 0),
(5, 'Wrap-around Top', '500.00', '850.00', 1, '9', '/E-Commerce/images/products/W1.jpg', 'A trendy wrap-around made just for the winters, in a warm tone of nude. Available in a variety of sizes. Limited stocks!', 1, 'S:!0,M:10,L:10,XL:10', 0),
(6, 'Jeans', '1099.00', '1299.00', 1, '10', '/E-Commerce/images/products/W2.jpg', 'Well fitted and comfortable jeans suitable for daily wear. Available in a variety of sizes. Limited stocks!', 1, '28:10,30:10,32:10,34:10', 0),
(7, 'Canvas Shoes', '599.00', '799.00', 1, '11', '/E-Commerce/images/products/W3.jpg', 'The perfect pair of shoes to go with any casual outfit. Available in a variety of sizes. Limited stocks!', 1, '6:10,7:10,8:10,9:10', 0),
(8, 'Handbag', '1999.00', '2399.00', 1, '12', '/E-Commerce/images/products/W4.jpg', 'Durable and spacious handbag, compartmentalized to accommodate all your essentials.', 1, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
