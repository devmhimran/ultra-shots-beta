-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2020 at 08:03 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ultra-shots`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `post_photo` varchar(255) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_photo`, `created_at`, `status`) VALUES
(12, '5 ', '2074b5bc7019ce49601e80eb7651686b.jpg', '2020-11-03 07:06:49.645135', ''),
(13, '5 ', 'f7a0e94878b88c45be128b34284a53db.jpg', '2020-11-03 07:14:11.153296', ''),
(19, '2 ', 'e5fbe67441fae18176127f54a792c694.jpg', '2020-11-03 08:51:25.334629', ''),
(20, '2 ', '2ef016c9b83604e2f7d8370992b8ea9d.jpg', '2020-11-03 08:52:32.467807', ''),
(21, '5 ', '30911cd6222d6fd690499aeb42bc5f63.jpg', '2020-11-03 10:21:55.904280', ''),
(22, '6 ', '332410c17e0e56574756a87d1c60af83.jpg', '2020-11-03 14:21:55.417760', ''),
(23, '6 ', '980a80ce1a301c71c260b9af2489957a.jpg', '2020-11-03 14:22:03.296490', ''),
(26, '4 ', 'f6b8a64eadd3e75094b9e126289d8cc2.jpg', '2020-11-08 18:54:33.733005', ''),
(27, '4 ', 'a4b9348b6ad27c3b2e8b93bf373918c7.jpg', '2020-11-08 19:05:16.179919', ''),
(28, '5 ', 'cf02bd02ec8cab19ac6d6878ebcad02f.jpg', '2020-11-10 05:36:26.850551', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(10) NOT NULL,
  `user1_name` varchar(50) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_bio` text NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `user_photo` varchar(255) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `user1_name`, `user_username`, `user_email`, `user_address`, `user_bio`, `user_password`, `user_photo`, `created_at`, `status`) VALUES
(1, 'Imran ', 'imran001', 'imran0@gmail.com', 'Dhaka', 'Lorem', '', '1eb6f23a2e33ca556f3abba0fdc40b16.jpg', '0000-00-00 00:00:00.000000', ''),
(2, 'Imran ', 'imran00', 'imran00@gmail.com', 'Mirpur-1, Dhaka-1216', 'lorem', '', 'f922c08b7fa96a0dd13e0df11b8ac6b5.jpg', '0000-00-00 00:00:00.000000', ''),
(4, 'MH', 'mh00', 'mh@', 'Dhaka', 'Lorem', '', 'c30e5902e585ccbfddb66faa054fa55c.jpg', '0000-00-00 00:00:00.000000', ''),
(5, 'Mahmud H', 'mahmud101', 'mahmud110@gmail.com', 'Mirpur-11, Dhaka-1216', 'Lorem', '', 'd1aae4fdb59ac9208e42c2f44a621164.jpg', '2020-11-03 06:48:46.281727', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
