-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2018 at 01:46 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sds`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_admins`
--

CREATE TABLE IF NOT EXISTS `t_admins` (
  `a_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `a_Title` varchar(30) NOT NULL,
  `a_Firstname` varchar(30) NOT NULL,
  `a_Lastname` varchar(30) NOT NULL,
  `a_Picture` blob,
  `a_Role` tinytext,
  `a_PhoneNumber` varchar(14) NOT NULL,
  `h_ID` int(5) NOT NULL,
  `a_username` varchar(30) NOT NULL,
  `a_password` varchar(30) NOT NULL,
  PRIMARY KEY (`a_ID`),
  UNIQUE KEY `a_username` (`a_username`,`a_password`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `t_admins`
--

INSERT INTO `t_admins` (`a_ID`, `a_Title`, `a_Firstname`, `a_Lastname`, `a_Picture`, `a_Role`, `a_PhoneNumber`, `h_ID`, `a_username`, `a_password`) VALUES
(1, 'Mr.', 'Adebayo', 'Babalola', NULL, 'Hall Admin of Bethel Activity Hall', '07081129045', 1, 'Babalola9387', 'password'),
(2, 'Mr.', 'Benjamin', 'Ojukwu', NULL, 'Head of Hall worship and card signing at bethel hall', '09036258824', 1, 'Ojukwu2234', 'benojukwu'),
(3, 'Mr.', 'Femi', 'Abubakar', NULL, 'Head Chaplain of Samuel Akande', '08025990065', 6, 'femiA', 'femipass'),
(4, 'Miss.', 'Angela', 'Zika', NULL, 'Chief hall Admin', '07052231189', 5, 'AngelaZika', 'abcde'),
(5, 'Mister', 'Kachi', 'Emenalo', NULL, 'Chaplain Assitant', '07010178416', 6, 'ekachi', 'passk');

-- --------------------------------------------------------

--
-- Table structure for table `t_guardians`
--

CREATE TABLE IF NOT EXISTS `t_guardians` (
  `g_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `g_Title` varchar(5) NOT NULL,
  `g_FirstName` varchar(30) NOT NULL,
  `g_LastName` varchar(30) NOT NULL,
  `g_PhoneNumber` varchar(14) NOT NULL,
  `g_Address` varchar(30) DEFAULT NULL,
  `g_Occupation` varchar(30) NOT NULL,
  PRIMARY KEY (`g_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `t_guardians`
--

INSERT INTO `t_guardians` (`g_ID`, `g_Title`, `g_FirstName`, `g_LastName`, `g_PhoneNumber`, `g_Address`, `g_Occupation`) VALUES
(1, 'Mrs.', 'Nkechi', 'Anyabuike', '07064053742', '42 Ken Uba close, Agungi Lagos', ''),
(62, 'Mr.', 'Odeku', 'Osaye', '09023626745', '25c ogundiron Ajah Lekki Lagos', 'Car manufacturer'),
(63, 'Mr.', 'James', 'Akachukwu', '09035562156', '42b solo ogun street aguda sur', 'Trader'),
(64, 'Mr.', 'Everest', 'Uzoigwe', '08023146190', '25 Barracks Rd ikoyi Lagos', 'Police Officer'),
(65, 'Mr.', 'David', 'Okoli', '08052253341', '13 Festac Road Lagos', 'Naval Officer'),
(66, 'Miste', 'Chikordi', 'Okafor', '08362239947', '24b Akinalo street Ikeja lagos', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_halls`
--

CREATE TABLE IF NOT EXISTS `t_halls` (
  `h_ID` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `h_Name` varchar(30) NOT NULL,
  `h_Type` enum('M','F') NOT NULL,
  `h_Rooms` int(5) NOT NULL,
  PRIMARY KEY (`h_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `t_halls`
--

INSERT INTO `t_halls` (`h_ID`, `h_Name`, `h_Type`, `h_Rooms`) VALUES
(1, 'Bethel Splendor', 'M', 200),
(2, 'Gedion Troopers', 'M', 80),
(3, 'Havilah Gold', 'F', 200),
(4, 'FAAD', 'F', 30),
(5, 'Adeyemo', 'F', 200),
(6, 'Samuel Akande', 'M', 200),
(7, 'Adeleke', 'M', 50);

-- --------------------------------------------------------

--
-- Table structure for table `t_issues`
--

CREATE TABLE IF NOT EXISTS `t_issues` (
  `i_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `i_Offense` varchar(50) NOT NULL,
  `i_Category` varchar(30) DEFAULT NULL,
  `i_Details` text NOT NULL,
  `i_Severity` enum('Very Serious','Serious','Minor','Very Minor') NOT NULL,
  `i_Recommendation` tinytext NOT NULL,
  `a_ID` int(10) NOT NULL,
  `s_ID` int(10) NOT NULL,
  `i_Status` enum('active','cleared') NOT NULL,
  PRIMARY KEY (`i_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `t_issues`
--

INSERT INTO `t_issues` (`i_ID`, `i_Offense`, `i_Category`, `i_Details`, `i_Severity`, `i_Recommendation`, `a_ID`, `s_ID`, `i_Status`) VALUES
(3, 'Cooking Indomie in hall', 'Hall Irregularities', 'The student was caught by a security officer on Tuesday 21st cooking indomie', 'Serious', 'One semester suspension starting from 25th august 2018', 4, 56, 'active'),
(20, 'ttfffy', 'Substance Abuse', 'ctcttct', 'Minor', 'vtcttc', 3, 56, 'active'),
(21, 'ffdfdf', 'Theft', 'dffdff', 'Very Serious', 'dfdfdfd', 3, 57, 'active'),
(22, 'bdbdfdzf', 'Theft', 'gdgfgf', 'Very Serious', 'dfgdfgf', 3, 1, 'active'),
(23, 'gay qq', 'Theft', 'ggdgdg gdggdb fdfb ffb df', 'Very Serious', 'fvfdbdfbdfbdf  fddgdgg', 3, 54, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `t_logs`
--

CREATE TABLE IF NOT EXISTS `t_logs` (
  `l_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `l_Message` varchar(30) NOT NULL,
  `l_Time` datetime NOT NULL,
  PRIMARY KEY (`l_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `t_logs`
--

INSERT INTO `t_logs` (`l_ID`, `l_Message`, `l_Time`) VALUES
(1, 'Mr Seun Added an Issue to Taiw', '2017-11-18 10:13:00'),
(2, 'Case was removed', '2017-11-27 04:10:11'),
(3, 'Case was removed', '2017-11-27 09:11:24'),
(4, 'Case was removed', '2017-11-27 09:41:48'),
(5, 'Case was removed', '2017-11-30 09:33:35'),
(6, 'Case was removed', '2017-11-30 09:42:13'),
(7, 'Case was removed', '2017-11-30 09:43:13'),
(8, 'Case was removed', '2017-11-30 09:43:17'),
(9, 'Case was removed', '2017-12-01 10:47:38'),
(10, 'Case was removed', '2017-12-01 10:47:42'),
(11, 'Case was removed', '2017-12-01 10:47:44'),
(12, 'Case was removed', '2017-12-01 10:47:48'),
(13, 'Case was removed', '2017-12-05 18:43:57');

-- --------------------------------------------------------

--
-- Table structure for table `t_pleas`
--

CREATE TABLE IF NOT EXISTS `t_pleas` (
  `p_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `p_Content` text NOT NULL,
  `p_Title` varchar(100) NOT NULL,
  `s_ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`p_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `t_pleas`
--

INSERT INTO `t_pleas` (`p_ID`, `p_Content`, `p_Title`, `s_ID`) VALUES
(1, 'I am very sorry for the trouble i caused in samuel akande and bethel hall and I hope i will be able to behave better in future', 'Apology for the theft of laptops in my hall', 54),
(5, 'super', 'ssfdffd', 1),
(6, 'ydfyfdyfyfdfd', 'yffdyfdyd', 57),
(7, 'fdgfdggd', 'fdgdfgg', 1),
(8, 'fuck y''all', 'this is not my real face', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_students`
--

CREATE TABLE IF NOT EXISTS `t_students` (
  `s_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_Picture` blob,
  `s_Title` varchar(10) NOT NULL,
  `s_Firstname` varchar(30) NOT NULL,
  `s_Middlename` varchar(30) DEFAULT NULL,
  `s_Lastname` varchar(30) NOT NULL,
  `s_DOB` date NOT NULL,
  `s_Matric` varchar(7) NOT NULL,
  `s_MeritPoints` int(2) NOT NULL,
  `s_CourseOfStudy` varchar(30) NOT NULL,
  `s_Level` int(3) NOT NULL,
  `h_ID` int(10) DEFAULT NULL,
  `s_Room` varchar(5) NOT NULL,
  `s_Gender` enum('M','F') NOT NULL,
  `s_StateOrigin` varchar(30) NOT NULL,
  `s_Address` varchar(50) NOT NULL,
  `s_NextOfKin` varchar(30) DEFAULT NULL,
  `g_ID` int(10) DEFAULT NULL,
  `s_PhoneNumber` varchar(14) NOT NULL,
  `s_DateAdded` datetime NOT NULL,
  PRIMARY KEY (`s_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `t_students`
--

INSERT INTO `t_students` (`s_ID`, `s_Picture`, `s_Title`, `s_Firstname`, `s_Middlename`, `s_Lastname`, `s_DOB`, `s_Matric`, `s_MeritPoints`, `s_CourseOfStudy`, `s_Level`, `h_ID`, `s_Room`, `s_Gender`, `s_StateOrigin`, `s_Address`, `s_NextOfKin`, `g_ID`, `s_PhoneNumber`, `s_DateAdded`) VALUES
(1, NULL, 'Mr.', 'Kingsley', 'Chubie', 'Anyabuike', '1997-01-11', '15/2067', 31, 'Computer Science', 400, 1, 'B22', 'M', 'Imo State', '42 Ken Uba close, Agungi Lekki" Lagos', 'Mrs. Nkechi Aanyabuike', 1, '07059572593', '0000-00-00 00:00:00'),
(54, NULL, 'Mr.', 'Taiwo', 'Femi', 'Osaye', '1998-02-15', '16/2001', 60, 'Computer Science', 200, 1, 'B22', 'M', 'Mrs.', '25c ogundiron Ajah Lekki Lagos', 'Mr and Mrs Osaye', 62, '07032443319', '2017-11-18 20:39:53'),
(55, NULL, 'Miss.', 'Odili', '', 'Akachukwu', '1998-09-11', '14/1552', 60, 'Madam', 400, 3, 'TF05', 'F', 'History', '42b solo ogun street aguda surulere lagos', 'Miss Akachukwu Princess', 63, '08102235599', '2017-11-18 20:50:03'),
(56, NULL, 'Miss.', 'Chinasa', 'Jacquiline', 'Uzoigwe', '1997-10-22', '15/1259', 35, 'Statistics', 300, 4, 'T13', 'F', 'Miss.', '25 Barracks Rd ikoyi Lagos', 'Uchenna Uzoigwe', 64, '', '2017-11-18 22:47:43'),
(57, NULL, 'Master', 'Okoli', 'Franklin', 'Onyebuchi', '1996-12-25', '13/3028', 60, 'Computer Science', 500, 6, 'TF04', 'M', 'Miss.', '13 Festac Road Lagos', 'Miss Uchechi Okoli', 65, '09052245577', '2017-11-20 19:05:17'),
(58, NULL, 'Mr.', 'Dumebi', 'Chidi', 'Okafor', '1991-11-14', '14/2563', 30, 'Madam', 300, 2, 'G23', 'M', 'Accounting', '24b Akinalo street Ikeja lagos', 'Miss Okafor', 66, '07052235728', '2017-11-30 09:39:07');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
