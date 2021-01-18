-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2021 at 05:20 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopify2021_imagerepo`
--

-- --------------------------------------------------------

--
-- Table structure for table `image_info`
--

CREATE TABLE `image_info` (
  `image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_name` varchar(256) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `sales` int(11) NOT NULL,
  `inventory` int(11) NOT NULL,
  `format` varchar(256) NOT NULL,
  `size` int(11) NOT NULL,
  `visibility` varchar(20) NOT NULL,
  `location` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image_info`
--

INSERT INTO `image_info` (`image_id`, `user_id`, `image_name`, `price`, `discount`, `description`, `sales`, `inventory`, `format`, `size`, `visibility`, `location`, `created`, `modified`) VALUES
(1, 1, 'Fruit Cake', 5, 3, 'Display of a delicious fruit cake', 5, 100, '1920 x 1280', 93, 'public', './assets/images/img-01.jpg', '2021-01-15 23:39:05', '2021-01-17 04:39:36'),
(2, 1, 'French Crepe', 5, NULL, 'Delicious looking french crepe', 10, 90, '1920 x 2880', 87, 'public', './assets/images/img-02.jpg', '2021-01-15 23:40:00', '2021-01-17 04:39:36'),
(3, 1, 'Coffee Beans', 10, NULL, 'Coffee beans on table.', 20, 80, '1920 x 2876', 142, 'public', './assets/images/img-03.jpg', '2021-01-15 23:40:03', '2021-01-17 04:39:36'),
(4, 1, 'Pancakes', 10, NULL, 'Pancakes with Rasberries. Delicious!', 0, 50, '1920 x 2880', 128, 'public', './assets/images/img-04.jpg', '2021-01-15 23:40:05', '2021-01-17 04:39:36'),
(8, 1, 'Yogurt with fruits', 10, NULL, 'Morning breakfast: Yogurt!', 0, 10, '1920 x 2880', 108, 'private', './assets/images/img-05.jpg', '2021-01-17 01:24:06', '2021-01-17 06:24:06'),
(13, 3, 'Fruit Salad', 5, NULL, 'Morning Breakfast: Fruit Salad', 0, 10, '1920 x 2880', 115, 'public', './assets/images/img-06.jpg', '2021-01-17 15:58:36', '2021-01-17 21:00:04'),
(14, 1, 'Cranberries', 5, NULL, 'Delicious cranberries', 0, 10, '1920 x 2400', 309, 'public', './assets/images/img-14.jpg', '2021-01-17 04:05:47', '2021-01-17 21:05:47'),
(15, 4, 'Oranges', 3, NULL, 'Dessert with Oranges', 0, 100, '1920 x 1280', 254, 'public', './assets/images/img-15.jpg', '2021-01-17 11:08:47', '2021-01-18 04:08:47'),
(16, 5, 'Fruit Platter', 15, NULL, 'Platter of fruit.', 0, 10000, '1920 x 1280', 265, 'public', './assets/images/img-16.jpg', '2021-01-17 11:18:12', '2021-01-18 04:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`) VALUES
(1, 'xdeng10', 'xdeng10@image.repo'),
(3, 'jsmith', 'jsmith@image.repo'),
(4, 'jdeng', 'jdeng@image.repo'),
(5, 'bababa', 'bababa@hotmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image_info`
--
ALTER TABLE `image_info`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `image_info`
--
ALTER TABLE `image_info`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
