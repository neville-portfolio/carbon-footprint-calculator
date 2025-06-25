-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 06:54 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carbon_calculator`
--

-- --------------------------------------------------------

--
-- Table structure for table `carbon_footprints`
--

CREATE TABLE `carbon_footprints` (
  `calc_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_footprint` float DEFAULT NULL,
  `home_emissions` float DEFAULT NULL,
  `food_emissions` float DEFAULT NULL,
  `travel_emissions` float DEFAULT NULL,
  `goods_emissions` float DEFAULT NULL,
  `services_emissions` float DEFAULT NULL,
  `other_emissions` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carbon_footprints`
--

INSERT INTO `carbon_footprints` (`calc_id`, `user_id`, `created_at`, `total_footprint`, `home_emissions`, `food_emissions`, `travel_emissions`, `goods_emissions`, `services_emissions`, `other_emissions`) VALUES
(1, 1, '2025-02-28 02:11:03', 6965.24, 2461, 2796.32, 1092, 388.8, 63.6, 163.52),
(2, 2, '2025-02-28 14:40:52', 8177.16, 2461, 3476.48, 1911, 233.28, 95.4, 0),
(3, 2, '2025-02-28 14:42:09', 10553.6, 3588, 3876.88, 2730, 311.04, 47.7, 0),
(4, 2, '2025-02-28 14:43:42', 438, 0, 0, 0, 0, 0, 438),
(5, 2, '2025-02-28 14:51:02', 10408.5, 2461, 4228.24, 2730, 233.28, 318, 438);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(50) NOT NULL,
  `conversion_factor` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'G', 'w7s36@students.keele.ac.uk', '$2y$10$sClVZDyCaQm7ba3ft38InOawjVGvAWErD3GF.yyNXFwyfIPLyuKbu', '2025-02-28 00:34:11'),
(2, 'Georgia', 'x7t06@students.keele.ac.uk', '$2y$10$ZHYCgGziJC8NnRSGElye3.YIGivrsVWLiOnJGPi5evfuqvApvbjxy', '2025-02-28 14:37:33'),
(3, 'testing', 'testing@email.com', '$2y$10$TuT2HKgFheBC6yXF/kqGbuOM..A7kXY4DEdKQ9SB/.wLCTuKUW3zC', '2025-02-28 14:48:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carbon_footprints`
--
ALTER TABLE `carbon_footprints`
  ADD PRIMARY KEY (`calc_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carbon_footprints`
--
ALTER TABLE `carbon_footprints`
  MODIFY `calc_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
