-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 10, 2018 at 09:18 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `focuson2`
--

-- --------------------------------------------------------

--
-- Table structure for table `apis`
--

CREATE TABLE `apis` (
  `api_id` int(11) NOT NULL,
  `api_name` varchar(50) NOT NULL,
  `api_url` varchar(100) NOT NULL,
  `api_type` varchar(100) NOT NULL,
  `api_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apis`
--

INSERT INTO `apis` (`api_id`, `api_name`, `api_url`, `api_type`, `api_category`) VALUES
(1, 'L\'equipe', 'https://newsapi.org/v2/everything?sources=lequipe&apiKey=b5df7b5046664a6e8fb250fa584d5542', 'json', 'sport'),
(2, 'Liberation', 'https://newsapi.org/v2/top-headlines?sources=liberation&apiKey=b5df7b5046664a6e8fb250fa584d5542', 'json', 'political'),
(3, 'National Geograpic', 'https://newsapi.org/v2/top-headlines?sources=national-geographic&apiKey=b5df7b5046664a6e8fb250fa584d', 'json', 'nature'),
(4, 'BBC Sport', 'https://newsapi.org/v2/top-headlines?sources=bbc-sport&apiKey=b5df7b5046664a6e8fb250fa584d5542', 'json', 'sport'),
(5, 'Fox News', 'https://newsapi.org/v2/top-headlines?sources=fox-news&apiKey=b5df7b5046664a6e8fb250fa584d5542', 'json', 'general'),
(6, 'MTV News', 'https://newsapi.org/v2/top-headlines?sources=mtv-news&apiKey=b5df7b5046664a6e8fb250fa584d5542', 'json', 'entertainment');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `idNews` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `keywords` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `fav_user_id` int(11) NOT NULL,
  `fav_api_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`fav_user_id`, `fav_api_id`) VALUES
(4, 3),
(5, 5),
(5, 2),
(4, 5),
(4, 4),
(4, 1),
(4, 2),
(4, 6),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `summary` varchar(300) NOT NULL,
  `sourcedImageFile` longblob NOT NULL,
  `URLArticle` varchar(100) NOT NULL,
  `id_api` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(4, 'paartheepan94', 'paartheepan94@gmail.com', '$2y$10$NEB6tgxpm76XBMeyn2mIeePIEBBQZRvCCDNeWv9igciA.y62W8vta'),
(5, 'aze', 'aze@aze.aze', '$2y$10$Td8Mdfl48QkiZ9BWRAQhvedWrqaY10ugpCLKpWBx6ZGG537W9Ki3W'),
(6, 'user1', 'user1@gmail.com', '$2y$10$VQF4Gs0s6TI37DcIU6U.5.srEr5wV9N440oTZwH3BB1uyqKizAlB6'),
(7, 'sank', 'sankayzn@gmail.com', '$2y$10$3EdbzdiPVFGisoYOjQH0YegtqUf6djNsFuOxJRIu5MDT6mSSlMuQC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apis`
--
ALTER TABLE `apis`
  ADD PRIMARY KEY (`api_id`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apis`
--
ALTER TABLE `apis`
  MODIFY `api_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
