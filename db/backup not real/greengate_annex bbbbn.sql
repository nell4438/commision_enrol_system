-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2019 at 05:58 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greengate_annex2`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_staff`
--

CREATE TABLE `academic_staff` (
  `acs_ID` int(11) NOT NULL,
  `rid_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'record intructor ID',
  `pos_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'academic position ID',
  `subject_ID` int(11) UNSIGNED DEFAULT NULL,
  `sem_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'semester ID'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_staff`
--

INSERT INTO `academic_staff` (`acs_ID`, `rid_ID`, `pos_ID`, `subject_ID`, `sem_ID`) VALUES
(1, 129, 10, 1, 7),
(2, 130, 37, 1, 7),
(3, 131, 37, 1, 7),
(4, 132, 37, 1, 7),
(5, 133, 37, 1, 7),
(6, 134, 37, 1, 7),
(7, 135, 37, 1, 7),
(8, 136, 37, 1, 7),
(9, 137, 10, 4, 7),
(10, 138, 37, 4, 7),
(11, 139, 37, 4, 7),
(12, 140, 37, 4, 7),
(13, 141, 37, 4, 7),
(14, 142, 37, 4, 7),
(15, 143, 37, 4, 7),
(16, 144, 11, 4, 7),
(17, 145, 10, 2, 7),
(18, 146, 12, 2, 7),
(19, 147, 37, 2, 7),
(20, 148, 13, 2, 7),
(21, 149, 37, 2, 7),
(22, 150, 37, 2, 7),
(23, 151, 37, 2, 7),
(24, 152, 14, 2, 7),
(25, 152, 15, 2, 7),
(26, 152, 35, 2, 7),
(27, 153, 10, 5, 7),
(28, 153, 16, 5, 7),
(29, 189, 37, 5, 7),
(30, 154, 37, 5, 7),
(31, 155, 37, 5, 7),
(32, 156, 37, 5, 7),
(33, 157, 37, 5, 7),
(34, 158, 37, 5, 7),
(35, 159, 10, 3, 7),
(36, 160, 37, 3, 7),
(37, 161, 37, 3, 7),
(38, 162, 37, 3, 7),
(39, 163, 37, 3, 7),
(40, 164, 37, 3, 7),
(41, 165, 37, 3, 7),
(42, 166, 37, 3, 7),
(43, 167, 10, 8, 7),
(44, 168, 37, 8, 7),
(45, 169, 18, 8, 7),
(46, 169, 28, 8, 7),
(47, 170, 37, 8, 7),
(48, 171, 20, 8, 7),
(49, 171, 21, 8, 7),
(50, 172, 37, 8, 7),
(51, 173, 37, 8, 7),
(52, 174, 22, 8, 7),
(53, 175, 23, 8, 7),
(54, 176, 10, 7, 7),
(55, 177, 37, 7, 7),
(56, 178, 25, 7, 7),
(57, 178, 27, 7, 7),
(58, 179, 24, 7, 7),
(59, 180, 30, 7, 7),
(60, 180, 29, 7, 7),
(61, 181, 26, 7, 7),
(62, 182, 37, 7, 7),
(63, 183, 10, 9, 7),
(64, 183, 36, 9, 7),
(65, 184, 34, 9, 7),
(66, 185, 31, 9, 7),
(67, 186, 19, 9, 7),
(68, 187, 32, 9, 7),
(69, 188, 19, 9, 7),
(70, 190, 33, 9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `admission_attachment`
--

CREATE TABLE `admission_attachment` (
  `attachment_ID` int(11) UNSIGNED NOT NULL,
  `admission_ID` int(11) UNSIGNED DEFAULT NULL,
  `attachment_Name` varchar(255) DEFAULT NULL,
  `attachment_MIME` tinytext,
  `attachment_Data` longblob,
  `attachment_Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admission_student_details`
--

CREATE TABLE `admission_student_details` (
  `admission_ID` int(11) UNSIGNED NOT NULL,
  `admission_StudNum` varchar(25) DEFAULT NULL,
  `admission_FName` varchar(85) DEFAULT NULL,
  `admission_MName` varchar(85) DEFAULT NULL,
  `admission_LName` varchar(85) DEFAULT NULL,
  `suffix_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'suffix name ID',
  `sex_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'sex/gender ID',
  `admission_Email` varchar(100) DEFAULT NULL,
  `admission_Bday` date DEFAULT NULL,
  `admission_Address` varchar(255) DEFAULT NULL,
  `admission_Height` varchar(25) DEFAULT NULL,
  `admission_BMIStat` varchar(50) DEFAULT NULL,
  `admission_Weight` varchar(25) DEFAULT NULL,
  `admission_House` varchar(25) DEFAULT NULL,
  `admission_Parent` varchar(85) DEFAULT NULL,
  `admission_Contact` varchar(11) DEFAULT NULL,
  `admission_Altcontact` varchar(11) DEFAULT NULL,
  `admission_ParentWork` varchar(85) DEFAULT NULL,
  `admission_Living` varchar(25) DEFAULT NULL,
  `admission_FeedProgReason` varchar(85) DEFAULT NULL,
  `admission_DewormingReason` varchar(85) DEFAULT NULL,
  `admission_medDecease` varchar(255) DEFAULT NULL,
  `admission_medDeceaseDate` varchar(255) DEFAULT NULL,
  `yl_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'year level ID',
  `admission_Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cf_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'Student Classification',
  `sem_ID` int(11) UNSIGNED DEFAULT NULL,
  `admission_Status` tinyint(3) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admission_student_details`
--

INSERT INTO `admission_student_details` (`admission_ID`, `admission_StudNum`, `admission_FName`, `admission_MName`, `admission_LName`, `suffix_ID`, `sex_ID`, `admission_Email`, `admission_Bday`, `admission_Address`, `admission_Height`, `admission_BMIStat`, `admission_Weight`, `admission_House`, `admission_Parent`, `admission_Contact`, `admission_Altcontact`, `admission_ParentWork`, `admission_Living`, `admission_FeedProgReason`, `admission_DewormingReason`, `admission_medDecease`, `admission_medDeceaseDate`, `yl_ID`, `admission_Date`, `cf_ID`, `sem_ID`, `admission_Status`) VALUES
(1, '101106589', 'Josh', 'T', 'Brolin', 1, 1, 'thanos@gmail.com', '1973-02-09', 'United States of America', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '2019-09-05 19:59:34', 2, NULL, 3),
(2, '101106590', 'Tom ', 'S', 'Holland', 1, 1, 'spiderman@gmail.com', '1990-03-21', 'United States of America', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '2019-09-05 19:59:34', 2, NULL, 3),
(3, '101106591', 'Robert', 'I', 'Downey', 20, 1, 'ironman@gmail.com', '1965-04-04', 'United States of America', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '2019-09-05 19:59:34', 2, NULL, 3),
(4, '101106592', 'Chris', 'C', 'Evan', 1, 1, 'captainamerica@gmail.com', '1918-07-04', 'United States of America', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '2019-09-05 19:59:34', 2, NULL, 3),
(5, '101106593', 'Alex', 'C', 'Way', 1, 2, 'Alex@gmail.com', '0000-00-00', 'General Trias', '158', 'That You Are Healthy.(24.03)', '60', 'Owned', 'Gina', '09999999999', '09888888888', 'Weaver', 'Parent', 'Yes', 'No', '[\"M1\",\"M2\",\"M3\",\"M4\"]', '[\"2016-01-01\",\"2017-01-01\",\"2018-01-01\",\"2019-01-01\"]', 1, '2019-10-01 19:35:57', 2, 3, 4),
(6, '101106593', 'Alex ', 'C', 'Way', 1, 2, 'Sample@gmail.com', '1999-10-01', 'Asdashdghjagsd', '138', 'That You Have Overweight.(32.56)', '62', 'Owned', 'Guardain Sample', '12312938910', '76182637816', 'Asgdhjgashjdgjhg', 'Parent', 'Yes', 'Yes', '[\"\",\"\",\"\",\"\"]', '[\"\",\"\",\"\",\"\"]', 3, '2019-10-05 07:22:41', 2, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `gradelevel_subject`
--

CREATE TABLE `gradelevel_subject` (
  `grls_ID` int(11) UNSIGNED NOT NULL,
  `sem_ID` int(11) UNSIGNED DEFAULT NULL,
  `yl_ID` int(11) UNSIGNED DEFAULT NULL,
  `subject_ID` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gradelevel_subject`
--

INSERT INTO `gradelevel_subject` (`grls_ID`, `sem_ID`, `yl_ID`, `subject_ID`) VALUES
(9, 7, 1, 1),
(10, 7, 1, 2),
(11, 7, 1, 3),
(12, 7, 1, 4),
(13, 7, 3, 9),
(14, 7, 3, 8),
(15, 7, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_ID` int(10) UNSIGNED NOT NULL,
  `news_Img` longblob,
  `news_Title` varchar(85) DEFAULT NULL,
  `news_Content` text,
  `news_Pub` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_ID`, `news_Img`, `news_Title`, `news_Content`, `news_Pub`) VALUES
(1, 0x89504e470d0a1a0a0000000d49484452000001af000000b80802000000dbadf4c1000000017352474200aece1ce90000000467414d410000b18f0bfc6105000000097048597300000ec300000ec301c76fa8640000021249444154785eedd4010d00000cc3a03b9ff5a73e40043700361b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121c0b63d6d3425ac3217de400000000049454e44ae426082, 'Imus website is Online.', 'Imus Campus website is now available. Check the menu to view information about the campus.', '2019-03-21 04:05:08'),
(2, 0x89504e470d0a1a0a0000000d49484452000001af000000b80802000000dbadf4c1000000017352474200aece1ce90000000467414d410000b18f0bfc6105000000097048597300000ec300000ec301c76fa8640000021249444154785eedd4010d00000cc3a03b9ff5a73e40043700361b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121c0b63d6d3425ac3217de400000000049454e44ae426082, 'Imus website is Online.', 'Imus Campus website is now available. Check the menu to view information about the campus.', '2019-11-23 04:54:43'),
(3, 0x89504e470d0a1a0a0000000d49484452000001af000000b80802000000dbadf4c1000000017352474200aece1ce90000000467414d410000b18f0bfc6105000000097048597300000ec300000ec301c76fa8640000021249444154785eedd4010d00000cc3a03b9ff5a73e40043700361b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121406c08101b02c48600b121c0b63d6d3425ac3217de400000000049454e44ae426082, 'Imus website is Online.', 'Imus Campus website is now available. Check the menu to view information about the campus.', '2019-11-23 04:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notif_ID` int(11) UNSIGNED NOT NULL,
  `user_ID` int(11) UNSIGNED DEFAULT NULL,
  `notif_Msg` text,
  `notif_Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `notif_Type` tinyint(3) UNSIGNED DEFAULT NULL,
  `notif_State` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `record_admin_details`
--

CREATE TABLE `record_admin_details` (
  `rad_ID` int(11) UNSIGNED NOT NULL,
  `rad_Img` longblob,
  `user_ID` int(11) UNSIGNED DEFAULT NULL,
  `rad_EmpID` varchar(25) DEFAULT NULL,
  `rad_FName` varchar(85) DEFAULT NULL,
  `rad_MName` varchar(85) DEFAULT NULL,
  `rad_LName` varchar(85) DEFAULT NULL,
  `suffix_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'suffix name ID',
  `sex_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'sex/gender ID',
  `marital_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'marital status ID',
  `rad_Email` varchar(100) DEFAULT NULL,
  `rad_Bday` date DEFAULT NULL,
  `rad_Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record_admin_details`
--

INSERT INTO `record_admin_details` (`rad_ID`, `rad_Img`, `user_ID`, `rad_EmpID`, `rad_FName`, `rad_MName`, `rad_LName`, `suffix_ID`, `sex_ID`, `marital_ID`, `rad_Email`, `rad_Bday`, `rad_Address`) VALUES
(1, NULL, 1, '123548', 'Stanley', 'M', 'Lieber', 1, 1, 2, 'stanley1@gmail.com', '1922-12-28', 'Los Angeles, California, United States'),
(2, NULL, 17, '123549', 'Evangeline', 'C', 'Merlyn', 1, 2, 1, 'eva@gmail.com', '2019-09-29', 'eva street');

-- --------------------------------------------------------

--
-- Table structure for table `record_instructor_details`
--

CREATE TABLE `record_instructor_details` (
  `rid_ID` int(11) UNSIGNED NOT NULL,
  `rid_Img` longblob,
  `user_ID` int(11) UNSIGNED DEFAULT NULL,
  `rid_EmpID` varchar(25) DEFAULT NULL,
  `rid_FName` varchar(85) DEFAULT NULL,
  `rid_MName` varchar(85) DEFAULT NULL,
  `rid_LName` varchar(85) DEFAULT NULL,
  `suffix_ID` int(11) UNSIGNED DEFAULT '1' COMMENT 'suffix name ID',
  `sex_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'sex/gender ID',
  `marital_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'marital status ID',
  `rid_Email` varchar(100) DEFAULT NULL,
  `rid_Bday` date DEFAULT NULL,
  `rid_Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record_instructor_details`
--

INSERT INTO `record_instructor_details` (`rid_ID`, `rid_Img`, `user_ID`, `rid_EmpID`, `rid_FName`, `rid_MName`, `rid_LName`, `suffix_ID`, `sex_ID`, `marital_ID`, `rid_Email`, `rid_Bday`, `rid_Address`) VALUES
(129, NULL, 2, '102311', 'Rose', 'C', 'Escanilla', 1, 2, 1, 'rose@gmail.com', '1930-07-30', 'Imus, Phillipines'),
(130, NULL, 5, '102312', 'Gian Fae', 'S', 'Arevalo', 1, 2, 1, 'myemail@gmail.com', '1930-07-30', 'Imus, Phillipines'),
(131, NULL, NULL, '102313', 'Angelica', 'C', 'Consulta', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(132, NULL, NULL, '102314', 'Sheila May    ', '', 'Macado', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(133, NULL, NULL, '102315', 'Janet', 'V', 'Magura', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(134, NULL, NULL, '102316', 'Ester', '', 'Saluna', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(135, NULL, NULL, '102317', 'Rosemarie', 'A', 'Ubana', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(136, NULL, NULL, '102318', 'Isabelle', 'G', 'Victoria', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(137, NULL, NULL, '102319', 'Maryjane', 'A', 'Abanes', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(138, NULL, 22, '102320', 'Mark Leonard', 'S', 'Aguitez', 1, 1, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(139, NULL, NULL, '102321', 'Dea Genn', 'C', 'Gonzales', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(140, NULL, NULL, '102322', 'Gladys', 'F', 'Guirre', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(141, NULL, NULL, '102323', 'Jovelyn', 'S', 'Reyes', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(142, NULL, NULL, '102324', 'Maria Cecilia', 'P', 'Naing', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(143, NULL, NULL, '102325', 'Maribel', 'R', 'Vicedo', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(144, NULL, NULL, '102326', 'Christycile', 'J', 'Dudas', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(145, NULL, NULL, '102327', 'Aisa ', '', 'Rafael', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(146, NULL, NULL, '102328', 'Nicole Ann Ros', '', 'Malapo', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(147, NULL, 23, '102329', 'Ian', '', 'Mauricio', 1, 1, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(148, NULL, NULL, '102330', 'Janet', '', 'Legaspi ', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(149, NULL, NULL, '102331', 'Louielyn', '', 'Cruzado', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(150, NULL, NULL, '102332', 'Angelyn', '', 'Cueno', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(151, NULL, NULL, '102333', 'Darizzeth', '', 'Gelle', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(152, NULL, NULL, '102334', 'Shane Ann', '', 'Regorgo.', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(153, NULL, NULL, '102335', 'Renalyn', '', 'Bandilla', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(154, NULL, NULL, '102336', 'Ana Karina', 'P', 'Duban', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(155, NULL, NULL, '102337', 'Jesusito', 'P', 'Lagrimas', 1, 1, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(156, NULL, NULL, '102338', 'Maricel', 'F', 'Salvador', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(157, NULL, NULL, '102339', 'Agnes', 'S', 'Tuazon', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(158, NULL, NULL, '102340', 'Novalyn', 'B', 'Pakingan', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(159, NULL, NULL, '102341', 'Rhodalyn', 'M', 'Reonico', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(160, NULL, NULL, '102342', 'Mark Julius', 'F', 'Balagtas', 1, 1, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(161, NULL, NULL, '102343', 'Anelyn', 'V', 'Barles', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(162, NULL, NULL, '102344', 'Rochelle Maila', 'D', 'Encina', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(163, NULL, NULL, '102345', 'Maria Zenaida', 'L', 'Parrenas', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(164, NULL, NULL, '102346', 'Marianne', 'E', 'Patilleros', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(165, NULL, 25, '102347', 'Catherine', 'T', 'Silvan', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(166, NULL, NULL, '102348', 'Ma. Erlin', 'P', 'Vargas', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(167, NULL, NULL, '102349', 'Jennifer', 'G', 'Sorreda', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(168, NULL, NULL, '102350', 'Mary May', 'P', 'Anarna', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(169, NULL, NULL, '102351', 'Bem Soe', 'S', 'Antonio', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(170, NULL, NULL, '102352', 'Eunice', 'G', 'Antonio ', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(171, NULL, NULL, '102353', 'Myra', 'L', 'Hermoso', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(172, NULL, NULL, '102354', 'Patricia Ann', 'N', 'Pasardoza', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(173, NULL, NULL, '102355', 'Mazie', 'S', 'Paredez', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(174, NULL, NULL, '102356', 'Jhenielyn', 'C', 'Sarmiento', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(175, NULL, NULL, '102357', 'Mariclaire', 'F', 'Sarte', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(176, NULL, NULL, '102358', 'Nenita', 'L', 'Herrera', 31, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(177, NULL, NULL, '102359', 'Gileann', 'A', 'Bactol', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(178, NULL, NULL, '102360', 'Ricky', 'P', 'Villanueva', 1, 1, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(179, NULL, NULL, '102361', 'Gee Ann', 'L', 'Jao', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(180, NULL, NULL, '102362', 'Edwin', 'G', 'Montes', 1, 1, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(181, NULL, NULL, '102363', 'Arnold', 'F', 'Salonga', 1, 1, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(182, NULL, 24, '102364', 'Christine', 'S', 'Villanueva', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(183, NULL, NULL, '102365', 'Nerisa', 'F', 'Chavez', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(184, NULL, NULL, '102366', 'Evangeline', 'L', 'Bonita', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(185, NULL, NULL, '102367', 'Ma. Mayla', 'B', 'Garzon', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(186, NULL, NULL, '102368', 'Raquel', 'A', 'Monzon', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(187, NULL, 16, '102369', 'Loida', 'S', 'Ortega', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(188, NULL, 12, '102370', 'Jeponica Mae', 'A', 'Ravara', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(189, NULL, 11, '102371', 'Catherine', '', 'Cruz', 1, 2, 1, NULL, '1930-07-30', 'Imus, Phillipines'),
(190, NULL, 9, '102372', 'Darren', 'B', 'Salvador', 1, 2, 1, 'salvador@gmail.com', '1930-07-30', 'Imus, Phillipines');

-- --------------------------------------------------------

--
-- Table structure for table `record_student_details`
--

CREATE TABLE `record_student_details` (
  `rsd_ID` int(11) UNSIGNED NOT NULL,
  `rsd_Img` longblob,
  `user_ID` int(11) UNSIGNED DEFAULT NULL,
  `rsd_StudNum` varchar(25) NOT NULL,
  `rsd_FName` varchar(85) NOT NULL,
  `rsd_MName` varchar(85) NOT NULL,
  `rsd_LName` varchar(85) NOT NULL,
  `suffix_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'suffix name ID',
  `sex_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'sex/gender ID',
  `marital_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'marital status ID',
  `rsd_Email` varchar(100) DEFAULT NULL,
  `rsd_Bday` date DEFAULT NULL,
  `rsd_Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record_student_details`
--

INSERT INTO `record_student_details` (`rsd_ID`, `rsd_Img`, `user_ID`, `rsd_StudNum`, `rsd_FName`, `rsd_MName`, `rsd_LName`, `suffix_ID`, `sex_ID`, `marital_ID`, `rsd_Email`, `rsd_Bday`, `rsd_Address`) VALUES
(1, NULL, 18, '101106589', 'Josh', 'T', 'Brolin', 1, 1, 1, 'thanos@gmail.com', '1973-02-09', 'United States of America'),
(2, NULL, 19, '101106590', 'Tom ', 'S', 'Holland', 1, 1, 1, 'spiderman@gmail.com', '1990-03-21', 'United States of America'),
(3, NULL, 20, '101106591', 'Robert', 'I', 'Downey', 20, 1, 2, 'ironman@gmail.com', '1965-04-04', 'United States of America'),
(4, NULL, 4, '101106592', 'Chris', 'C', 'Evan', 1, 1, 2, 'captainamerica@gmail.com', '1918-07-04', 'United States of America'),
(5, NULL, 21, '101106593', 'Alex ', 'C', 'Way', 1, 1, 1, 'asdas@gmail.com', '2019-09-11', 'address'),
(6, NULL, 15, '101106594', 'Camille', 'C', 'Prats', 1, 2, 2, 'camille@gmail.com', '2019-09-10', 'Manila'),
(7, NULL, NULL, '234234', 'franzmarc', 'asd', 'cabrera', 1, 1, 1, 'franzmarccabrera11@gmail.com', '2019-10-03', 'Blk 38 lot 11 Brgy Aguado');

-- --------------------------------------------------------

--
-- Table structure for table `record_student_enrolled`
--

CREATE TABLE `record_student_enrolled` (
  `rse_ID` int(11) UNSIGNED NOT NULL COMMENT 'record student enrolled ID',
  `rsd_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'record student ID',
  `sem_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'semester ID',
  `yl_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'year level ID'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record_student_enrolled`
--

INSERT INTO `record_student_enrolled` (`rse_ID`, `rsd_ID`, `sem_ID`, `yl_ID`) VALUES
(27, 5, 7, 3),
(28, 4, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ref_ethnic_group`
--

CREATE TABLE `ref_ethnic_group` (
  `ethnic_ID` int(11) UNSIGNED NOT NULL,
  `ethnic_Name` varchar(85) NOT NULL COMMENT 'By Race/Ethnicity'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_ethnic_group`
--

INSERT INTO `ref_ethnic_group` (`ethnic_ID`, `ethnic_Name`) VALUES
(16, 'American Indian/Alaska Native'),
(19, 'Asian  two or more'),
(9, 'Black'),
(8, 'Chinese'),
(2, 'Filipino'),
(18, 'Guamanian/Chamorro'),
(7, 'Hispanic'),
(12, 'Indo-Chinese'),
(4, 'Japanese'),
(13, 'Korean'),
(5, 'Micronesian'),
(11, 'Multiple'),
(1, 'Native Hawaiian'),
(17, 'Other Asian'),
(15, 'Other Pacific Islander'),
(20, 'Pacific Islander two or more'),
(10, 'Portuguese'),
(6, 'Samoan'),
(14, 'Tongan'),
(3, 'White'),
(21, 'White two or more');

-- --------------------------------------------------------

--
-- Table structure for table `ref_marital`
--

CREATE TABLE `ref_marital` (
  `marital_ID` int(11) UNSIGNED NOT NULL,
  `marital_Name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_marital`
--

INSERT INTO `ref_marital` (`marital_ID`, `marital_Name`) VALUES
(1, 'Single'),
(2, 'Married'),
(3, 'Widowed');

-- --------------------------------------------------------

--
-- Table structure for table `ref_position`
--

CREATE TABLE `ref_position` (
  `pos_ID` int(11) UNSIGNED NOT NULL,
  `pos_Name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_position`
--

INSERT INTO `ref_position` (`pos_ID`, `pos_Name`) VALUES
(14, 'ASP Coordinator'),
(22, 'Canteen Manager'),
(16, 'Chairman Prefect of Discipline'),
(9, 'District Supervisor'),
(8, 'Division Supervisor'),
(11, 'Faculty Club President'),
(21, 'Feeding Program Coordinator'),
(20, 'GPP'),
(36, 'Guidance Teacher'),
(34, 'Guidance Teacher G10'),
(31, 'Guidance Teacher G7'),
(32, 'Guidance Teacher G8'),
(33, 'Guidance Teacher G9'),
(23, 'ICT Coordinator'),
(12, 'Journalism Adviser'),
(10, 'Learning Area Coordinator'),
(15, 'Librarian'),
(13, 'Librarian Asst. '),
(7, 'Master Teacher'),
(38, 'Prefect of Discipline'),
(29, 'Prefect of Discipline G10'),
(26, 'Prefect of Discipline G7'),
(27, 'Prefect of Discipline G8'),
(28, 'Prefect of Discipline G9'),
(4, 'Principal I'),
(5, 'Principal II'),
(6, 'Principal III'),
(35, 'Property Custodian'),
(24, 'School Nurse'),
(30, 'Sports Coordinator'),
(17, 'SSG Adviser'),
(25, 'SSO Focal Person'),
(19, 'Student\'s Record-in-Charge'),
(37, 'Teacher'),
(1, 'Teacher I'),
(2, 'Teacher II'),
(3, 'Teacher III'),
(18, 'Waste Management Coordinator');

-- --------------------------------------------------------

--
-- Table structure for table `ref_religion`
--

CREATE TABLE `ref_religion` (
  `religion_ID` int(11) UNSIGNED NOT NULL COMMENT 'Primary Key',
  `religion_Name` varchar(50) DEFAULT NULL COMMENT 'Religion Name'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_religion`
--

INSERT INTO `ref_religion` (`religion_ID`, `religion_Name`) VALUES
(1, 'Ang Dating Daan'),
(2, 'Baptist'),
(3, 'Born Again'),
(4, 'Buddhism'),
(5, 'Roman Catholic'),
(6, 'Christian Protestant'),
(7, 'Iglesia Ni Kristo'),
(8, 'Islam'),
(9, 'Jehovah Witness'),
(10, '\r\n\r\nSeventh Day Adventist'),
(11, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `ref_section`
--

CREATE TABLE `ref_section` (
  `section_ID` int(11) UNSIGNED NOT NULL,
  `section_Name` varchar(85) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_section`
--

INSERT INTO `ref_section` (`section_ID`, `section_Name`) VALUES
(1, 'Section 1'),
(2, 'Section 2'),
(3, 'Section 3'),
(4, 'section 4'),
(5, 'Section 5'),
(6, 'section 6'),
(7, 'Section 7'),
(8, 'Section 8'),
(9, 'Section 9'),
(10, 'Section 10');

-- --------------------------------------------------------

--
-- Table structure for table `ref_semester`
--

CREATE TABLE `ref_semester` (
  `sem_ID` int(11) UNSIGNED NOT NULL,
  `sem_start` date DEFAULT NULL,
  `sem_end` date DEFAULT NULL,
  `stat_ID` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_semester`
--

INSERT INTO `ref_semester` (`sem_ID`, `sem_start`, `sem_end`, `stat_ID`) VALUES
(1, '2013-04-10', '2014-04-27', 0),
(2, '2014-06-01', '2016-03-01', 0),
(3, '2016-06-01', '2015-03-01', 0),
(5, '2017-01-03', '2018-09-04', 0),
(6, '2018-06-20', '2019-03-20', 0),
(7, '2019-06-01', '2020-06-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ref_sex`
--

CREATE TABLE `ref_sex` (
  `sex_ID` int(11) UNSIGNED NOT NULL COMMENT 'Primary Key',
  `sex_Name` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_sex`
--

INSERT INTO `ref_sex` (`sex_ID`, `sex_Name`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status`
--

CREATE TABLE `ref_status` (
  `status_ID` int(11) UNSIGNED NOT NULL,
  `status_Name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_status`
--

INSERT INTO `ref_status` (`status_ID`, `status_Name`) VALUES
(1, 'Enable'),
(2, 'Disable');

-- --------------------------------------------------------

--
-- Table structure for table `ref_subject`
--

CREATE TABLE `ref_subject` (
  `subject_ID` int(11) UNSIGNED NOT NULL,
  `subject_Code` varchar(85) DEFAULT NULL,
  `subject_Title` varchar(85) DEFAULT NULL,
  `Abbreviation` varchar(85) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_subject`
--

INSERT INTO `ref_subject` (`subject_ID`, `subject_Code`, `subject_Title`, `Abbreviation`) VALUES
(1, '201922423', 'Filipino', NULL),
(2, '201922424', 'English', NULL),
(3, '201922425', 'Mathematics', NULL),
(4, '201922426', 'Science', NULL),
(5, '201922427', 'Araling Panlipunan', NULL),
(6, '201922428', 'EPP', 'Edukasyong Pantahanan at Pangkabuhayan'),
(7, '201922429', 'MAPEH', 'Music,Arts,Physical Education,Health'),
(8, '201922430', 'TLE', 'Technology and Livelihood Education'),
(9, '201922431', 'E.S.P', 'Edukasyon sa Panlipunan');

-- --------------------------------------------------------

--
-- Table structure for table `ref_suffixname`
--

CREATE TABLE `ref_suffixname` (
  `suffix_ID` int(11) UNSIGNED NOT NULL COMMENT 'Primary Key',
  `suffix` varchar(10) DEFAULT NULL COMMENT 'suffix name position on the last name ',
  `suffix_Name` varchar(50) DEFAULT NULL COMMENT 'suffix description'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_suffixname`
--

INSERT INTO `ref_suffixname` (`suffix_ID`, `suffix`, `suffix_Name`) VALUES
(1, 'N/A', 'Not Applicable'),
(2, 'CFRE', 'Certified Fund Raising Executive'),
(3, 'CLU', 'Chartered Life Underwriter'),
(4, 'CPA', 'Certified Public Accountant'),
(5, 'C.S.C.', 'Congregation of Holy Cross'),
(6, 'C.S.J.', 'Sisters of St. Joseph'),
(7, 'D.C.', 'Doctor of Chiropractic'),
(8, 'D.D.', 'Doctor of Divinity'),
(9, 'D.D.S.', 'Doctor of Dental Surgery'),
(10, 'D.M.D.', 'Doctor of Dental Medicine'),
(11, 'D.O.', 'Doctor of Osteopathy'),
(12, 'D.V.M.', 'Doctor of Veterinary Medicine'),
(13, 'Ed.D.', 'Doctor of Education'),
(14, 'Esq.', 'Esquire'),
(15, 'II', 'The Second'),
(16, 'III', 'The Third'),
(17, 'IV', 'The Fourth'),
(18, 'Inc.', 'Incorporated'),
(19, 'J.D.', 'Juris Doctor'),
(20, 'Jr.', 'Junior'),
(21, 'LL.D.', 'Doctor of Laws'),
(22, 'Ltd.', 'Limited'),
(23, 'M.D.', 'Doctor of Medicine'),
(24, 'O.D.', 'Doctor of Optometry'),
(25, 'O.S.B.', 'Order of St Benedict'),
(26, 'P.C.', 'Past Commander, Police Constable, Post Commander'),
(27, 'P.E.', 'Protestant Episcopal'),
(28, 'Ph.D.', 'Doctor of Philosophy'),
(29, 'Ret.', 'Retired'),
(30, 'R.G.S', 'Sisters of Our Lady of Charity of the Good Shepher'),
(31, 'R.N.', 'Registered Nurse'),
(32, 'R.N.C.', 'Registered Nurse Clinician'),
(33, 'S.H.C.J.', 'Society of Holy Child Jesus'),
(34, 'S.J.', 'Society of Jesus'),
(35, 'S.N.J.M.', 'Sisters of Holy Names of Jesus & Mary'),
(36, 'Sr.', 'Senior'),
(37, 'S.S.M.O.', 'Sister of Saint Mary Order'),
(38, 'USA', 'United States Army'),
(39, 'USAF', 'United States Air Force'),
(40, 'USAFR', 'United States Air Force Reserve'),
(41, 'USAR', 'United States Army Reserve'),
(42, 'USCG', 'United States Coast Guard'),
(43, 'USMC', 'United States Marine Corps'),
(44, 'USMCR', 'United States Marine Corps Reserve'),
(45, 'USN', 'United States Navy'),
(46, 'USNR', 'United States Navy Reserve');

-- --------------------------------------------------------

--
-- Table structure for table `ref_year_level`
--

CREATE TABLE `ref_year_level` (
  `yl_ID` int(11) UNSIGNED NOT NULL,
  `yl_Name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_year_level`
--

INSERT INTO `ref_year_level` (`yl_ID`, `yl_Name`) VALUES
(1, 'Grade 7'),
(2, 'Grade 8'),
(3, 'Grade 9'),
(4, 'Grade 10');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_ID` int(11) UNSIGNED NOT NULL,
  `rid_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'record intructor ID',
  `section_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'section ID',
  `sem_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'semester ID',
  `yl_ID` int(11) UNSIGNED DEFAULT NULL,
  `status_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'Enable/Disable'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_ID`, `rid_ID`, `section_ID`, `sem_ID`, `yl_ID`, `status_ID`) VALUES
(39, 165, 1, 7, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_enrolled_student`
--

CREATE TABLE `room_enrolled_student` (
  `res_ID` int(11) UNSIGNED NOT NULL COMMENT 'room enrolled student ID',
  `rse_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'record student ID',
  `room_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'room ID'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_enrolled_student`
--

INSERT INTO `room_enrolled_student` (`res_ID`, `rse_ID`, `room_ID`) VALUES
(23, 27, 39);

-- --------------------------------------------------------

--
-- Table structure for table `room_student_attendance`
--

CREATE TABLE `room_student_attendance` (
  `attendance_ID` int(11) UNSIGNED NOT NULL,
  `room_ID` int(11) UNSIGNED DEFAULT NULL,
  `res_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'room enrolled student ID',
  `attendance_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `attendance_Status` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room_student_grade`
--

CREATE TABLE `room_student_grade` (
  `rsg_ID` int(11) UNSIGNED NOT NULL,
  `res_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'room enrolled student ID',
  `rsub_ID` int(11) UNSIGNED DEFAULT NULL,
  `first` float DEFAULT NULL,
  `second` float DEFAULT NULL,
  `third` float DEFAULT NULL,
  `fourth` float DEFAULT NULL,
  `remarks` varchar(85) DEFAULT NULL,
  `final` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_student_grade`
--

INSERT INTO `room_student_grade` (`rsg_ID`, `res_ID`, `rsub_ID`, `first`, `second`, `third`, `fourth`, `remarks`, `final`) VALUES
(1, 23, 1, 100, 90, 80, 70, 'Passed', 85);

-- --------------------------------------------------------

--
-- Table structure for table `room_student_learner_observe`
--

CREATE TABLE `room_student_learner_observe` (
  `rslr_ID` int(10) UNSIGNED NOT NULL,
  `res_ID` int(11) UNSIGNED DEFAULT NULL COMMENT 'room enrolled student',
  `rslr_LearnerValues` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_student_learner_observe`
--

INSERT INTO `room_student_learner_observe` (`rslr_ID`, `res_ID`, `rslr_LearnerValues`) VALUES
(3, NULL, '[\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"RO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\"]'),
(9, NULL, '[\"AO\",\"AO\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\"]'),
(12, NULL, '[\"SO\",\"RO\",\"RO\",\"RO\",\"NO\",\"NO\",\"NO\",\"SO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"AO\",\"RO\"]'),
(13, NULL, '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\"]');

-- --------------------------------------------------------

--
-- Table structure for table `room_subject`
--

CREATE TABLE `room_subject` (
  `rsub_ID` int(11) UNSIGNED NOT NULL,
  `room_ID` int(11) UNSIGNED DEFAULT NULL,
  `acs_ID` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_subject`
--

INSERT INTO `room_subject` (`rsub_ID`, `room_ID`, `acs_ID`) VALUES
(1, 39, 41);

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `user_ID` int(11) UNSIGNED NOT NULL,
  `lvl_ID` tinyint(4) UNSIGNED DEFAULT NULL COMMENT 'user level',
  `user_Img` longblob,
  `user_Name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_Pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_Reset` tinyint(3) UNSIGNED DEFAULT '3',
  `user_Registered` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user_ID`, `lvl_ID`, `user_Img`, `user_Name`, `user_Pass`, `user_Reset`, `user_Registered`) VALUES
(1, 3, NULL, 'admin', '$2y$10$velf4UkOSl9E3lpgcZEJc.5a48Yu/PykfZXlN5EY/WPkGxE4LHsgW', 0, '2019-05-12 11:54:15'),
(2, 2, NULL, '102311', '$2y$10$NAi.zNhpKh0v/wYUP38GWusUqUwe90Wm5oRQnhAeLtFMC8/rfXpMW', 3, '2019-05-12 11:54:15'),
(4, 1, NULL, '101106592', '$2y$10$G/SzIVkCOJprrgxXC81nhe64dfODd9AFjnmOKmiUMTCikahjnW1oS', 3, '2019-09-01 16:53:54'),
(5, 2, NULL, '102312', '$2y$10$NAi.zNhpKh0v/wYUP38GWusUqUwe90Wm5oRQnhAeLtFMC8/rfXpMW', 3, '2019-05-12 11:54:15'),
(9, 2, NULL, '102372', '$2y$10$pGTEffrD7deUyiKEtO/N3u/aaTWi3UjxQ0dM6Nx1fAE90VA8YdhWq', 3, '2019-09-19 14:59:09'),
(11, 2, NULL, '102371', '$2y$10$hYgSMamgFE3JgKPCgu6jM.0jX.xRtN15kyHVjKZT7HwfnD534e/gC', 3, '2019-09-19 15:18:08'),
(12, 2, NULL, '102370', '$2y$10$h1F67dh/JgRob0cwx9WH/Or3iGTwA2/SrGOrFsAkGqYu7X7fAmIMe', 3, '2019-09-21 06:42:00'),
(15, 1, NULL, '101106594', '$2y$10$3RtmXJSh9JIS5ufIJQy3DeCfDP9HKFDjq5dmQookDEpFHyTgoQJaq', 3, '2019-09-30 02:32:44'),
(16, 2, NULL, '102369', '$2y$10$bCHT.Mr9UhJmQk2T5l/e2ORkXHdKVXG0giKDEzuGJTfk6uyUxQUyy', 3, '2019-10-12 07:40:10'),
(17, 3, NULL, '123549', '$2y$10$pv8Dnv7VMBo966RRD5Mi7.R.Y62UUojE0qud5YaSWw7H5.EY59VR2', 3, '2019-10-15 17:36:45'),
(18, 1, NULL, '101106589', '$2y$10$vxB6DjFx7PEk3mT.pz4yjus/KJHSgALgz0tauLNKnBCw5kNfIXYUi', 3, '2019-10-19 08:30:02'),
(19, 1, NULL, '101106590', '$2y$10$GirG30vQwrY39SU2UXzcnecgCiV4iKWf4CcyI6FJ3fxklhnucch6W', 3, '2019-10-19 08:30:20'),
(20, 1, NULL, '101106591', '$2y$10$SkfNsSIBQgavdiuPkPnUreaTeMlKJEf5/LGjfahxdfQeOJ/2kFlxy', 3, '2019-10-19 08:30:48'),
(21, 1, NULL, '101106593', '$2y$10$YPWQ.3Kv4DPbnmUQpeyrqODoHOYFKjx1B7gh65Ol8lZWMYfzU..q2', 3, '2019-10-19 08:31:00'),
(22, 2, NULL, '102320', '$2y$10$zSwyCG7R16AD3xEnIfGlE.o6cCkxZL3nW8YDLV/GP/SBrOq.5ZJd2', 3, '2019-10-19 08:33:45'),
(23, 2, NULL, '102329', '$2y$10$8XxHNVoCfWwTNJiAcLsFy.I1rp7QNxcdt7kHc8cxkohxjAmNILw8y', 3, '2019-10-19 08:34:15'),
(24, 2, NULL, '102364', '$2y$10$4vFXm3rU5zvdb2MBPllQbu/jyd7lPl48IwQqZ5hgPA.kTtnpGoWTu', 3, '2019-10-19 08:34:36'),
(25, 2, NULL, '102347', '$2y$10$vVwtrlPjWtSM/qpDyqg93u8qBTTNoURs4FYwITAM2MggymZgZX0K2', 3, '2019-10-30 05:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `lvl_ID` tinyint(4) UNSIGNED NOT NULL,
  `lvl_Name` varchar(85) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`lvl_ID`, `lvl_Name`) VALUES
(1, 'Student'),
(2, 'Instructor'),
(3, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_staff`
--
ALTER TABLE `academic_staff`
  ADD PRIMARY KEY (`acs_ID`),
  ADD KEY `sem_ID` (`sem_ID`),
  ADD KEY `rid_ID` (`rid_ID`),
  ADD KEY `pos_ID` (`pos_ID`),
  ADD KEY `subject_ID` (`subject_ID`);

--
-- Indexes for table `admission_attachment`
--
ALTER TABLE `admission_attachment`
  ADD PRIMARY KEY (`attachment_ID`);

--
-- Indexes for table `admission_student_details`
--
ALTER TABLE `admission_student_details`
  ADD PRIMARY KEY (`admission_ID`),
  ADD KEY `suffix_ID` (`suffix_ID`),
  ADD KEY `sex_ID` (`sex_ID`),
  ADD KEY `yl_ID` (`yl_ID`);

--
-- Indexes for table `gradelevel_subject`
--
ALTER TABLE `gradelevel_subject`
  ADD PRIMARY KEY (`grls_ID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_ID`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notif_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `record_admin_details`
--
ALTER TABLE `record_admin_details`
  ADD PRIMARY KEY (`rad_ID`),
  ADD UNIQUE KEY `rtd_EmpID` (`rad_EmpID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `suffix_ID` (`suffix_ID`),
  ADD KEY `sex_ID` (`sex_ID`),
  ADD KEY `marital_ID` (`marital_ID`);

--
-- Indexes for table `record_instructor_details`
--
ALTER TABLE `record_instructor_details`
  ADD PRIMARY KEY (`rid_ID`),
  ADD UNIQUE KEY `rtd_EmpID` (`rid_EmpID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `suffix_ID` (`suffix_ID`),
  ADD KEY `sex_ID` (`sex_ID`),
  ADD KEY `marital_ID` (`marital_ID`);

--
-- Indexes for table `record_student_details`
--
ALTER TABLE `record_student_details`
  ADD PRIMARY KEY (`rsd_ID`),
  ADD UNIQUE KEY `rsd_StudNum` (`rsd_StudNum`),
  ADD KEY `suffix_ID` (`suffix_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `sex_ID` (`sex_ID`),
  ADD KEY `marital_ID` (`marital_ID`);

--
-- Indexes for table `record_student_enrolled`
--
ALTER TABLE `record_student_enrolled`
  ADD PRIMARY KEY (`rse_ID`),
  ADD KEY `rsd_ID` (`rsd_ID`),
  ADD KEY `sem_ID` (`sem_ID`),
  ADD KEY `yl_ID` (`yl_ID`);

--
-- Indexes for table `ref_ethnic_group`
--
ALTER TABLE `ref_ethnic_group`
  ADD PRIMARY KEY (`ethnic_ID`),
  ADD UNIQUE KEY `ethnic_Name` (`ethnic_Name`);

--
-- Indexes for table `ref_marital`
--
ALTER TABLE `ref_marital`
  ADD PRIMARY KEY (`marital_ID`);

--
-- Indexes for table `ref_position`
--
ALTER TABLE `ref_position`
  ADD PRIMARY KEY (`pos_ID`),
  ADD UNIQUE KEY `pos_Name` (`pos_Name`);

--
-- Indexes for table `ref_religion`
--
ALTER TABLE `ref_religion`
  ADD PRIMARY KEY (`religion_ID`);

--
-- Indexes for table `ref_section`
--
ALTER TABLE `ref_section`
  ADD PRIMARY KEY (`section_ID`);

--
-- Indexes for table `ref_semester`
--
ALTER TABLE `ref_semester`
  ADD PRIMARY KEY (`sem_ID`);

--
-- Indexes for table `ref_sex`
--
ALTER TABLE `ref_sex`
  ADD PRIMARY KEY (`sex_ID`);

--
-- Indexes for table `ref_status`
--
ALTER TABLE `ref_status`
  ADD PRIMARY KEY (`status_ID`);

--
-- Indexes for table `ref_subject`
--
ALTER TABLE `ref_subject`
  ADD PRIMARY KEY (`subject_ID`),
  ADD UNIQUE KEY `subject_Code` (`subject_Code`);

--
-- Indexes for table `ref_suffixname`
--
ALTER TABLE `ref_suffixname`
  ADD PRIMARY KEY (`suffix_ID`);

--
-- Indexes for table `ref_year_level`
--
ALTER TABLE `ref_year_level`
  ADD PRIMARY KEY (`yl_ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_ID`),
  ADD KEY `section_ID_ribfk` (`section_ID`),
  ADD KEY `sem_ID_ribfk` (`sem_ID`),
  ADD KEY `status_ID` (`status_ID`),
  ADD KEY `rid_ID` (`rid_ID`);

--
-- Indexes for table `room_enrolled_student`
--
ALTER TABLE `room_enrolled_student`
  ADD PRIMARY KEY (`res_ID`),
  ADD KEY `rse_ID` (`rse_ID`),
  ADD KEY `room_ID` (`room_ID`);

--
-- Indexes for table `room_student_attendance`
--
ALTER TABLE `room_student_attendance`
  ADD PRIMARY KEY (`attendance_ID`),
  ADD KEY `res_ID` (`res_ID`);

--
-- Indexes for table `room_student_grade`
--
ALTER TABLE `room_student_grade`
  ADD PRIMARY KEY (`rsg_ID`),
  ADD KEY `res_ID` (`res_ID`);

--
-- Indexes for table `room_student_learner_observe`
--
ALTER TABLE `room_student_learner_observe`
  ADD PRIMARY KEY (`rslr_ID`);

--
-- Indexes for table `room_subject`
--
ALTER TABLE `room_subject`
  ADD PRIMARY KEY (`rsub_ID`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `user_login_key` (`user_Name`),
  ADD KEY `lvl_ID` (`lvl_ID`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`lvl_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_staff`
--
ALTER TABLE `academic_staff`
  MODIFY `acs_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `admission_attachment`
--
ALTER TABLE `admission_attachment`
  MODIFY `attachment_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admission_student_details`
--
ALTER TABLE `admission_student_details`
  MODIFY `admission_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `gradelevel_subject`
--
ALTER TABLE `gradelevel_subject`
  MODIFY `grls_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `record_admin_details`
--
ALTER TABLE `record_admin_details`
  MODIFY `rad_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `record_instructor_details`
--
ALTER TABLE `record_instructor_details`
  MODIFY `rid_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;
--
-- AUTO_INCREMENT for table `record_student_details`
--
ALTER TABLE `record_student_details`
  MODIFY `rsd_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `record_student_enrolled`
--
ALTER TABLE `record_student_enrolled`
  MODIFY `rse_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'record student enrolled ID', AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `ref_ethnic_group`
--
ALTER TABLE `ref_ethnic_group`
  MODIFY `ethnic_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `ref_marital`
--
ALTER TABLE `ref_marital`
  MODIFY `marital_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ref_position`
--
ALTER TABLE `ref_position`
  MODIFY `pos_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `ref_section`
--
ALTER TABLE `ref_section`
  MODIFY `section_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ref_semester`
--
ALTER TABLE `ref_semester`
  MODIFY `sem_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ref_status`
--
ALTER TABLE `ref_status`
  MODIFY `status_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ref_subject`
--
ALTER TABLE `ref_subject`
  MODIFY `subject_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ref_suffixname`
--
ALTER TABLE `ref_suffixname`
  MODIFY `suffix_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `ref_year_level`
--
ALTER TABLE `ref_year_level`
  MODIFY `yl_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `room_enrolled_student`
--
ALTER TABLE `room_enrolled_student`
  MODIFY `res_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'room enrolled student ID', AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `room_student_attendance`
--
ALTER TABLE `room_student_attendance`
  MODIFY `attendance_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `room_student_grade`
--
ALTER TABLE `room_student_grade`
  MODIFY `rsg_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `room_student_learner_observe`
--
ALTER TABLE `room_student_learner_observe`
  MODIFY `rslr_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `room_subject`
--
ALTER TABLE `room_subject`
  MODIFY `rsub_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `lvl_ID` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_staff`
--
ALTER TABLE `academic_staff`
  ADD CONSTRAINT `academic_staff_ibfk_1` FOREIGN KEY (`sem_ID`) REFERENCES `ref_semester` (`sem_ID`),
  ADD CONSTRAINT `academic_staff_ibfk_2` FOREIGN KEY (`sem_ID`) REFERENCES `ref_semester` (`sem_ID`),
  ADD CONSTRAINT `academic_staff_ibfk_3` FOREIGN KEY (`rid_ID`) REFERENCES `record_instructor_details` (`rid_ID`),
  ADD CONSTRAINT `academic_staff_ibfk_4` FOREIGN KEY (`pos_ID`) REFERENCES `ref_position` (`pos_ID`),
  ADD CONSTRAINT `academic_staff_ibfk_5` FOREIGN KEY (`subject_ID`) REFERENCES `ref_subject` (`subject_ID`);

--
-- Constraints for table `admission_student_details`
--
ALTER TABLE `admission_student_details`
  ADD CONSTRAINT `admission_student_details_ibfk_1` FOREIGN KEY (`yl_ID`) REFERENCES `ref_year_level` (`yl_ID`);

--
-- Constraints for table `record_admin_details`
--
ALTER TABLE `record_admin_details`
  ADD CONSTRAINT `record_admin_details_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user_account` (`user_ID`),
  ADD CONSTRAINT `record_admin_details_ibfk_2` FOREIGN KEY (`suffix_ID`) REFERENCES `ref_suffixname` (`suffix_ID`),
  ADD CONSTRAINT `record_admin_details_ibfk_3` FOREIGN KEY (`sex_ID`) REFERENCES `ref_sex` (`sex_ID`),
  ADD CONSTRAINT `record_admin_details_ibfk_4` FOREIGN KEY (`marital_ID`) REFERENCES `ref_marital` (`marital_ID`);

--
-- Constraints for table `record_instructor_details`
--
ALTER TABLE `record_instructor_details`
  ADD CONSTRAINT `record_instructor_details_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user_account` (`user_ID`),
  ADD CONSTRAINT `record_instructor_details_ibfk_2` FOREIGN KEY (`suffix_ID`) REFERENCES `ref_suffixname` (`suffix_ID`),
  ADD CONSTRAINT `record_instructor_details_ibfk_3` FOREIGN KEY (`sex_ID`) REFERENCES `ref_sex` (`sex_ID`),
  ADD CONSTRAINT `record_instructor_details_ibfk_4` FOREIGN KEY (`marital_ID`) REFERENCES `ref_marital` (`marital_ID`);

--
-- Constraints for table `record_student_details`
--
ALTER TABLE `record_student_details`
  ADD CONSTRAINT `record_student_details_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user_account` (`user_ID`),
  ADD CONSTRAINT `record_student_details_ibfk_2` FOREIGN KEY (`suffix_ID`) REFERENCES `ref_suffixname` (`suffix_ID`),
  ADD CONSTRAINT `record_student_details_ibfk_3` FOREIGN KEY (`user_ID`) REFERENCES `user_account` (`user_ID`),
  ADD CONSTRAINT `record_student_details_ibfk_4` FOREIGN KEY (`sex_ID`) REFERENCES `ref_sex` (`sex_ID`),
  ADD CONSTRAINT `record_student_details_ibfk_5` FOREIGN KEY (`marital_ID`) REFERENCES `ref_marital` (`marital_ID`);

--
-- Constraints for table `record_student_enrolled`
--
ALTER TABLE `record_student_enrolled`
  ADD CONSTRAINT `record_student_enrolled_ibfk_1` FOREIGN KEY (`rsd_ID`) REFERENCES `record_student_details` (`rsd_ID`),
  ADD CONSTRAINT `record_student_enrolled_ibfk_2` FOREIGN KEY (`sem_ID`) REFERENCES `ref_semester` (`sem_ID`),
  ADD CONSTRAINT `record_student_enrolled_ibfk_3` FOREIGN KEY (`yl_ID`) REFERENCES `ref_year_level` (`yl_ID`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`status_ID`) REFERENCES `ref_status` (`status_ID`),
  ADD CONSTRAINT `room_ibfk_2` FOREIGN KEY (`rid_ID`) REFERENCES `record_instructor_details` (`rid_ID`),
  ADD CONSTRAINT `section_ID_ribfk` FOREIGN KEY (`section_ID`) REFERENCES `ref_section` (`section_ID`),
  ADD CONSTRAINT `sem_ID_ribfk` FOREIGN KEY (`sem_ID`) REFERENCES `ref_semester` (`sem_ID`);

--
-- Constraints for table `room_enrolled_student`
--
ALTER TABLE `room_enrolled_student`
  ADD CONSTRAINT `room_enrolled_student_ibfk_1` FOREIGN KEY (`rse_ID`) REFERENCES `record_student_enrolled` (`rse_ID`),
  ADD CONSTRAINT `room_enrolled_student_ibfk_2` FOREIGN KEY (`room_ID`) REFERENCES `room` (`room_ID`);

--
-- Constraints for table `room_student_attendance`
--
ALTER TABLE `room_student_attendance`
  ADD CONSTRAINT `room_student_attendance_ibfk_1` FOREIGN KEY (`res_ID`) REFERENCES `room_enrolled_student` (`res_ID`);

--
-- Constraints for table `room_student_grade`
--
ALTER TABLE `room_student_grade`
  ADD CONSTRAINT `room_student_grade_ibfk_1` FOREIGN KEY (`res_ID`) REFERENCES `room_enrolled_student` (`res_ID`);

--
-- Constraints for table `user_account`
--
ALTER TABLE `user_account`
  ADD CONSTRAINT `user_account_ibfk_1` FOREIGN KEY (`lvl_ID`) REFERENCES `user_level` (`lvl_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
