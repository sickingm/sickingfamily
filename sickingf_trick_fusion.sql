-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2020 at 08:15 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sickingf_trick_fusion`
--

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL,
  `youtube_id` varchar(12) NOT NULL,
  `title` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`video_id`, `youtube_id`, `title`) VALUES
(1, 'nb8fpXXmWYg', 'Frisbee & Football Trick Shots'),
(2, 'YfteHGq2NyI', 'Trampoline Trick Shots'),
(3, 'DZ9GWcK1sx0', 'Nerf Bow Trick Shots'),
(4, 'WA0pkFaflx8', 'Cousin Edition'),
(5, 'Tg8a6r5i9FY', 'Frisbee Trick Shots'),
(6, 'P2KGI_eyLPI', 'Football Trick Shots'),
(7, 'ZToshSaL6ew', 'Domino Rally 2'),
(8, 'gsii199quC8', 'Dice Stacking Trick Shots'),
(9, 'qN83kBBMYzY', 'Water Bottle Flip Tricks'),
(10, 'csDqUXfUd7s', 'Mini Basketball Trick Shots'),
(11, '2tVxyd4fBFQ', 'Cousin Edition 2'),
(12, 'pLxkDhatCFQ', 'Frisbee Trick Shots 2'),
(13, 'UW-D1IoO2sE', 'Water Bottle Flip Trick Shots 3'),
(14, 'xIc0Zg-WzTQ', 'Best of 2019 '),
(15, 'jHnA1Q6r934', 'Cornhole Trick Shots'),
(16, 'igMB2NxzCP4', 'Trust Edition'),
(17, 'cldMR5yxUMA', 'Juggling Trick Shots'),
(18, 'Rtf9r662TEg', 'Ping Pong Trick Shots 2'),
(19, 'xM1B9bMXRN4', 'Domino Rally 3'),
(20, 'Bh_51HuU_98', 'Going to Michigan!'),
(21, 'qrXnS-pCfIM', 'Vortex Trick Shots');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
