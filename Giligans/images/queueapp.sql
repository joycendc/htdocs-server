-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 10:18 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queueapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user`, `pass`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(2555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'PORK'),
(2, 'CHICKEN'),
(3, 'BEEF'),
(4, 'SEAFOODS'),
(5, 'SOUPS'),
(6, 'DRINKS'),
(7, 'DESSERTS'),
(8, 'RICE'),
(9, 'PANCIT'),
(10, 'VEGGIES');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `mobile_number`, `password`, `email`) VALUES
(1, 'john', 'doe', '44654545', '1234', 'jdoe@mail.mail'),
(7, 'Hel', 'Low', '154466', '11111', 'hello@hello'),
(8, 'Cen', 'Cen', '09265545845', '2222', 'cen@cen'),
(9, 'Greg', 'Mahome', '09946467', '2222', 'gre@gor'),
(10, 'Angelie', 'Cute', '333333333', '1234', 'love@love'),
(11, 'Nicole', 'Bakol', '13137676', '1111', 'nic@cole'),
(12, 'JM', 'Campos', '09264379538', 'Jmcampos', 'jemzonc@gmail.com'),
(13, 'Miko', 'John', '09997623843', 'Minari', 'mikojohn@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `prep_time` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `type_id`, `name`, `description`, `price`, `prep_time`, `cat_id`, `url`) VALUES
(1, 1, 'Crunchy Pork Sisig', 'Our Famous Special Crunchy Pork Sisig!', 230, '5', 1, 'images/chicken.png'),
(2, 1, 'Kare kareng Gulay', 'Cooked with Homemade Peanut Sauce', 225, '5', 10, ''),
(3, 1, 'Shrimp Oriental', 'For Sharing', 445, '5', 4, ''),
(4, 1, 'Fried Garlic Chicken', 'Our Giligan\'s Style Fried Garlic Chicken', 520, '5', 2, 'images/chicken.png'),
(5, 1, 'Boneless Chicken Teriyaki', 'Our delicious Boneless Chicken Teriyaki', 205, '5', 2, ''),
(6, 1, 'Fish Fillet Oriental', 'Our Yummy Fish Fillet with Oriental Sauce', 235, '5', 4, ''),
(7, 1, 'Roast Beef with Gravy', 'Our Delicious Roast Beef', 300, '5', 3, ''),
(8, 1, 'Sinigang na Bangus sa Miso', 'Good for 3-4 persons', 250, '5', 4, ''),
(9, 1, 'Sweet and Spicy Squid', 'Our Sweet & Spicy Squid', 245, '5', 4, ''),
(10, 1, 'Pancit Canton Guisado', 'Good for 2-3 persons', 200, '5', 9, ''),
(11, 1, 'Sisig Rice Platter', 'Good for 3-4 persons', 205, '5', 8, ''),
(14, 1, 'Pinakbet', 'Our Yummy Pinakbet', 165, '5', 10, ''),
(16, 1, 'Crispy Pata', 'Our Yummy and Delicious Crispy Pata!', 625, '5', 1, ''),
(17, 1, 'Inihaw na Liempo', 'Our Flavorful Inihaw na Liempo', 215, '5', 1, ''),
(18, 1, 'Lechon Kawali', 'Our Lechon Kawali (Pork)', 300, '5', 1, ''),
(19, 1, 'Sweet & Sour Pork', 'Our Sweet & Sour Pork', 240, '5', 1, ''),
(20, 1, 'Bulalo Soups', 'Our Flavorful Bulalo Soup!\r\n', 390, '5', 5, ''),
(21, 1, 'Nilagang Baka', 'Our Nilagang Baka Soup (Beef)\r\n', 305, '5', 5, ''),
(22, 1, 'Mango Float', 'Our Delicious Mango Crepes', 85, '5', 7, ''),
(23, 1, 'Sweet and Spicy Chicken', 'Our Yummy Sweet & Spicy Fried Chicken', 520, '5', 2, ''),
(24, 1, 'Fried Chicken 2pc', 'Our 2 pcs (Leg & Thigh) Fried Chicken', 140, '5', 2, ''),
(25, 1, 'Kare kare Beef', 'Cooked with Homemade Peanut Sauce', 400, '5', 3, ''),
(26, 1, 'Beef Caldereta', 'Our delicious Beef Caldereta', 300, '5', 3, ''),
(27, 1, 'Bangus Salpicao', 'Our delicious Bangus Salpicao', 250, '5', 4, ''),
(28, 1, 'Salt and Pepper Squid', 'Our Yummy Salt & Pepper Squid', 245, '5', 4, ''),
(30, 1, 'Grilled Pusit', 'Our Grilled Pusit (Squid)', 330, '5', 4, ''),
(31, 1, 'Grilled Bangus', 'Our Grilled While Bangus', 245, '5', 4, ''),
(32, 1, 'Giligans Coffee in Cup', 'Our Giligan\'s Special Instant Coffee', 55, '2', 6, ''),
(33, 1, 'Bottled Water', 'Bottled Water', 45, '0', 6, ''),
(34, 1, 'Iced Tea', '330ml Iced Tea', 60, '0', 6, ''),
(35, 1, 'Mountain Dew', '330ml Softdrink in Can', 60, '0', 6, ''),
(36, 1, 'Pepsi 1.5 Liter', '1.5 Liter Pepsi in Bottle', 168, '0', 6, ''),
(37, 1, 'Pork BBQ', 'Our 3 Sticks Pork BBQ', 111, '5', 1, ''),
(39, 1, 'Giligans Sinampalukan', 'Chicken in Tamarind Soup', 265, '5', 5, ''),
(40, 1, 'Plain Rice', 'Good for 3-4 persons', 40, '1', 8, ''),
(41, 1, 'Garlic Rice', 'Good for 3-4 persons', 55, '1', 8, ''),
(42, 1, 'Giligas Fried Rice', 'Good for 3-4 persons', 210, '1', 8, ''),
(43, 1, 'Garlic Rice Platter', '3 to 4 pax', 160, '1', 8, ''),
(44, 1, 'Plain Rice Platter', '3 to 4 pax', 130, '1', 8, ''),
(45, 1, 'Pancit Bihon Guisado', 'Good for 2-3 persons', 200, '5', 9, ''),
(46, 1, 'Miki Bihon Guisado', 'Good for 2-3 persons', 200, '5', 9, ''),
(47, 1, 'Buko Pandan', 'Our Delightful Buko Pandan', 70, '3', 7, ''),
(48, 1, 'Leche Flan', 'Our Heavenly Creamy Leche Flan', 60, '3', 7, '');

-- --------------------------------------------------------

--
-- Table structure for table `item_cat`
--

CREATE TABLE `item_cat` (
  `item_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `waittime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `customer_name`, `item_name`, `qty`, `price`, `total`, `date`, `waittime`) VALUES
(316, 12, 'JM', 'Kare kareng Gulay', 1, 225, 225, '2021-05-26 12:19:03', 1),
(317, 8, 'Cen', 'Crunchy Pork Sisig', 1, 230, 230, '2021-05-26 12:34:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `queue_id` int(11) NOT NULL,
  `comment` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `order_list` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `description`) VALUES
(1, 'WHOLE'),
(2, 'HALF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
