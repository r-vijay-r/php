-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2016 at 11:12 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vijay`
--

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(3) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `mob` bigint(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `uname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `fname`, `lname`, `gender`, `city`, `state`, `country`, `mob`, `email`, `uname`) VALUES
(1, 'Vijay', 'R', 'Male', 'Peroorkada', 'Kerala', 'India', 9447897413, 'vijay@gmail.com', 'vijay');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(3) DEFAULT NULL,
  `uname` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `uname`, `password`) VALUES
(1, 'vijay', 'vijay');

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

CREATE TABLE `mark` (
  `id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `age` int(3) NOT NULL,
  `mark` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`id`, `name`, `gender`, `age`, `mark`) VALUES
(1, 'Vijay R', 'Male', 21, 250),
(2, 'Arun A S', 'Male', 20, 260),
(3, 'Aswathi', 'Female', 28, 210),
(4, 'Varsha V', 'Female', 19, 200);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(5) NOT NULL,
  `stock` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `name`, `price`, `stock`) VALUES
(1, 'Pen', 5, 27),
(2, 'Pencil', 3, 49),
(3, 'Sharpner', 6, 20),
(4, 'Paper', 1, 0),
(5, 'new', 10, 0),
(6, 'new', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qid` int(4) NOT NULL,
  `question` varchar(200) NOT NULL,
  `op1` varchar(200) NOT NULL,
  `op2` varchar(200) NOT NULL,
  `op3` varchar(200) NOT NULL,
  `op4` varchar(200) NOT NULL,
  `answer` varchar(200) NOT NULL,
  `mark` int(4) NOT NULL DEFAULT '0',
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `question`, `op1`, `op2`, `op3`, `op4`, `answer`, `mark`, `level`) VALUES
(1, 'Which one of the following is in solid state?', 'Water', 'Petrol', 'Rock', 'Oxygen', 'Rock', 1, 'medium'),
(2, 'Capital of India is : ', 'Kerala', 'Mumbai', 'Goa', 'Delhi', 'Delhi', 1, 'beginer'),
(3, 'Lion is the king of ', 'House', 'Forest', 'Dogs', 'Hens', 'Forest', 1, 'medium');

-- --------------------------------------------------------

--
-- Table structure for table `stdexamdet`
--

CREATE TABLE `stdexamdet` (
  `id` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `age` int(4) NOT NULL,
  `address` varchar(150) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `email` varchar(70) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `pword` varchar(50) NOT NULL,
  `beginer` int(5) DEFAULT NULL,
  `medium` int(5) DEFAULT NULL,
  `expert` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stdexamdet`
--

INSERT INTO `stdexamdet` (`id`, `name`, `gender`, `age`, `address`, `mobile`, `email`, `uname`, `pword`, `beginer`, `medium`, `expert`) VALUES
(0, 'admin', 'admin', 22, 'admin', 666, 'admin@admin.com', 'admin', 'admin', NULL, NULL, NULL),
(1, 'vijay r', 'male', 21, 'soddisfare', 1234567890, 'vijay@soddisfare.com', 'vijay', 'vijay', NULL, NULL, NULL),
(2, 'Madu Lakshmi', 'Female', 22, 'Soddisfare', 1234567890, 'ml@soddisfare.com', 'madu', 'madu', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`uname`);

--
-- Indexes for table `mark`
--
ALTER TABLE `mark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `stdexamdet`
--
ALTER TABLE `stdexamdet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mark`
--
ALTER TABLE `mark`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stdexamdet`
--
ALTER TABLE `stdexamdet`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
