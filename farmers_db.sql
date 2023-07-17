-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 10:15 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmers`
--

-- --------------------------------------------------------

--
-- Table structure for table `consumer_login`
--

CREATE TABLE `consumer_login` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `signUpDate` datetime NOT NULL,
  `profilePic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consumer_login`
--

INSERT INTO `consumer_login` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `signUpDate`, `profilePic`) VALUES
(1, 'arivu', 'Arivumathi', 'aaaaaa', 'arivu@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2022-06-05 00:00:00', 'assestsimagesprofile picdp.png'),
(3, 'Anirudh', 'Ani', 'rudh', 'ani@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '2022-06-06 00:00:00', 'assestsimagesprofile picdp.png'),
(4, 'avinash', 'Avi', 'nash', 'a@g.com', 'e10adc3949ba59abbe56e057f20f883e', '2022-08-28 00:00:00', 'assestsimagesprofile picdp.png'),
(5, 'avinash', 'Avi', 'nash', 'a@g.com', 'e10adc3949ba59abbe56e057f20f883e', '2022-08-28 00:00:00', 'assestsimagesprofile picdp.png'),
(6, 'Nand', 'Nandhan', 'V', 'sam@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2022-12-03 00:00:00', 'assestsimagesprofile picdp.png'),
(7, 'Nand', 'Nandhan', 'V', 'sam@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2022-12-03 00:00:00', 'assestsimagesprofile picdp.png');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_name` varchar(20) DEFAULT NULL,
  `c_id` int(10) NOT NULL,
  `email_id` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `farmer_acc`
--

CREATE TABLE `farmer_acc` (
  `c_name` varchar(20) DEFAULT NULL,
  `f_name` varchar(20) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `time_of_tranc` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmer_acc`
--

INSERT INTO `farmer_acc` (`c_name`, `f_name`, `amount`, `time_of_tranc`) VALUES
('Arivu', 'Avinash', 289, '2022-06-07 01:09:35'),
('Arivu', 'Arivu', 561, '2022-06-07 01:09:35'),
('Arivu', 'Aravind', 1500, '2022-06-07 09:13:45'),
('Arivu', 'Ashwin', 1000, '2022-06-07 09:41:42'),
('Arivu', 'Aravind', 1600, '2022-06-24 23:57:14'),
('Arivu', 'Aravind', 5000, '2022-11-21 12:00:05'),
('Arivu', 'Ashwin', 1000, '2022-11-21 12:19:43'),
('Arivu', 'Avinash', 392, '2022-12-05 12:04:12'),
('Arivu', 'Arivu', 1308, '2022-12-05 12:04:12'),
('Arivu', 'Arivu', 0, '2022-12-05 12:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_details`
--

CREATE TABLE `farmer_details` (
  `username` varchar(30) NOT NULL,
  `phone_no` bigint(10) NOT NULL,
  `MOF` varchar(10) NOT NULL,
  `crop` varchar(10) DEFAULT NULL,
  `land_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmer_details`
--

INSERT INTO `farmer_details` (`username`, `phone_no`, `MOF`, `crop`, `land_area`) VALUES
('Arivu', 1234567890, 'Inorganic', 'Rice', 120);

--
-- Triggers `farmer_details`
--
DELIMITER $$
CREATE TRIGGER `product_update` AFTER INSERT ON `farmer_details` FOR EACH ROW BEGIN
	insert into product (crop, username) VALUES(NEW.crop, New.username);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `min_crop`
-- (See below for the actual view)
--
CREATE TABLE `min_crop` (
`crop` varchar(10)
,`land_area` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `crop` varchar(11) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `time_of_order` datetime DEFAULT current_timestamp(),
  `qty` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `crop` varchar(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `qty_avail` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `signUpDate` datetime NOT NULL,
  `profilePic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `signUpDate`, `profilePic`) VALUES
(1, 'Arivu', 'Arivumathi', 'Amudhan', 'Arivu@gmail.com', 'b57e63ce8b73e370cd2a4c6865fc611b', '2021-07-05 00:00:00', 'assestsimagesprofile picdp.png'),
(5, 'Avinash', 'Avinash', 'Kkkkkk', 'Avi@gmail.com', '97cddd635cef02b3ceaf25641f9b2eee', '2022-05-30 00:00:00', 'assestsimagesprofile picdp.png'),
(11, 'AjayK', 'Ajay', 'Kumar', 'Ajay@gmail.com', 'c37bf859faf392800d739a41fe5af151', '2022-06-05 00:00:00', 'assestsimagesprofile picdp.png'),
(14, 'Nandhan', 'Nandhan', 'Velmurugan', 'Nandhan@gmail.com', '7336ec824d1c7db60ef6897271d1e3cb', '2022-06-07 00:00:00', 'assestsimagesprofile picdp.png'),
(15, 'Aravind', 'Aravind', 'Krishnan', 'Aravind@gmail.com', '11c2f02f38b1f3ac8e75f9edc137c3b5', '2022-06-07 00:00:00', 'assestsimagesprofile picdp.png'),
(16, 'Ashwin', 'Ashwin', 'Ramesh', 'Ash@gmail.com', '7cb6fa91c124913f7a75e3153339234f', '2022-06-07 00:00:00', 'assestsimagesprofile picdp.png'),
(17, 'aravi', 'Ara', 'Vindh', 'Ara@gmail.com', 'a384b6463fc216a5f8ecb6670f86456a', '2022-12-03 00:00:00', 'assestsimagesprofile picdp.png');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `crop` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`crop`, `quantity`) VALUES
('Rice', 16);

-- --------------------------------------------------------

--
-- Structure for view `min_crop`
--
DROP TABLE IF EXISTS `min_crop`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `min_crop`  AS SELECT `farmer_details`.`crop` AS `crop`, sum(`farmer_details`.`land_area`) AS `land_area` FROM `farmer_details` GROUP BY `farmer_details`.`crop` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consumer_login`
--
ALTER TABLE `consumer_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `farmer_acc`
--
ALTER TABLE `farmer_acc`
  ADD KEY `c_id` (`c_name`),
  ADD KEY `username` (`f_name`);

--
-- Indexes for table `farmer_details`
--
ALTER TABLE `farmer_details`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `phone_no` (`phone_no`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `p_id` (`crop`),
  ADD KEY `order_fk1` (`c_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD KEY `product_fk1` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`crop`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consumer_login`
--
ALTER TABLE `consumer_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
