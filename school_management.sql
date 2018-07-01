-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2018 at 09:51 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `learner_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `student_status` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `date_of_birth` varchar(250) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `address` varchar(255) NOT NULL,
  `year_of_duty` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `learner_type`, `name`, `surname`, `age`, `student_status`, `id_number`, `city`, `date_of_birth`, `citizenship`, `gender`, `address`, `year_of_duty`, `date_time`) VALUES
(77, 'HR student', 'Donald', 'Roy', 24, 'Part time', '9403025151087', 'Pretoria', '1994/March/02', 'South African', 'Male', '37 Marchall Grove', '2018', '2018-06-25 17:42:30'),
(79, 'Tech Students', 'Rishana', 'Moodley', 24, 'Part time', '9403025151090', 'Cape Town', '1994/March/02', 'South African', 'Male', '37 Marchall Grove', '2018', '2018-06-25 20:07:04'),
(83, 'Entrepreneurship student', 'Jhon', 'Ndoe', 24, 'Online', '9403025151081', 'PMB', '1994/March/02', 'South African', 'Male', '45 Germiston', '2018', '2018-06-25 21:46:10'),
(84, 'Entrepreneurship student', 'Rishana', 'Moodley', 31, 'Part time', '8706041010101', 'Pretoria', '1987/Jun/04', 'Permanent Resident', 'Female', '37 Marchall Grove', '2018', '2018-06-25 21:50:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
