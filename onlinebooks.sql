-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 11, 2020 at 05:15 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinebooks`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_date` varchar(255) NOT NULL,
  `admin_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_date`, `admin_img`) VALUES
(1, 'Dinesh', 'dineshuprety500@gmail.com', 'dinesh', '9 April 2020', '1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'php'),
(2, 'java'),
(3, 'BCA'),
(4, 'Python'),
(5, 'hack');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `n_id` int(11) NOT NULL,
  `n_user` varchar(255) NOT NULL,
  `n_date` varchar(255) NOT NULL,
  `n_status` varchar(255) NOT NULL,
  `n_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`n_id`, `n_user`, `n_date`, `n_status`, `n_text`) VALUES
(1, 'Admin', '10 April 2020', 'Approved', 'Welcome to your website where u can find any kind of pdf which u wanna read'),
(2, 'Admin', '11 April 2020', 'Approved', 'welcome members '),
(3, 'Admin', '11 April 2020', 'Approved', 'try try');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `post_pdf` varchar(255) NOT NULL,
  `post_date` varchar(255) NOT NULL,
  `post_author` varchar(20) NOT NULL DEFAULT 'Dinesh',
  `post_cat_id` int(11) NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'published'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_title`, `post_image`, `post_pdf`, `post_date`, `post_author`, `post_cat_id`, `post_status`) VALUES
(1, 'system analysis and design', 'sad.jpg', 'sad.pdf', '11 April 2020', 'Dinesh', 3, 'Published'),
(2, 'Java Tutorial_Introduction', 'java.jpg', '1.Java Tutorial_Introduction.pdf', '8 April 2020', 'Dinesh', 2, 'Published'),
(3, 'Beginning Programming with Python For Dummies', 'Cover.jpg', 'Beginning Programming with Python For Dummies - Mueller, John Paul [SRG].pdf', '10 April 2020', 'Dinesh', 4, 'Published'),
(4, 'Wireless hacking Book  Lu Xi', 'wireless', 'Wireless Hacking_ How To Hack W - Lu Xi.pdf', '10 April 2020', 'Dinesh', 5, 'Published'),
(5, 'Cython - A Guide For Python Programmers ', 'python', 'Cython - A Guide For Python Programmers - 1st Edition (2015).pdf', '10 April 2020', 'Dinesh', 4, 'Published'),
(6, 'Introducing Python - Modern Computing  ', 'python', 'Introducing Python - Modern Computing in Simple Packages (2014).pdf', '10 April 2020', 'Dinesh', 4, 'Published'),
(7, 'Learning Python, 5th Edition', 'python', 'Learning Python, 5th Edition.pdf', '10 April 2020', 'Dinesh', 4, 'Published'),
(8, 'Kali Linux - Wireless Penetration Testing ', 'wire', 'Kali Linux - Wireless Penetration Testing Beginner\'s Guide (2015).pdf', '10 April 2020', 'Dinesh', 5, 'Published'),
(9, 'Python blackhat ', 'blackhat', 'Justin Seitz-Black Hat Python_ Python Programming for Hackers and Pentesters-No Starch Press (2014).pdf', '10 April 2020', 'Dinesh', 4, 'Published'),
(10, 'java for education', 'java2', 'Java The Complete Reference Ninth Edition.pdf', '11 April 2020', 'Dinesh', 2, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `report_to` varchar(255) NOT NULL,
  `report_subject` varchar(255) NOT NULL,
  `report_text` text NOT NULL,
  `report_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `report_to`, `report_subject`, `report_text`, `report_date`) VALUES
(1, 'DineshUprety', 'Hacking Books', 'Sir, i need hacking books about wireless hacking', '10 April 2020'),
(2, 'DineshUprety', 'about hacking books', 'try try try', '11 April 2020'),
(4, 'Manohar', 'try by manohar', 'hahahaha', '11 April 2020');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `verification_id` bigint(20) NOT NULL,
  `verification_status` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'avatar04.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `verification_id`, `verification_status`, `date`, `img`) VALUES
(1, 'DineshUprety', 'dineshuprety500@gmail.com', '1234', 508751556, 1, '6 April 2020', '75388404_1198274940381737_8796846084593811456_n.jpg'),
(2, 'Manohar', 'coffeecoder500@gmail.com', '1234', 657094686, 1, '6 April 2020', 'avatar04.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
