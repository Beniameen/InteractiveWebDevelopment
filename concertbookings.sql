-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2020 at 08:40 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `concertbookings`
--
CREATE DATABASE IF NOT EXISTS `concertbookings` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `concertbookings`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('Jack', '12345678'),
('John', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `mobilePhone` varchar(15) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `surname` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `cancelmessage` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`mobilePhone`, `firstname`, `DOB`, `surname`, `password`, `cancelmessage`) VALUES
('0432914143', 'dodo', '2000-06-21', 'lolo', '12345678', ''),
('5331330', 'lucy', '2020-08-14', 'jack', '12345678', ''),
('53486008', 'lolo', '2002-01-01', 'nabil', '123456789', ''),
('55006677', 'fifi', '2020-07-30', 'adam', '12345678', ''),
('55555555', 'lala', '2002-01-01', 'kamala', '12345678', ''),
('5566778899', 'layla', '2020-10-28', 'magdy', '12345678', ''),
('7636656', 'lucy', '2019-04-19', 'edam', '12345678', ''),
('94875665466', 'ann', '2019-04-19', 'edward', '12345678', '');

-- --------------------------------------------------------

--
-- Table structure for table `bands`
--

CREATE TABLE `bands` (
  `band_id` int(15) UNSIGNED NOT NULL,
  `band_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bands`
--

INSERT INTO `bands` (`band_id`, `band_name`) VALUES
(2, 'Kelly Roth'),
(27, 'The Leader'),
(1, 'The Leader coins');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(15) UNSIGNED NOT NULL,
  `mobilePhone` varchar(15) NOT NULL,
  `concert_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `mobilePhone`, `concert_id`) VALUES

(431, '5331330', 133),
(446, '55006677', 202),
(447, '55006677', 203),
(448, '0432914143', 202),
(450, '0432914143', 203),
(451, '53486008', 202),
(453, '53486008', 203),
(454, '55555555', 196),
(455, '55555555', 201),
(459, '5566778899', 202),
(461, '7636656', 196),
(462, '7636656', 202),
(463, '94875665466', 202),
(464, '94875665466', 196),


-- --------------------------------------------------------

--
-- Table structure for table `concerts`
--

CREATE TABLE `concerts` (
  `concert_id` int(15) UNSIGNED NOT NULL,
  `band_id` int(15) NOT NULL,
  `venue_id` int(15) NOT NULL,
  `concert_date` datetime NOT NULL,
  `over_18` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `concerts`
--

INSERT INTO `concerts` (`concert_id`, `band_id`, `venue_id`, `concert_date`, `over_18`) VALUES
(127, 2, 46, '2020-10-06 20:37:00', 'y'),
(133, 1, 57, '2020-08-03 09:00:00', 'n'),
(135, 1, 62, '2020-09-01 11:00:00', 'n'),
(196, 27, 61, '2020-12-11 17:43:00', 'n'),
(201, 2, 46, '2020-12-06 16:09:00', 'y'),
(202, 27, 61, '2020-11-08 16:09:00', 'n'),
(203, 1, 46, '2020-11-06 16:10:00', 'n'),
(204, 2, 46, '2020-11-08 19:52:00', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `venue_id` int(15) UNSIGNED NOT NULL,
  `venue_name` varchar(100) NOT NULL,
  `venuecapacity` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`venue_id`, `venue_name`, `venuecapacity`) VALUES
(46, 'Ocean Reef', 4),
(57, 'The Club', 7),
(61, 'Oshclub', 9),
(62, 'Boggletops', 10),
(63, 'THEE', 6),
(65, 'the Sea', 10),
(67, 'Paper', 6),
(69, 'VV', 7),
(70, 'aaaasef', 44345),
(74, 'VF', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`mobilePhone`);

--
-- Indexes for table `bands`
--
ALTER TABLE `bands`
  ADD PRIMARY KEY (`band_id`),
  ADD UNIQUE KEY `band_name` (`band_name`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`concert_id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`venue_id`),
  ADD UNIQUE KEY `venue_name` (`venue_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bands`
--
ALTER TABLE `bands`
  MODIFY `band_id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=469;
--
-- AUTO_INCREMENT for table `concerts`
--
ALTER TABLE `concerts`
  MODIFY `concert_id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;
--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `venue_id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
