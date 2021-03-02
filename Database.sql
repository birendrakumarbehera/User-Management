-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2021 at 09:48 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `matriculation` text NOT NULL,
  `intermediate` text NOT NULL,
  `graduation` varchar(300) NOT NULL,
  `post_graduation` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `email`, `matriculation`, `intermediate`, `graduation`, `post_graduation`) VALUES
(6, 'kumar.tanmay21@gmail.com', 'K.V,CBSE,2011-07-31,2012-03-31,75', 'K.V,CBSE,2012-07-30,2014-03-31,68.00', 'Ravenshaw university,Ravenshaw university,2014-07-20,2017-03-30,8.25', 'College Of Engineering And Technology,Biju Patnaik University and Technology,2017-07-16,2020-07-20,7.85'),
(12, 'purohit.aparna@gmail.com', 'KSUB,KSUB,2011-07-25,2012-03-31,8.55', 'KSUB,KSUB,2012-07-20,2014-03-31,8.67', ',,,,', ',,,,'),
(13, 'iambiren00@gmail.com', 'Barah Pragana High School,Board of Secondary Education,2009-07-30,2010-03-31,70.16', 'Sailendra Narayan College,Council of Higher Secondary Education,2010-08-15,2012-03-30,55.00', 'Sailendra Narayan College,Utkal University,2012-07-30,2016-03-20,60.67', 'College Of Engineering And Technology,Biju Patnaik University and Technology,2017-08-15,2020-07-31,8.03'),
(14, 'patrasujitbhaskar@gmail.com', 'S.p School,Surat Board,2011-08-25,2012-03-15,89.67', 'S.v College,CHSE,Surat,2012-07-15,2014-03-25,77.56', ',,,,', ',,,,');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `marital_status` varchar(10) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `gender`, `dob`, `permanent_address`, `marital_status`, `mobile`, `photo`) VALUES
(23, 'Tanmaya maghia', 'kumar.tanmay21@gmail.com', 'tanmay@21', 'Male', '1996-05-28', 'Housing board colony,chandasekharpur, bhubaneswar , 751020      ', 'divorced', 7008734292, 'IMG-20180630-WA0003.jpg'),
(29, 'Aparna Purohit', 'purohit.aparna@gmail.com', 'Aparna@321', 'Male', '1996-07-18', '              Bhubaneswar', 'unmarried', 9654120215, 'aparna_purohit.png'),
(30, 'Birendra Kumar Behera', 'iambiren00@gmail.com', 'Biren@200', 'Male', '1995-05-28', 'Kandiahat,Rajkanika,kendrapara,Odisha 755016        \r\n      ', 'unmarried', 9861603040, 'Photo.jpg'),
(31, 'Patra Sujit Bhaskar', 'patrasujitbhaskar@gmail.com', 'Sujit@300', 'Male', '1997-08-20', 'Bhanjanagar, Ganjam, Odisha        \r\n      ', 'unmarried', 8093391278, 'sujit.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
