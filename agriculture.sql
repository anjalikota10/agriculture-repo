-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 08:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agriculture`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `fname` varchar(11) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` varchar(11) NOT NULL,
  `city` varchar(20) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `payment` varchar(20) NOT NULL,
  `total_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `fname`, `lname`, `email`, `address`, `city`, `zipcode`, `payment`, `total_amount`) VALUES
(1, 'Leena', 'Yemul', 'leena.yemul@gmail.co', 'Solpaur', 'solapur', 413006, 'cash on delivery', 362);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `image`) VALUES
(1, 'Grains', 'Grains are small, dry, hard seeds that come from g', 'grains.jpeg'),
(2, 'Vegetables', 'Vegetables are edible parts of plants, such as lea', 'veg.jpg'),
(3, 'Fruits', 'Fruit is the edible, ripened ovary of a flowering ', 'fruits.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `msg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `msg`) VALUES
(1, 'Leena Yemul', 'leena.yemul@gmail.com', 'qwer', 'asdf'),
(2, 'Leena Yemul', 'leena.yemul@gmail.com', 'Hello', 'asdfgjkl;');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_reg`
--

CREATE TABLE `farmer_reg` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact` bigint(50) NOT NULL,
  `address` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_reg`
--

INSERT INTO `farmer_reg` (`id`, `name`, `email`, `password`, `contact`, `address`) VALUES
(1, 'Leena Yemul', 'leena.yemul@gmail.com', '1234', 7878787878, 'Solapur');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `id` int(11) NOT NULL,
  `bid` int(50) NOT NULL,
  `pid` int(50) NOT NULL,
  `qty` int(50) NOT NULL,
  `price` int(50) NOT NULL,
  `total` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`id`, `bid`, `pid`, `qty`, `price`, `total`) VALUES
(1, 1, 8, 2, 80, 160),
(2, 1, 3, 3, 30, 90),
(3, 1, 11, 3, 40, 120);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `cid` int(50) NOT NULL,
  `user_id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `cid`, `user_id`, `name`, `description`, `price`, `image`) VALUES
(1, 1, 0, 'Rice', 'Rice is a cereal grain that comes from the grass p', 50, 'rice.jpeg'),
(3, 1, 1, 'Oats', 'Oats are a cereal grain that come from the seeds o', 30, 'oats.avif'),
(4, 1, 1, 'Barley', 'Barley is a cereal grain that comes from the grass', 30, 'barley.jpeg'),
(5, 1, 1, 'Millet', 'Millet is a small-seeded cereal crop that is glute', 40, 'millet.jpeg'),
(6, 1, 1, 'Teff', 'Teff is a small, round, khaki-colored grain thats ', 40, 'teff.jpeg'),
(7, 2, 1, 'Potatos', 'Potatoes are starchy, underground tubers with brow', 25, 'potato.jpeg'),
(8, 2, 1, 'Brinjal', 'Brinjal (Solanum melongena) is a small, tropical h', 80, 'brinjal.jpeg'),
(9, 2, 1, 'Spinach', 'Spinach (Spinacia oleracea) is a leafy green veget', 10, 'spinach.jpeg'),
(10, 2, 1, 'Fenugreek Leaves', 'Fenugreek leaves are one of the healthiest green l', 30, 'fenugreek.jpeg'),
(11, 2, 1, 'Cauliflower', 'Cauliflower is a white vegetable with a large, rou', 40, 'cauliflower.jpeg'),
(12, 3, 1, 'Mango', 'A mango is a tropical fruit that is egg-shaped, fl', 500, 'mango.jpeg'),
(13, 3, 1, 'Strawberry', 'Strawberries are soft, bright red berries with a s', 100, 'strawberry.jpeg'),
(14, 3, 1, 'Banana', 'Bananas are long, curved fruits with yellow skin t', 30, 'banana.jpeg'),
(15, 3, 1, 'Apple', 'An apple is a round, firm fruit that can be red, y', 200, 'apple.jpeg'),
(16, 3, 1, 'Grapes', 'Grapes are small, juicy berries that grow on vines', 100, 'graps.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `reg`
--

CREATE TABLE `reg` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `contact` bigint(50) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg`
--

INSERT INTO `reg` (`id`, `name`, `email`, `password`, `contact`, `address`) VALUES
(1, 'Leena Yemul', 'leena.yemul@gmail.com', '1234', 6767676767, 'Solpaur'),
(2, 'Lavanya Nalla', 'lavanya@gmail.com', '1234', 7878678787, 'Geeta Nagar'),
(3, 'rani', 'rani@gmail.com', 'Rani', 9889898989, 'testing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farmer_reg`
--
ALTER TABLE `farmer_reg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg`
--
ALTER TABLE `reg`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `farmer_reg`
--
ALTER TABLE `farmer_reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reg`
--
ALTER TABLE `reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
