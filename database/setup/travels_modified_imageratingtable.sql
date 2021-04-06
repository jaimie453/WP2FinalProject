-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2018 at 11:29 PM
-- Server version: 5.5.56-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hbennet3`
--

-- --------------------------------------------------------

--
-- Table structure for table `travelimagerating`
--

CREATE TABLE IF NOT EXISTS `travelimagerating` (
  `ImageRatingID` int(11) NOT NULL,
  `ImageID` int(11) DEFAULT NULL,
  `Rating` tinyint(4) DEFAULT NULL,
  `comment` text,
  `datecreated` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `travelimagerating`
--

INSERT INTO `travelimagerating` (`ImageRatingID`, `ImageID`, `Rating`, `comment`, `datecreated`) VALUES
(1, 1, 4, NULL, '0000-00-00'),
(2, 1, 4, NULL, '0000-00-00'),
(3, 2, 2, NULL, '0000-00-00'),
(4, 2, 5, NULL, '0000-00-00'),
(5, 1, 3, NULL, '0000-00-00'),
(6, 1, 5, NULL, '0000-00-00'),
(7, 2, 1, NULL, '0000-00-00'),
(8, 3, 5, NULL, '0000-00-00'),
(9, 3, 4, NULL, '0000-00-00'),
(10, 3, 4, NULL, '0000-00-00'),
(11, 3, 5, NULL, '0000-00-00'),
(12, 4, 4, NULL, '0000-00-00'),
(13, 4, 2, NULL, '0000-00-00'),
(14, 4, 1, NULL, '0000-00-00'),
(15, 4, 1, NULL, '0000-00-00'),
(16, 5, 5, NULL, '0000-00-00'),
(17, 5, 4, NULL, '0000-00-00'),
(18, 5, 4, NULL, '0000-00-00'),
(19, 6, 3, NULL, '0000-00-00'),
(20, 6, 3, NULL, '0000-00-00'),
(21, 6, 3, NULL, '0000-00-00'),
(22, 6, 4, NULL, '0000-00-00'),
(23, 7, 3, NULL, '0000-00-00'),
(24, 7, 4, NULL, '0000-00-00'),
(25, 8, 3, NULL, '0000-00-00'),
(26, 8, 3, NULL, '0000-00-00'),
(27, 8, 4, NULL, '0000-00-00'),
(28, 8, 3, NULL, '0000-00-00'),
(29, 8, 4, NULL, '0000-00-00'),
(30, 9, 5, NULL, '0000-00-00'),
(31, 9, 4, NULL, '0000-00-00'),
(32, 9, 4, NULL, '0000-00-00'),
(33, 9, 4, NULL, '0000-00-00'),
(34, 10, 2, NULL, '0000-00-00'),
(35, 10, 4, NULL, '0000-00-00'),
(36, 10, 3, NULL, '0000-00-00'),
(37, 10, 3, NULL, '0000-00-00'),
(38, 10, 5, NULL, '0000-00-00'),
(39, 11, 3, NULL, '0000-00-00'),
(40, 11, 4, NULL, '0000-00-00'),
(41, 11, 5, NULL, '0000-00-00'),
(42, 11, 5, NULL, '0000-00-00'),
(43, 12, 4, NULL, '0000-00-00'),
(44, 12, 4, NULL, '0000-00-00'),
(45, 12, 3, NULL, '0000-00-00'),
(46, 12, 5, NULL, '0000-00-00'),
(47, 12, 4, NULL, '0000-00-00'),
(48, 12, 3, NULL, '0000-00-00'),
(49, 13, 3, NULL, '0000-00-00'),
(50, 13, 3, NULL, '0000-00-00'),
(51, 14, 4, NULL, '0000-00-00'),
(52, 15, 2, NULL, '0000-00-00'),
(53, 15, 1, NULL, '0000-00-00'),
(54, 16, 5, NULL, '0000-00-00'),
(55, 16, 5, NULL, '0000-00-00'),
(56, 16, 4, NULL, '0000-00-00'),
(57, 16, 4, NULL, '0000-00-00'),
(58, 16, 5, NULL, '0000-00-00'),
(59, 17, 3, NULL, '0000-00-00'),
(60, 18, 3, NULL, '0000-00-00'),
(61, 2, 3, NULL, '0000-00-00'),
(62, 5, 4, NULL, '0000-00-00'),
(63, 7, 4, NULL, '0000-00-00'),
(64, 10, 4, NULL, '0000-00-00'),
(65, 19, 5, NULL, '0000-00-00'),
(66, 19, 4, NULL, '0000-00-00'),
(67, 20, 4, NULL, '0000-00-00'),
(68, 20, 5, NULL, '0000-00-00'),
(69, 21, 3, NULL, '0000-00-00'),
(70, 21, 3, NULL, '0000-00-00'),
(71, 21, 4, NULL, '0000-00-00'),
(72, 22, 5, NULL, '0000-00-00'),
(73, 23, 3, NULL, '0000-00-00'),
(74, 23, 4, NULL, '0000-00-00'),
(75, 18, 3, NULL, '0000-00-00'),
(76, 15, 5, NULL, '0000-00-00'),
(77, 24, 4, NULL, '0000-00-00'),
(78, 24, 4, NULL, '0000-00-00'),
(79, 25, 5, NULL, '0000-00-00'),
(80, 25, 4, NULL, '0000-00-00'),
(81, 25, 5, NULL, '0000-00-00'),
(82, 25, 5, NULL, '0000-00-00'),
(83, 20, 3, NULL, '0000-00-00'),
(84, 26, 4, NULL, '0000-00-00'),
(85, 26, 4, NULL, '0000-00-00'),
(86, 27, 3, NULL, '0000-00-00'),
(87, 27, 4, NULL, '0000-00-00'),
(88, 28, 2, NULL, '0000-00-00'),
(89, 28, 3, NULL, '0000-00-00'),
(90, 28, 3, NULL, '0000-00-00'),
(91, 25, 4, NULL, '0000-00-00'),
(92, 29, 3, NULL, '0000-00-00'),
(93, 29, 5, NULL, '0000-00-00'),
(94, 29, 5, NULL, '0000-00-00'),
(95, 30, 2, NULL, '0000-00-00'),
(96, 30, 4, NULL, '0000-00-00'),
(97, 31, 5, NULL, '0000-00-00'),
(98, 31, 4, NULL, '0000-00-00'),
(99, 31, 4, NULL, '0000-00-00'),
(100, 32, 5, NULL, '0000-00-00'),
(101, 33, 1, NULL, '0000-00-00'),
(102, 26, 3, NULL, '0000-00-00'),
(103, 22, 2, NULL, '0000-00-00'),
(104, 30, 3, NULL, '0000-00-00'),
(105, 30, 3, NULL, '0000-00-00'),
(106, 42, 4, NULL, '0000-00-00'),
(107, 42, 5, NULL, '0000-00-00'),
(108, 47, 3, NULL, '0000-00-00'),
(109, 47, 4, NULL, '0000-00-00'),
(110, 50, 5, NULL, '0000-00-00'),
(111, 50, 4, NULL, '0000-00-00'),
(112, 51, 3, NULL, '0000-00-00'),
(113, 52, 4, NULL, '0000-00-00'),
(114, 51, 3, NULL, '0000-00-00'),
(115, 53, 4, NULL, '0000-00-00'),
(116, 53, 4, NULL, '0000-00-00'),
(117, 55, 3, NULL, '0000-00-00'),
(118, 55, 3, NULL, '0000-00-00'),
(119, 55, 5, NULL, '0000-00-00'),
(120, 56, 4, NULL, '0000-00-00'),
(121, 57, 4, NULL, '0000-00-00'),
(122, 57, 5, NULL, '0000-00-00'),
(123, 58, 5, NULL, '0000-00-00'),
(124, 58, 4, NULL, '0000-00-00'),
(125, 57, 4, NULL, '0000-00-00'),
(126, 59, 4, NULL, '0000-00-00'),
(127, 59, 5, NULL, '0000-00-00'),
(128, 60, 4, NULL, '0000-00-00'),
(129, 60, 3, NULL, '0000-00-00'),
(130, 60, 2, NULL, '0000-00-00'),
(131, 60, 4, NULL, '0000-00-00'),
(132, 61, 4, NULL, '0000-00-00'),
(133, 61, 4, NULL, '0000-00-00'),
(134, 62, 4, NULL, '0000-00-00'),
(135, 62, 3, NULL, '0000-00-00'),
(136, 62, 3, NULL, '0000-00-00'),
(137, 66, 4, NULL, '0000-00-00'),
(138, 66, 5, NULL, '0000-00-00'),
(139, 66, 5, NULL, '0000-00-00'),
(140, 67, 4, NULL, '0000-00-00'),
(141, 67, 4, NULL, '0000-00-00'),
(142, 68, 5, NULL, '0000-00-00'),
(143, 68, 5, NULL, '0000-00-00'),
(144, 68, 4, NULL, '0000-00-00'),
(145, 69, 3, NULL, '0000-00-00'),
(146, 69, 4, NULL, '0000-00-00'),
(147, 69, 4, NULL, '0000-00-00'),
(148, 70, 3, NULL, '0000-00-00'),
(149, 70, 3, NULL, '0000-00-00'),
(150, 70, 4, NULL, '0000-00-00'),
(151, 65, 4, NULL, '0000-00-00'),
(152, 66, 4, NULL, '0000-00-00'),
(153, 60, 5, NULL, '0000-00-00'),
(154, 71, 3, NULL, '0000-00-00'),
(155, 71, 3, NULL, '0000-00-00'),
(156, 71, 2, NULL, '0000-00-00'),
(157, 72, 4, NULL, '0000-00-00'),
(158, 73, 5, NULL, '0000-00-00'),
(159, 73, 4, NULL, '0000-00-00'),
(160, 73, 5, NULL, '0000-00-00'),
(161, 74, 3, NULL, '0000-00-00'),
(162, 74, 2, NULL, '0000-00-00'),
(163, 74, 5, NULL, '0000-00-00'),
(164, 74, 4, NULL, '0000-00-00'),
(165, 74, 5, NULL, '0000-00-00'),
(166, 74, 5, NULL, '0000-00-00'),
(167, 74, 5, NULL, '0000-00-00'),
(168, 74, 3, NULL, '0000-00-00'),
(169, 76, 5, NULL, '0000-00-00'),
(170, 77, 4, NULL, '0000-00-00'),
(171, 77, 4, NULL, '0000-00-00'),
(172, 77, 3, NULL, '0000-00-00'),
(173, 77, 4, NULL, '0000-00-00'),
(174, 78, 3, NULL, '0000-00-00'),
(175, 78, 4, NULL, '0000-00-00'),
(176, 81, 2, NULL, '0000-00-00'),
(177, 81, 2, NULL, '0000-00-00'),
(178, 81, 1, NULL, '0000-00-00'),
(179, 81, 4, NULL, '0000-00-00'),
(180, 81, 2, NULL, '0000-00-00'),
(181, 82, 3, NULL, '0000-00-00'),
(182, 82, 3, NULL, '0000-00-00'),
(183, 57, 5, NULL, '0000-00-00'),
(184, 57, 5, NULL, '0000-00-00'),
(185, 47, 4, NULL, '0000-00-00'),
(186, 44, 4, NULL, '0000-00-00'),
(187, 44, 5, NULL, '0000-00-00'),
(188, 44, 3, NULL, '0000-00-00'),
(189, 46, 4, NULL, '0000-00-00'),
(190, 46, 4, NULL, '0000-00-00'),
(191, 52, 5, NULL, '0000-00-00'),
(192, 53, 2, NULL, '0000-00-00'),
(193, 55, 5, NULL, '0000-00-00'),
(194, 47, 4, NULL, '0000-00-00'),
(195, 64, 4, NULL, '0000-00-00'),
(196, 66, 4, NULL, '0000-00-00'),
(197, 70, 5, NULL, '0000-00-00'),
(198, 5, 5, NULL, '0000-00-00'),
(199, 5, 3, NULL, '0000-00-00'),
(200, 7, 3, NULL, '0000-00-00'),
(201, 22, 4, NULL, '0000-00-00'),
(202, 42, 3, NULL, '0000-00-00'),
(203, 40, 1, NULL, '0000-00-00'),
(204, 74, 4, NULL, '0000-00-00'),
(205, 40, 2, NULL, '0000-00-00'),
(206, 41, 1, NULL, '0000-00-00'),
(207, 41, 3, NULL, '0000-00-00'),
(208, 63, 3, NULL, '0000-00-00'),
(209, 51, 4, NULL, '0000-00-00'),
(210, 1, 4, 'This is some text here that I have created', '2018-05-03'),
(212, 3, 4, 'Wow this image has amazed me and I cannot wait to visit this place', '2018-05-03'),
(213, 3, 3, 'New Review during web', '2018-05-03'),
(214, 3, 3, 'New Review during web', '2018-05-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `travelimagerating`
--
ALTER TABLE `travelimagerating`
  ADD PRIMARY KEY (`ImageRatingID`),
  ADD KEY `ImageID` (`ImageID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `travelimagerating`
--
ALTER TABLE `travelimagerating`
  MODIFY `ImageRatingID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=215;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;