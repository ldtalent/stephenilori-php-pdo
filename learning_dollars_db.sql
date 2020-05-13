-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2020 at 12:09 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learning_dollars_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_news`
--

CREATE TABLE `db_news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_news`
--

INSERT INTO `db_news` (`id`, `title`, `content`, `date_posted`) VALUES
(1, 'This is just a test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-05-07 13:19:11'),
(2, 'This is just a test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-05-07 13:19:11'),
(3, 'This is just a test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-05-07 13:19:29'),
(4, 'This is just a test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-05-07 13:19:29'),
(5, 'This is just a test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-05-07 13:19:39'),
(6, 'This is just a test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-05-07 13:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE `db_user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone_no` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_me` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_user`
--

INSERT INTO `db_user` (`id`, `name`, `email`, `phone_no`, `password`, `remember_me`, `status`, `created_at`) VALUES
(1, 'Ilori Stephen A', 'stephenilori458@gmail.com', '07012316289', '$2y$10$ToVd7fYSm8ufLlD4S6nHH.nbnDEwOoWsQ2Th1VGIw0S33auYxVE2q', NULL, 1, '2020-05-06 23:12:38'),
(2, '83289jdjds', 'stephenilori458@gmail.com', 'sdjdsjhdt76272', '$2y$10$3DzZwbF/rBY9DjhbyzayZOqe.2cGIXpNziE23BlhdU3C2zTKSvmpC', NULL, 1, '2020-05-06 23:23:54'),
(3, '87567hj', 'stephenilori458@gmail.com', 'hgfeer', '$2y$10$dWgg98rdx5sIAzzLra3MXu4WRdvpLtmqPX9Rux5b/bDMGeRY2Nqdq', NULL, 1, '2020-05-06 23:27:01'),
(4, '87656', 'stephenilori458@gmail.com', 'jhhjjhjh', '$2y$10$0ILrTll7TdZoHPT.Qr/HbObf7xFpMYQzT1mnP1k4myC.nmJZhO2U6', NULL, 1, '2020-05-06 23:27:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_news`
--
ALTER TABLE `db_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_news`
--
ALTER TABLE `db_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `db_user`
--
ALTER TABLE `db_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
