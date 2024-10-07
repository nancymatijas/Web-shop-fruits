-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 03:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop_lv4`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`) VALUES
(1, 'admin@admin.com', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_items`
--

CREATE TABLE `ordered_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordered_items`
--

INSERT INTO `ordered_items` (`id`, `order_id`, `item_id`, `quantity`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 1),
(3, 1, 4, 1),
(4, 2, 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `address` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `total` double(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `surname`, `address`, `email`, `total`) VALUES
(1, 'Ivo', 'Ivic', 'Osjecka 14', 'ivooivic837@gmail.com', 11.26),
(2, 'Sara', 'Saric', 'Trp 28', 'saraaasaric8373@gmail.com', 44.90);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` double(9,2) NOT NULL,
  `image` varchar(250) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `quantity`) VALUES
(1, 'Apple', 2.99, 'https://www.biobio.hr/upload/catalog/product/28233/18301.jpg', 110),
(2, 'Raspberry', 4.09, 'https://www.glas-koncila.hr/wp-content/uploads/2023/08/shutterstock_2067857927w.jpg', 110),
(3, 'Pear', 1.99, 'https://vocarna.hr/wp-content/uploads/2018/09/kruska-will_large.jpg', 40),
(4, 'Pineapple', 2.09, 'https://m.media-amazon.com/images/I/71bNsWlkyeL.jpg', 223),
(5, 'Blueberry', 4.49, 'https://www.biobio.hr/upload/catalog/product/25516/15587.jpg', 57),
(6, 'Watermelon', 6.93, 'https://exotic-king.eu/wp-content/uploads/2023/11/Mini_lubenica.jpg', 17),
(7, 'Orange', 1.29, 'https://www.garden.hr/Documents/Products/75269/naranca_B7cJDxDq23.png', 33),
(8, 'Lemon', 1.49, 'https://nelvoce.hr/wp-content/uploads/2020/07/limun.jpeg', 73),
(9, 'Kiwi', 3.44, 'https://cdn.agroklub.com/upload/images/plant-specie/thumb/kivi-300x300.jpg', 11),
(10, 'Banana', 1.49, 'https://www.biobio.hr/upload/catalog/product/17352/7447.jpg', 43);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_items`
--
ALTER TABLE `ordered_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ordered_items`
--
ALTER TABLE `ordered_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ordered_items`
--
ALTER TABLE `ordered_items`
  ADD CONSTRAINT `ordered_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordered_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
