-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2023 at 09:55 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fptec`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_programmes`
--

CREATE TABLE `acc_programmes` (
  `id` int(11) NOT NULL,
  `certid` varchar(100) NOT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `accreditation_year` varchar(255) DEFAULT NULL,
  `faculty_school` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `programme` varchar(255) DEFAULT NULL,
  `isced` varchar(20) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `fcont` varchar(255) DEFAULT NULL,
  `fmail` varchar(255) DEFAULT NULL,
  `hname` varchar(255) NOT NULL,
  `hcont` varchar(255) NOT NULL,
  `hmail` varchar(255) NOT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `accredited_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL,
  `approved_by` varchar(200) NOT NULL,
  `approved_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acc_programmes`
--

INSERT INTO `acc_programmes` (`id`, `certid`, `institution`, `accreditation_year`, `faculty_school`, `department`, `college`, `programme`, `isced`, `fname`, `fcont`, `fmail`, `hname`, `hcont`, `hmail`, `notes`, `accredited_date`, `expiration_date`, `createdAt`, `updatedAt`, `approved_by`, `approved_date`) VALUES
(87, '5566', 'KST/001/213/89', '2014', '4', '6', '3', '14', '0005', 'Maxwell Ntsie', '045432234', 'a@b.d', 'William Otoo Ellis', '024342456', 'info@b.c', 'I am ok with it', '2023-08-19', '2035-08-19', '2023-08-19 21:48:06', NULL, 'felsina89@gmail.com', '2023-08-19 23:48:06'),
(88, '5333', 'KST/001/213/89', '2022', '4', '6', '3', '15', '0004', 'Joana Atkinson', '08899876567', 'p@p.p', 'Elvis Danquah', '0987667788', 'o@m.b', NULL, '2025-08-20', '2035-08-20', '2023-08-19 22:06:36', NULL, '', NULL),
(89, '5454', 'UG0010', '2020', '2', '7', '3', '15', '0004', 'ghsgjgsj', '98889987', 'nvnbxcmvbx', 'trytryt', '02343774747', 'ieriwyeiuw', NULL, '2023-08-20', '2023-08-20', '2023-08-19 22:16:36', NULL, '', NULL),
(91, '7234', 'UPS/001/0004', '2022', '2', '7', '3', '15', '0002', 'ueywryweuiryw', '8992387238', 'bnmcxbvmx', 'fhdfgdfgdh', '989809809', 'hjhjk', NULL, '2023-09-15', '2023-09-15', '2023-09-15 21:46:35', NULL, '', NULL),
(92, '1321', 'UG0010', '2015', '2', '7', '1', '17', '0009', 'Obideeba J.K', '0234338381', 'c@c.c', 'Ransford Agyei Boateng', '0234555333', 'a@a.a', 'Program is approved for ', '2023-09-16', '2023-09-16', '2023-09-15 22:16:12', NULL, 'felsina89@gmail.com', '2023-09-16 00:16:12'),
(93, '7543', 'UG0010', '2022', '2', '7', '1', '18', '0009', 'Roseline Mills', '24324893274', 'f@s.b', 'Wisdom Korley', '2348347803274892', 'ino@b.m', 'Hummmm', '2020-10-07', '2023-10-07', '2023-10-07 17:49:49', NULL, 'felsina89@gmail.com', '2023-10-07 19:49:49'),
(94, '53256665', 'KST/001/213/89', '2023', '2', '6', '2', '19', '0004', 'Musah Baaba', '893738297432', 'y@g.b', 'Osei Prince', '983277326732', 'a@g.c', NULL, '2022-09-10', '2024-09-10', '2023-10-13 19:09:36', NULL, '', NULL),
(95, '76549713', 'UPS/001/0004', '2023', '3', '8', '3', '20', '0002', 'Yru Gagarin', '0989798798', 'u@d.c', 'Hans Sarpei', '0997867', 'd@v.c', NULL, '2022-01-23', '2034-09-12', '2023-10-13 19:09:36', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acc_programmes_proposed`
--

CREATE TABLE `acc_programmes_proposed` (
  `id` int(11) NOT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `accreditation_year` varchar(255) DEFAULT NULL,
  `faculty_school` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `programme` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `fcont` varchar(255) DEFAULT NULL,
  `fmail` varchar(255) DEFAULT NULL,
  `hname` varchar(255) NOT NULL,
  `hcont` varchar(255) NOT NULL,
  `hmail` varchar(255) NOT NULL,
  `isced` varchar(5) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL,
  `modify_by` varchar(200) NOT NULL,
  `notes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acc_programmes_proposed`
--

INSERT INTO `acc_programmes_proposed` (`id`, `institution`, `accreditation_year`, `faculty_school`, `department`, `college`, `programme`, `fname`, `fcont`, `fmail`, `hname`, `hcont`, `hmail`, `isced`, `status`, `createdAt`, `updatedAt`, `modify_by`, `notes`) VALUES
(13, 'UG0010', '2023', '4', '6', '1', 'Mechanical Engineering', 'ruth effah', '96324828', 'qwwe', 'Owusuaa', '89897897', 'wqwq', '0007', 'Pending', '2023-10-13 19:22:58', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `appadmissions`
--

CREATE TABLE `appadmissions` (
  `id` int(11) NOT NULL,
  `institution` varchar(50) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `month` varchar(10) DEFAULT NULL,
  `applicant_id` varchar(20) DEFAULT NULL,
  `applicant_national_id` varchar(20) DEFAULT NULL,
  `applicant_id_type` varchar(20) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `other_names` varchar(50) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_country` varchar(50) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `home_town` varchar(50) DEFAULT NULL,
  `home_region` varchar(50) DEFAULT NULL,
  `high_school` varchar(50) DEFAULT NULL COMMENT 'High school attended',
  `high_school_program` varchar(50) DEFAULT NULL COMMENT 'High school location',
  `programme_applied` varchar(255) DEFAULT NULL,
  `programme_type` varchar(50) DEFAULT NULL COMMENT 'Category based on session eg regular, evening, weekend, distance',
  `admission_level` varchar(2) NOT NULL,
  `application_qualification` varchar(100) DEFAULT NULL,
  `admission_offer` varchar(15) DEFAULT NULL,
  `programme_offered` varchar(255) DEFAULT NULL,
  `application_type` varchar(50) NOT NULL,
  `admission_acceptance` varchar(15) DEFAULT NULL,
  `fee_type` varchar(15) DEFAULT NULL,
  `application_fee` varchar(15) DEFAULT NULL COMMENT 'Cost of application or application fee',
  `disability` varchar(5) DEFAULT NULL,
  `disability_type` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conferenceworkshop`
--

CREATE TABLE `conferenceworkshop` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(20) NOT NULL,
  `institution` varchar(50) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `conference` varchar(300) DEFAULT NULL,
  `organizer` varchar(255) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conferenceworkshop`
--

INSERT INTO `conferenceworkshop` (`id`, `staff_id`, `institution`, `year`, `conference`, `organizer`, `venue`, `city`, `country`, `start_date`, `end_date`, `createdAt`, `updatedAt`) VALUES
(3, '00001', 'KST/001/213/89', '2023', 'All Teachers Annual General Meeting', 'Ghana Education Service', 'Accra Conference Center', 'Accra', 'Ghana', '2023-06-25', '2023-06-29', '2023-06-25 19:17:43', NULL),
(4, '0005', 'UG0010', '2023', 'CHASS Meeting', 'CHASS', 'Movenpick Ambassador\'s Hotel', 'Kumasi', 'Ghana', '2023-06-25', '2023-08-25', '2023-06-25 19:29:07', NULL),
(6, 'KST/ST/2083', 'KST/001/213/89', '2023', 'Heavenly Ways Conference', 'Church Of Pentecost', 'Pentecost Convention Center', 'Kasoa', 'Ghana', '2023-09-08', '2023-09-08', '2023-09-08 17:02:42', NULL),
(7, 'UG/ST/2012', 'UG0010', '2023', 'Test Conference', 'Accra Academy PTA', 'Accra Academy', 'Accra', 'Ghana', '2023-09-08', '2023-09-08', '2023-09-08 17:05:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(4) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `date_first_accreditation` date DEFAULT NULL,
  `date_accreditation_expires` date DEFAULT NULL,
  `name_of_head` varchar(255) DEFAULT NULL,
  `phone_of_head` varchar(255) DEFAULT NULL,
  `email_of_head` varchar(255) DEFAULT NULL,
  `filled_by_name` varchar(255) DEFAULT NULL,
  `filled_by_phone` varchar(255) DEFAULT NULL,
  `filled_by_email` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `academic_year`, `institution`, `date_first_accreditation`, `date_accreditation_expires`, `name_of_head`, `phone_of_head`, `email_of_head`, `filled_by_name`, `filled_by_phone`, `filled_by_email`, `createdAt`, `updatedAt`) VALUES
(1, '2015', 'ATU', '1990-02-08', '1990-02-08', 'Johnson Doe', '02548754875', 'jdoe@email.com', 'Johnson Doe', '02548754875', 'jdoe@email.com', '2023-05-04 10:26:49', '2023-05-04 10:26:49'),
(3, '2023', 'KST001', '2023-07-28', '2023-11-28', 'W.O.Ellis', '0302434534', 'ellis@knust.com', 'okrah albert', 'okrah@knust.com', '0324545566', '2023-06-28 20:10:06', NULL),
(4, '2019', 'UP00010', '2023-07-30', '2023-09-30', 'joe ghartey', '078767567564', 'gt@m.com', 'henry lartey', 'henry@gh.com', '026576543', '2023-06-30 13:00:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `institution` varchar(50) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `month` varchar(10) DEFAULT NULL,
  `applicant_id` varchar(20) DEFAULT NULL,
  `applicant_national_id` varchar(20) DEFAULT NULL,
  `applicant_id_type` varchar(20) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `other_names` varchar(50) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_country` varchar(50) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `home_town` varchar(50) DEFAULT NULL,
  `home_region` varchar(50) DEFAULT NULL,
  `high_school` varchar(50) DEFAULT NULL COMMENT 'High school attended',
  `high_school_program` varchar(50) DEFAULT NULL COMMENT 'High school location',
  `programme_applied` varchar(255) DEFAULT NULL,
  `programme_type` varchar(50) DEFAULT NULL COMMENT 'Category based on session eg regular, evening, weekend, distance',
  `admission_level` varchar(2) NOT NULL,
  `application_qualification` varchar(100) DEFAULT NULL,
  `admission_offer` varchar(15) DEFAULT NULL,
  `programme_offered` varchar(255) DEFAULT NULL,
  `application_type` varchar(50) NOT NULL,
  `admission_acceptance` varchar(15) DEFAULT NULL,
  `fee_type` varchar(15) DEFAULT NULL,
  `application_fee` varchar(15) DEFAULT NULL COMMENT 'Cost of application or application fee',
  `disability` varchar(5) DEFAULT NULL,
  `disability_type` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `institution`, `year`, `month`, `applicant_id`, `applicant_national_id`, `applicant_id_type`, `first_name`, `surname`, `other_names`, `gender`, `birth_date`, `birth_country`, `nationality`, `religion`, `home_town`, `home_region`, `high_school`, `high_school_program`, `programme_applied`, `programme_type`, `admission_level`, `application_qualification`, `admission_offer`, `programme_offered`, `application_type`, `admission_acceptance`, `fee_type`, `application_fee`, `disability`, `disability_type`, `createdAt`, `updatedAt`, `status`) VALUES
(5, 'KST/001/213/89', '2021', NULL, '98767098', '3453462627', 'Passport', 'Henry', 'Kuivi', 'Foli', 'Male', '1972-08-24', 'United States of America (the)', 'American', 'Others', 'Claifornia', '', 'ALAVANYO SENIOR HIGH/TECH SCHOOL', 'TECHNICAL / VOCATIONAL', NULL, 'evening', '1', NULL, NULL, '14', 'postgraduate', NULL, 'Full Fee-Paying', NULL, 'No', 'n/a', '2023-08-23 23:37:40', NULL, 'Active'),
(6, 'KST/001/213/89', '2022', NULL, '98586565', '67856656576', 'National ID', 'Eastwooddd', 'Anabaaa', 'Suweri', 'Male', '1991-08-26', 'Ghana', 'Ghanaian', 'Christianity', 'Bolgaaaaa', 'Upper East', 'BOLGATANGA SENIOR HIGH SCHOOL', 'HOME SCIENCE', NULL, 'distance', '2', NULL, NULL, '16', 'Postgraduate', NULL, 'Government Subs', NULL, 'Yes', 'noseeeee', '2023-08-26 10:23:02', NULL, 'Active'),
(7, 'UG0010', '2023', NULL, '98586564', '67543434566', 'National ID', 'Julliet', 'Ofori', 'Coffie', 'Male', '1991-08-26', 'Nigeria', 'Nigerian', 'Islam', 'Keta', 'Volta', 'EBENEZER SENIOR HIGH SCHOOL', 'TECHNICAL / VOCATIONAL', NULL, 'regular', '1', NULL, NULL, '15', 'Undergraduate', NULL, 'Scholarship', NULL, 'No', '', '2023-08-26 10:27:22', NULL, 'Active'),
(12, 'UG0010', '2022', NULL, '8786569', '365237656322', 'Ghana Card', 'Monica', 'Agyiri', 'Mensah', 'Male', '2023-08-24', 'Ghana', 'Ghanaian', 'Islam', 'Lome', '', '', '', NULL, 'distance', '2', NULL, NULL, '15', 'Undergraduate', NULL, 'Full Fee-Paying', NULL, 'No', '', '2023-09-14 21:58:25', NULL, 'Active'),
(13, 'UG0010', '2020', NULL, 'UG/2020/0098', 'GHA-03245-98361', 'Ghana Card', 'Daniel', 'Yankson', '', 'Male', '1978-03-02', 'Togo', 'Togolese', 'Moslem', 'Lome', 'N/A', 'Mfantispim School', 'General Arts', NULL, 'regular', '1', NULL, NULL, '15', 'Undergraduate', NULL, 'Government Subs', NULL, 'Yes', 'Eye', '2023-09-14 21:59:18', NULL, 'Active'),
(14, 'UPS/001/0004', '2022', NULL, 'UPS/2022/0074', 'GHA-038473-9833', 'Passport', 'Hannah', 'Johnson', 'Ashiokai', 'Female', '1965-04-01', 'Ghana', 'Ghanaian', 'Christian', 'Nkroful', 'Western', 'Accra Girls', 'General Science', NULL, 'distance', '1', NULL, NULL, '16', 'Undergraduate', NULL, 'Full Fee-Paying', NULL, 'No', '', '2023-09-14 23:08:15', NULL, 'Active'),
(16, 'KST/001/213/89', '2022', NULL, '9023435627', '8765545667898', 'Passport', 'Ruth', 'Owusu', 'Ansah', 'Male', '1995-11-19', 'Ghana', 'Ghanaian', 'Islam', 'Hwediemu', 'Eastern', 'Others', 'Others', NULL, 'distance', '1', NULL, NULL, '14', 'Postgraduate', NULL, 'Full Fee-Paying', NULL, 'No', 'N/A', '2023-09-15 20:54:23', NULL, 'Active'),
(18, 'UPS/001/0004', '2022', NULL, '453647454', '3243527676324', 'Ghana Card', 'Otuo', 'Marshal', 'Quarcoo', 'Male', '2023-10-16', 'Ghana', 'Ghanaian', 'Others', 'Abura Asaaman Kese', 'Western', 'ABRAFI SENIOR HIGH SCHOOL', 'GENERAL ARTS', NULL, 'evening', '2', NULL, NULL, '20', 'Postgraduate', NULL, 'Scholarship', NULL, 'Yes', 'Nose', '2023-10-14 09:25:24', NULL, 'Offered'),
(19, 'UPS/001/0004', '2022', NULL, 'UPS/2022/01124', 'GHA-038473-9833', 'Social Security', 'Hannah', 'Johnson', 'Ashiokai', 'Female', '1965-04-01', 'Ghana', 'Ghanaian', 'Christian', 'Nkroful', 'N/A', 'Accra Girls', 'General Science', NULL, 'distance', '1', NULL, NULL, '16', 'Undergraduate', NULL, 'Full Fee-Paying', NULL, 'No', '', '2023-11-24 14:01:50', NULL, 'Active'),
(20, 'UG0010', '2020', NULL, 'UG/2020/053645', 'GHA-03245-98361', 'Ghana Card', 'Moses', 'Yankson', '', 'Male', '1978-03-02', 'Togo', 'Togolese', 'Moslem', 'Lome', 'N/A', 'Mfantispim School', 'General Arts', NULL, 'regular', '1', NULL, NULL, '15', 'Undergraduate', NULL, 'Government Subs', NULL, 'Yes', 'Eye', '2023-11-24 14:01:50', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `graduates`
--

CREATE TABLE `graduates` (
  `id` int(11) NOT NULL,
  `institution` varchar(50) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `month` varchar(10) DEFAULT NULL,
  `applicant_id` varchar(20) DEFAULT NULL,
  `applicant_national_id` varchar(20) DEFAULT NULL,
  `applicant_id_type` varchar(20) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `other_names` varchar(50) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_country` varchar(50) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `home_town` varchar(50) DEFAULT NULL,
  `home_region` varchar(50) DEFAULT NULL,
  `high_school` varchar(50) DEFAULT NULL COMMENT 'High school attended',
  `high_school_program` varchar(50) DEFAULT NULL COMMENT 'High school location',
  `programme_applied` varchar(255) DEFAULT NULL,
  `programme_type` varchar(50) DEFAULT NULL COMMENT 'Category based on session eg regular, evening, weekend, distance',
  `admission_level` varchar(2) NOT NULL,
  `application_qualification` varchar(100) DEFAULT NULL,
  `admission_offer` varchar(15) DEFAULT NULL,
  `programme_offered` varchar(255) DEFAULT NULL,
  `application_type` varchar(50) NOT NULL,
  `admission_acceptance` varchar(15) DEFAULT NULL,
  `fee_type` varchar(15) DEFAULT NULL,
  `application_fee` varchar(15) DEFAULT NULL COMMENT 'Cost of application or application fee',
  `disability` varchar(5) DEFAULT NULL,
  `disability_type` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `graduates`
--

INSERT INTO `graduates` (`id`, `institution`, `year`, `month`, `applicant_id`, `applicant_national_id`, `applicant_id_type`, `first_name`, `surname`, `other_names`, `gender`, `birth_date`, `birth_country`, `nationality`, `religion`, `home_town`, `home_region`, `high_school`, `high_school_program`, `programme_applied`, `programme_type`, `admission_level`, `application_qualification`, `admission_offer`, `programme_offered`, `application_type`, `admission_acceptance`, `fee_type`, `application_fee`, `disability`, `disability_type`, `createdAt`, `updatedAt`, `status`) VALUES
(1, 'UG0010', '2022', NULL, '3454323', 'gftrrty667567567', 'National ID', 'Grace ', 'Otibu', 'Darko', 'Female', '2006-08-20', 'United States of America (the)', 'American', 'Islam', 'Colorado', 'Ahafo', 'ABUADI/TSREFE SENIOR HIGH SCHOOL', 'VISUAL ARTS', NULL, 'regular', '1', NULL, NULL, '15', 'undergraduate', NULL, 'Government Subs', NULL, 'Yes', 'leg', '2023-09-14 22:27:38', NULL, 'Active'),
(2, 'UG0010', '2020', NULL, 'UG/2020/053', 'GHA-03245-98361', 'Ghana Card', 'Moses', 'Yankson', '', 'Male', '1978-03-02', 'Togo', 'Togolese', 'Moslem', 'Lome', 'N/A', 'Mfantispim School', 'General Arts', NULL, 'regular', '1', NULL, NULL, '15', 'Undergraduate', NULL, 'Government Subs', NULL, 'Yes', 'Eye', '2023-10-13 21:26:33', NULL, 'Active'),
(3, 'UG0010', '2022', NULL, 'UPS/2022/0001', 'GHA-038473-9833', 'Passport', 'Mildredddddd', 'Abbeyyyyyyy', 'Ashiokai', 'Female', '1965-04-01', 'Ghana', 'Ghanaian', 'Christian', 'Nkroful', 'Western', 'Accra Girls', 'General Science', NULL, 'distance', '1', NULL, NULL, '15', 'Undergraduate', NULL, 'Full Fee-Paying', NULL, 'No', '', '2023-10-13 21:26:33', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

CREATE TABLE `institutes` (
  `id` int(11) NOT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `institution_code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `digital_address` varchar(255) DEFAULT NULL,
  `contact_telephone` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `hname` varchar(200) NOT NULL,
  `hcont` varchar(50) NOT NULL,
  `hmail` varchar(200) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `fcont` varchar(50) NOT NULL,
  `fmail` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `accredit` date DEFAULT NULL,
  `expire` date DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institutes`
--

INSERT INTO `institutes` (`id`, `short_name`, `institution_code`, `name`, `category_id`, `status`, `region`, `district`, `town`, `latitude`, `longitude`, `digital_address`, `contact_telephone`, `contact_email`, `url`, `hname`, `hcont`, `hmail`, `fname`, `fcont`, `fmail`, `description`, `accredit`, `expire`, `createdAt`, `updatedAt`) VALUES
(10, 'KNUST', 'KST/001/213/89', 'Kwame Nkrumah University Of Science And Technology', 1, 'Active', 'Greater Accra', 'Ablekuma West', 'WEST ABBOSSEY OKAI', 5.53111, -0.259456, 'GA5122319', '03023344554', 'info@knust.edu.gh', 'knust.edu.gh', 'William Otoo Ellis', '0243432121', 'otooellis@knust.edu.gh', 'Bernard Ankomah', '094848588585', 'bernard.ankomah@knust.edu.gh', 'No description', '2020-09-03', NULL, '2023-08-05 22:38:45', NULL),
(11, 'UG', 'UG0010', 'University Of Ghana, Legon', 1, 'Active', 'Greater Accra', 'Accra', 'AVENOR', 5.5761, -0.228015, 'ga2132319', '065646545', 'info@ug.edu.gh', 'ug.edu.gh', 'Mrs. Beatrice Siaw', '5454564654', 'head@ug.edu.gh', 'Ansah Sasraku', '98789457984', 'filling@ug.edu.gh', '', '2020-02-03', NULL, '2023-08-10 08:52:16', NULL),
(16, 'UPSA', 'UPS/001/0004', 'University For Professional Studies', 2, 'Active', 'Greater Accra', 'La Nkwantanang-Madina', 'MADINA', 5.66181, -0.165312, 'GM-037-1925', 'GM-037-1925', '086876', 'iuyuiy', 'Gerald', '087687687', 'iuhkjhkj', 'Happy', '086876876', 'jghjghjgh', 'Notes', '2022-08-25', '2035-01-02', '2023-08-26 16:22:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `institute_categories`
--

CREATE TABLE `institute_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institute_categories`
--

INSERT INTO `institute_categories` (`id`, `name`, `description`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'Public Universities', 'These are educational institutions designed for advanced instruction and research in several branches of learning, conferring degrees in various faculties, and often embodying colleges, schools, institutions, etc. Its status is attained by an Act of Parliament. These are the traditional universities and the technical universities.', 'Active', '2022-11-28 15:26:14', '2022-11-28 15:26:14'),
(2, 'Private Universities', 'These are educational institutions designed for advanced instruction and research in several branches of learning, conferring degrees in various faculties, and often embodying c colleges, schools, institutions, etc. Its status is attained by a presidential charter granted by the President of the Republic of Ghana.', 'Active', '2022-11-28 15:25:21', '2022-11-28 15:25:21'),
(3, 'Private University College', 'An institution of higher learning that is affiliated to a chartered university and that offers instructions supervised by the University to which it is affiliated and whose degrees/diplomas/certificates are awarded by the chartered university. For the avoidance of doubt, the chartered university must be certified by GTEC as having the expertise to supervise the programmes of the mentored university college. Any institution wishing to be known and called a ‘University College’ is expected to have three (3) faculties, each with three (3) departments. The exception is for science and technology based institutions for which two (2) faculties, each with two (2) departments, shall apply.', 'Active', '2022-11-28 15:27:38', '2022-11-28 15:27:38'),
(4, 'Private Tutorial College', 'An institution whose sole aim is to prepare students to take the examinations of a recognized professional body.', 'Active', '2022-11-28 15:29:17', '2022-11-28 15:29:17'),
(5, 'Private Distance Learning Centre', 'These are centres where providers deliver courses/programmes to students in different countries through distance and on-line modes. It may include some face-to-face support for students through domestic study or support centres.', 'Active', '2022-11-28 15:31:36', '2022-11-28 15:31:36'),
(6, 'Public Colleges of Education', 'These are public educational institutions for further or higher education in the field of humanites specifically Education.', 'Active', '2022-11-28 15:34:59', '2022-11-28 15:34:59'),
(7, 'Private Colleges of Education', 'These are private educational institutions for further or higher education in the field of humanites specifically Education.', 'Active', '2022-11-28 15:35:25', '2022-11-28 15:35:25'),
(8, 'Public Specialised Teaching/Professional Institutions ', 'The public specialised/professional teaching institutions are institutions established to run professional programmes and train students in specific professional areas such as surveying, filmmaking, journalism, and languages, amongst others.', 'Active', '2022-11-28 15:37:50', '2022-11-28 15:37:50'),
(9, 'Public Colleges of Agriculture', 'These are public educational institutions that prepare students for careers in agriculture. ', 'Active', '2022-11-28 15:41:53', '2022-11-28 15:41:53'),
(10, 'Private Colleges of Agriculture', 'These are private educational institutions that prepare students for careers in agriculture. ', 'Active', '2022-11-28 15:42:16', '2022-11-28 15:42:16'),
(11, 'Private Nursing and Midwifery Training Colleges', 'These are private education institutions that train students in the fields of nursing and midwifery. ', 'Active', '2022-11-28 15:44:02', '2022-11-28 15:44:02'),
(12, 'Public Nursing, Midiwfery, and Allied Health Training Colleges', 'These are public education institutions that train students in the fields of nursing, midwifery and allied health. ', 'Active', '2023-05-04 23:55:50', '2023-05-04 23:55:50'),
(13, 'Felix Institution Category', '   this is felix test of the institution categoryyyyy', 'Inactive', NULL, NULL),
(14, 'test category', 'descfgfdgfdgfdfg', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `institute_colleges`
--

CREATE TABLE `institute_colleges` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institute_colleges`
--

INSERT INTO `institute_colleges` (`id`, `name`, `description`, `status`) VALUES
(1, 'Science', 'Science lessons', 'Active'),
(2, 'Agriculture', 'Agricultural science', 'Active'),
(3, 'Arts And Social Science', 'SocioSo', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `institute_departments`
--

CREATE TABLE `institute_departments` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institute_departments`
--

INSERT INTO `institute_departments` (`id`, `name`, `description`, `status`) VALUES
(6, 'Inforation Technology', 'I.T', 'Active'),
(7, 'Sociology', 'Soooooocio', 'Active'),
(8, 'Data Analytics', 'Anallllllll', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `institute_faculties`
--

CREATE TABLE `institute_faculties` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institute_faculties`
--

INSERT INTO `institute_faculties` (`id`, `name`, `description`, `status`) VALUES
(2, 'Health Science', 'health sciences fuorrr', 'Active'),
(3, 'Agri Business', 'Agric business peoples', 'Active'),
(4, 'Computer Science', 'CoS', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `isceds`
--

CREATE TABLE `isceds` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `classify` varchar(30) NOT NULL,
  `description` text DEFAULT NULL,
  `target` int(5) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `isceds`
--

INSERT INTO `isceds` (`id`, `name`, `code`, `classify`, `description`, `target`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'Education', '0001', 'Humanities', '             a.	Education science - Curriculum studies, Didactics, Educational assessment, testing and measurement, educational evaluation and research, Pedagogical sciences \nb.	Training for pre-school teachers -Early childhood teaching (within formal school settings), Pre-primary teacher training \nc.	 Teacher training without subject specialisation - Class teacher training, Indigenous teacher training, Primary teaching, Teacher training for children with special needs\nd.	Teacher training with subject specialisation - arts and crafts, commercial subjects, music, second languages, specific theoretical subjects, e.g., English, mathematics, history, technical subjects, vocational subjects, physical training.', 30, 'Active', '2022-11-28 14:41:40', '2022-11-28 14:41:40'),
(2, 'Arts and Humanities ', '0002', 'Humanities', 'a.	Audio-visual techniques and media production – Animation, Bookbinding, Camera operating, Compositing (printing), Film and video production, Graphic design, Graphic reproduction, Interactive media design, Media techniques, Multimedia production, Photography, Pre-press operations, print finishing and binding, Printing, Publishing design, lay-out, Radio and TV production, Recorded music production, Sound techniques, Type-setting etc.\nb.	Fashion, interior and industrial design - Costume design, Design of industrial products, Fashion design, Interior architecture, Interior design, Stage designing, Window dressing etc.\nc.	Fine arts - Art theory, Calligraphy, Etching, Fine art printmaking, History of art, Painting, Philosophy of art, Sculpture etc.\nd.	Handicrafts – Ceramics, Crafts, folk arts and artisan, Decorative metal crafts, Indigenous crafts, Embroidery, Floristry (flower arranging), Glass arts and craft, Goldsmithing, Jewellery, making of musical instruments (not industrial), Musical instruments (repairing and tuning), Silversmithing, Stone carving (craft), Weaving (craft), Woodcarving\ne.	Music and performing arts - Acting and directing, Ballet, Choreography, Circus, Composition (music), Conducting (music), Creative and performance art, Dance, Drama, History of film and theatre, History of music, Music, Music conducting, Musicology, Theatre/Theatre sciences\nf.	Religion and theology - Religious history, Study of sacred books, Study of different religions, Theology \ng.	History and archaeology – Archaeology, Cultural history, Folklore studies, History, History of literature, History of medicine, History of science and ideas, History of technology\nh.	Philosophy and ethics – Ethics, Logic, Morals, Philosophy\ni.	Language acquisition - Classical languages, Exogenous languages, Foreign languages, Interpretation, Phonetics, Second languages, for example English as a second language, Sign language, Sign language interpreting, Translation\nj.	Literature and linguistics - Creative writing, First language, Indigenous languages, Linguistics, Literature, “Mother tongue” languages, Native first languages', 30, 'Active', '2022-11-28 14:42:52', '2022-11-28 14:42:52'),
(3, 'Social Sciences, Journalism and Information ', '0003', 'Humanities', 'a.	Economics – Econometrics, Economic history, Economics, Political economics etc.\nb.	Political sciences and civics – Civics, Human rights, International relations, Peace and conflict studies, Political history, Political science, Public policy studies etc.\nc.	Psychology -  Cognitive science, Psychoanalysis, Psychology, Psychotherapy etc.\nd.	Sociology and cultural studies – Criminology, Cultural geography, Cultural studies, Demography/population studies, Ethnology, Gender studies, Social anthropology, Sociology etc.\ne.	Journalism and reporting - Broadcast journalism, Editing, Information (wording and content), Journalism, Mass communication (wording and content), News reporting etc.\nf.	Library, information and archival studies - Archival sciences, Curatorial studies, Documentation, Information science, Library studies, Museum documentation, Museum studies, Museology etc.', 30, 'Active', '2022-11-28 14:43:49', '2022-11-28 14:43:49'),
(4, 'Business, Administration and Law ', '0004', 'Sciences', 'a.	Accounting and taxation – Accounting, Auditing, Bookkeeping, Tax accounting, Tax management\nb.	Finance, banking and insurance - Bank teller studies, Banking and finance, Finance theory, Insurance, Investment analysis, Investments and securities, Pension insurance, Social insurance, Stock-broking\nc.	Management and administration – Administration, Educational management, Employment management, Entrepreneurship, Health administration, Logistic management, Management science, Office management, Organizational theory and behaviour, Personnel administration, Personnel management, ‘Start your own business’ courses, Supply change management, Training management \nd.	Marketing and advertising – Advertising, Consumer behaviour, Market research, Marketing, Merchandising, Public relations etc.\ne.	Secretarial and office work - Administrative and secretarial services, Clerical programmes, Data entry, Foreign language secretary programmes, Keyboard skills, Legal secretary programmes, Medical secretary programmes, Operation of office equipment, Receptionist training, Secretarial programmes, Shorthand, Switchboard operating, Typing\nf.	Wholesale and retail sales – Auctioneering, Consumer services, Demonstration techniques, Purchasing, Real-estate business, Retailing, Stockkeeping, Warehousing, Wholesaling\ng.	Work skills - Clients’ needs, Company knowledge, Customer service training, ‘Introduction to work’ courses, Organization at work, Quality assurance, Trade union courses (general), Work development\nh.	Law - Commercial law, Criminal justice studies, History of law, Indigenous law, Jurisprudence, Labour law, Legal practice, Notary/Notary’s practise, Paralegal studies etc.', 30, 'Active', '2022-11-28 14:44:43', '2022-11-28 14:44:43'),
(5, 'Natural Sciences, Mathematics and Statistics ', '0005', 'Sciences', 'a.	Biology – Biology, Botany, Cell biology, Entomology, Genetics, Mycology, Zoology, pharmacology\nb.	Biochemistry - Biological chemistry, Cell technology, Forensic sciences, Genetic code (DNA, RNA) studies, Genetic engineering, Pharmacology, Tissue culture technology, Toxicology, Virology, Biotechnology \nc.	Environmental sciences – Ecology, Environmental science\nd.	Natural environments and wildlife - National parks and wildlife management, Nature conservation, Wildlife\ne.	Chemistry - Inorganic chemistry, Organic chemistry, Physical chemistry,  \nf.	Earth sciences - Climate research, Earth science, Geodesy, Geography (physical), Geology, Geomatics, Geospatial technology, Meteorology, Oceanography, Seismology\ng.	Physics – Astronomy, Astrophysics, Chemical physics, Medical physics, Optics, Physics, Space science\nh.	Mathematics – Algebra, Geometry, Mathematics, Numerical analysis, Operational research\ni.	Statistics - Actuarial science, Probability theory, Statistics, applied, Survey design, Survey sampling, Study of mathematical (theoretical) statistics.', 20, 'Active', '2022-11-28 14:45:32', '2022-11-28 14:45:32'),
(6, 'Information and Communication Technologies', '0006', 'Sciences', 'a.	Computer use - Computer use, Use of software for calculating (spread sheets), Use of software for data processing, Use of software for desk top publishing, Use of software for word processing, Use of Internet\nb.	Database and network design and administration - Computer administration and management, Computer media applications, Computer network installation and maintenance, Database administrator studies, Information technology administration, Information technology security, Network administration, Network design, Web design\nc.	Software and applications development and analysis - Computer programming, Computer science, Computer systems analysis, Computer systems design, Informatics, Operating systems, Programming languages development, Software development, Software programming.', 30, 'Active', '2022-11-28 14:46:28', '2022-11-28 14:46:28'),
(7, 'Engineering, Manufacturing and Construction', '0007', 'Engineering', 'a.	Chemical engineering and processes - Chemical engineering, Chemical process engineering, Laboratory technology, Oil/gas/petrochemicals processing, Plant and machine operation (processing), Process technology\nb.	Environmental protection technology - Air pollution control, Ecological technology, Energy efficiency, Environmental engineering, Industrial discharge control, Noise pollution control, Recycling, Water pollution control \nc.	Electricity and energy - Air-conditioning trades, Climate engineering, Electrical appliances repairing, Electrical engineering, Electrical fitting, Electrical power generation, Electrical trades, Energy studies, Gas distribution, Heating trades, Nuclear, hydraulic and thermal energy, Power line installation and maintenance, Power production, Refrigeration, Solar power, Wind turbines\nd.	Electronics and automation - Broadcasting electronics, Communication systems, Communications equipment installation, Communications equipment maintenance, Computer engineering, Computer repairing, Control engineering, Data processing technology, Digital technology, Electronic engineering, Electronic equipment servicing, Network technology, Robotics, Telecommunications technology, Television and radio repairing\ne.	Mechanics and metal trades – Gunsmithing, Hydraulics, Locksmithing and safe repairing, Mechanical engineering, Mechanical trades, Metal casting and patternmaking, Metal fitting, turning and machining, Metallurgical engineering, Precision mechanics, Sheet metal working, Steel production, Tool and die making, Welding\nf.	Motor vehicles, ships and aircraft - Aerospace engineering, Aircraft engineering, Aircraft maintenance, Automotive electrical systems, Automotive engineering, Avionics, Coachwork, Marine engineering, Motorcycle engineering, Panel beating, Shipbuilding, Train repair and maintenance, Vehicle building and repairing, Vehicle varnishing/spraying, vehicle electrical systems\ng.	Food processing – Baking, Beer brewing, Butchery, Confectionery, Dairy foods, Food and drink processing, Food preservation, Food science and technology, Meat processing, Pastry cooking, Tobacco processing, Wine production, food handling, food hygiene \nh.	Materials (glass, paper, plastic and wood) - Boat building (non-motor), Cabinet making, Carpentry (furniture), Ceramics (industrial), Furniture making, Glass working (industrial), Industrial diamond production, Paper manufacturing and processing, Plastic manufacturing, Rubber processing, Timber technology, Wood machining and turning, Woodwork trades\ni.	Textiles (clothes, footwear and leather) - Clothing trades, Dressmaking, Footwear making, Fur making, Garment production, Leather processing, Saddlery, Shoemaking, Skins and leather production, Spinning, Tailoring, Textile trades, Upholstery, Weaving (industrial), Wool science\nj.	Mining and extraction - Coal mining, Mineral technology, Mining of minerals, Oil and gas drilling, Oil and gas extraction, Raw material extraction\nk.	Architecture and town planning - Architectural urban design and planning, Architecture, Building design, Cartography/Land surveying, City planning, Community development, Landscape architecture, Structural architecture, Surveying, Town and country planning, Urban planning\nl.	Building and civil engineering – Bricklaying, Bridge construction, Building construction, Building engineering, Building technology, Carpentry and joinery (building), Civil engineering, Construction equipment, Constructional metalwork (building), Dock and harbour engineering, Floor and wall tiling, Floor covering, House building, Industrial abseiling (commercial), Masonry and tile setting, Painting and wall covering, Plastering, Plumbing and pipefitting, Road building, Water engineering and technology, Water supply and sewerage engineering, Ventilation.', 20, 'Active', '2022-11-28 14:47:28', '2022-11-28 14:47:28'),
(8, 'Agriculture, Forestry, Fisheries and Veterinary ', '0008', 'Sciences', 'a.	Crop and livestock production - Agricultural sciences, Agronomy and crop science, Animal husbandry, Crop growing, Dog breeding, Farm and ranch management, Farming, Fruit growing, Grain growing, Horse breeding, Pig farming, Poultry husbandry, Rice farming, Rye and wheat growing, Sheep farming, Soil science, Sugar cane growing, Vegetable planting, Wine growing, soil fertility and irrigation techniques\nb.	Horticulture – Floriculture, Gardening, Green keeping, Horticultural techniques, Nursery management, Turf cultivation, laying out and construction of urban and domestic parks and gardens, floriculture, growing vegetables\nc.	Forestry - Charcoal burning, Forest keeping, Forest product techniques, Forestry, Hunting and trapping, Logging, Tree felling\nd.	Fisheries – Aquaculture, Fish breeding, Fish farms, Fishery science and technology, Pearl cultivating, Seafood farming, Shellfish breeding, operating fishing boats\ne.	Veterinary - Animal health care, Animal reproduction (science), Artificial insemination (of animals), Veterinary assisting, Veterinary medicine, Veterinary nursing, Veterinary science.', 30, 'Active', '2022-11-28 14:48:14', '2022-11-28 14:48:14'),
(9, 'Health and Welfare ', '0009', 'Sciences', 'a.	Dental studies - Dental assisting, Dental hygiene, Dental laboratory technology, Dental nursing, Dental science, Dental surgery, Dental technology, Odontology, Oral surgery, Orthodontics, public dental health\nb.	Medicine – Anaesthetics, Forensic medicine, Forensic pathology, General medicine, Gerontology, Gynaecology, Medical science, Medical training, Medicine, Paediatrics, Psychiatry, Surgery, Training of physicians/doctors\nc.	Nursing and midwifery - Assistant nursing, Basic nursing, General nursing, Health care of old people, Heath care of the disabled, Health care programmes, Infant hygiene (nursing), Midwifery, Nursing aide/Orderly, Psychiatric nursing, Specialised nursing\nd.	Medical diagnostic and treatment technology - Ambulance technology, Hearing aid technology, Medical laboratory technology, Optical technology, Prosthetic technology, Radiology technology, Radiotherapy, X-ray technology (medical)\ne.	Therapy and rehabilitation - Dietician programmes, Medical massage, Nutrition/Dietetics, Occupational therapy, Physiotherapy, Rehabilitation, Speech therapy\nf.	Pharmacy - Dispensing pharmacy, Pharmacy\ng.	Traditional and complementary medicine and therapy - Acupuncture and oriental medicine, Aromatherapy, Ayurvedic medicine, Herbalism, Herbology, Holistic medicine, Homeopathic medicine, Traditional medicine\nh.	Care of elderly and of disabled adults - Care of the elderly, non-medical care of disabled adults, Personal care of adults\ni.	Childcare and youth services - Childcare, Child recreation programmes, Day care, Non-medical care of disabled children, Youth services, Youth worker programmes\nj.	Social work and counselling - Alcohol and drug abuse counselling, Alcohol, tobacco, drugs (knowledge about), Crisis support, Family and marriage counselling, Mobbing and maltreatment (knowledge about), Parole officer training, Probation officer training, Social policy, Social practice, Social theory (applied), Social work (welfare), Vocational counselling, Vocational guidance.', 30, 'Active', '2022-11-28 14:49:04', '2022-11-28 14:49:04'),
(17, 'MyOWNIsced', '0023', 'Humanities', 'Test', 30, 'Inactive', NULL, NULL),
(18, 'My ISCED Name', '1001', 'Sciences', 'My description will be here', 5, 'Active', NULL, NULL),
(19, 'dsfdsfsdfsdfs', 'sadasdas', 'Humanities', 'asfsadfasda', 5, 'Active', NULL, NULL),
(20, 'fewrwerew', 'dfsdfsdfsd', 'Humanities', '', 10, 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `access_level` varchar(255) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `httpVersion` varchar(255) DEFAULT NULL,
  `headers` text DEFAULT NULL,
  `status_code` int(11) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `response_time` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `prog_code` int(11) NOT NULL,
  `prog_isced` varchar(20) NOT NULL,
  `programme` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`prog_code`, `prog_isced`, `programme`, `status`, `createdAt`, `updatedAt`) VALUES
(14, '0005', 'Physics', 'Active', '2023-08-19 21:48:06', NULL),
(15, '0002', 'English', 'Active', '2023-08-19 21:50:18', NULL),
(16, '0002', 'Agricultural Science', 'Active', '2023-08-19 21:50:40', NULL),
(17, '0009', 'Biomedical Science', 'Active', '2023-09-15 22:16:12', NULL),
(18, '0009', 'Nursing', 'Active', '2023-10-07 17:49:49', NULL),
(19, '0004', 'Religious Studies', 'Active', '2023-10-13 19:09:36', NULL),
(20, '0002', 'Geography And Applied Physics', 'Active', '2023-10-13 19:09:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `proposed`
--

CREATE TABLE `proposed` (
  `id` int(11) NOT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `accreditation_year` varchar(255) DEFAULT NULL,
  `faculty_school` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `programme` varchar(255) DEFAULT NULL,
  `programme_isced_code` varchar(100) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proposed`
--

INSERT INTO `proposed` (`id`, `institution`, `college`, `accreditation_year`, `faculty_school`, `department`, `programme`, `programme_isced_code`, `createdAt`, `updatedAt`) VALUES
(2, 'ATU', 'Arts and Science', '2015', 'Faculty of Health Science', 'Department of Health', 'BSc Nursing', '', '2023-05-04 10:10:04', '2023-05-04 10:10:04'),
(3, 'ATU', 'Arts and Science', '2015', 'Faculty of Health Science', 'Department of Health', 'BSc Nursing', '', '2023-05-04 10:12:18', '2023-05-04 10:12:18'),
(9, 'ATU', 'Science', '2018', 'Applied Science', 'Applied Mathematics & Statistics', 'B Tech Cyber Security', '', '2023-05-04 10:12:19', '2023-05-04 10:12:19'),
(10, 'ATU', 'Science', '2018', 'Applied Science', 'Computer Science', 'B. Tech. Computer Science', '', '2023-05-04 10:12:19', '2023-05-04 10:12:19'),
(11, 'ATU', 'Science', '2018', 'Applied Science', 'Computer Science', 'HND Computer Science', '', '2023-05-04 10:12:19', '2023-05-04 10:12:19'),
(12, 'ATU', 'Science', '2018', 'Applied Science', 'Computer Science', 'B Tech Medical Laboratory Science', '', '2023-05-04 10:12:19', '2023-05-04 10:12:19'),
(17, 'ATU', 'Science', '2018', 'Applied Science', 'Science Laboratory Technology', 'B Tech Science Laboratory Technology (Environmental Technology Option)', '', '2023-05-04 10:12:19', '2023-05-04 10:12:19'),
(18, 'ATU', 'Science', '2018', 'Applied Science', 'Science Laboratory Technology', 'B Tech Science Laboratory Technology (Food Analysis Option)', '', '2023-05-04 10:12:19', '2023-05-04 10:12:19'),
(19, 'ATU', 'NA', '2018', 'Built Enivornment', 'Building Technology', 'HND Building Technology', '', '2023-05-04 10:12:19', '2023-05-04 10:12:19'),
(20, '0045445', 'Science', '2019', 'Computer Science', 'IT', 'French', '0006', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE `publication` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(15) DEFAULT NULL,
  `institution_id` varchar(50) NOT NULL,
  `publication_type` varchar(50) DEFAULT NULL,
  `publication_year` varchar(10) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publication`
--

INSERT INTO `publication` (`id`, `staff_id`, `institution_id`, `publication_type`, `publication_year`, `publisher`, `createdAt`, `updatedAt`, `title`) VALUES
(4, '00001', 'KST001', 'article', '2022', 'Afram', '2023-06-23 20:43:46', NULL, 'I am not Felix'),
(5, '0005', 'UG0010', 'proceeding', '2019', 'Afram Publications', '2023-08-10 17:43:44', NULL, 'Legon Dey Form');

-- --------------------------------------------------------

--
-- Table structure for table `reg_districts`
--

CREATE TABLE `reg_districts` (
  `id` int(11) NOT NULL,
  `region` varchar(200) NOT NULL,
  `district` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_districts`
--

INSERT INTO `reg_districts` (`id`, `region`, `district`, `created_at`) VALUES
(1, 'Greater Accra', 'Ablekuma West', '2023-08-05 22:38:45'),
(2, 'Greater Accra', 'Accra', '2023-08-10 08:52:16'),
(3, 'Greater Accra', 'La Nkwantanang-Madina', '2023-08-26 16:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(200) NOT NULL,
  `permissions` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `permissions`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sytems Admin', 'create,read,update', 'Active', '2023-05-26 10:36:16', '2023-05-26 08:36:16'),
(2, 'Database Managerrrrr', 'create,read,update,delete', 'Active', '2023-05-26 10:36:37', '2023-05-26 08:36:37'),
(3, 'Elvis Role Title', 'create,read,update,delete', 'Inactive', '2023-06-10 18:32:57', '2023-06-10 16:32:57'),
(4, 'Another role test', 'create,read,update,delete', 'Inactive', '2023-07-31 00:13:48', '2023-07-30 22:13:48'),
(5, 'MyTest', 'read', 'Active', '2023-07-31 00:18:31', '2023-07-30 22:18:31'),
(6, 'Hala Test', 'read', 'Active', '2023-07-31 00:19:04', '2023-07-30 22:19:04'),
(7, 'Hjghjgsajhdgasjhd', 'read', 'Active', '2023-07-31 00:19:20', '2023-07-30 22:19:20'),
(8, 'Iuyiuyiuyiu', 'read', 'Active', '2023-07-31 00:19:53', '2023-07-30 22:19:53'),
(9, 'Byyuuyuy', 'read', 'Inactive', '2023-07-31 00:20:20', '2023-07-30 22:20:20'),
(10, 'Frenchhhhhh', 'read,update', 'Inactive', '2023-07-31 00:21:42', '2023-07-30 22:21:42'),
(11, 'My final test', 'create,read,update,delete', 'Active', '2023-08-10 09:54:03', '2023-08-10 07:54:03'),
(12, 'Ewrwerwerwerwe', 'read', 'Inactive', '2023-08-10 09:54:59', '2023-08-10 07:54:59'),
(13, 'Shaolin rol', 'read', 'Active', '2023-08-12 13:04:48', '2023-08-12 11:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `national_id_type` varchar(255) DEFAULT NULL,
  `national_id_number` varchar(255) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `other_names` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL COMMENT 'Staff Ranks',
  `staff_type` varchar(255) DEFAULT NULL COMMENT 'Staff categories',
  `college` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `faculty` varchar(255) DEFAULT NULL,
  `employment_type` varchar(255) DEFAULT NULL,
  `disability` varchar(255) DEFAULT NULL,
  `disability_type` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_id`, `year`, `title`, `national_id_type`, `national_id_number`, `institution`, `first_name`, `surname`, `other_names`, `birth_date`, `gender`, `nationality`, `qualification`, `designation`, `rank`, `staff_type`, `college`, `department`, `faculty`, `employment_type`, `disability`, `disability_type`, `createdAt`, `updatedAt`, `status`) VALUES
(7, 'KST/ST/2083', '2022', 'Mr', 'Ghana Card', '9898232334232', 'KST/001/213/89', 'Felix', 'Niamah', 'Kofi Attta', '1989-01-02', 'Male', 'Ghanaian', 'MSc', 'Administration', '1', '16', '1', '6', '4', 'Full-time', 'Yes', '', '2023-08-27 07:19:52', NULL, 'Active'),
(8, 'UG/ST/2012', '2022', 'Mrs.', 'Ghana Card', '3262364872', 'UG0010', 'Shine', 'Ofori', '', '0000-00-00', 'Female', 'Ghanaian', 'BBA', 'Self', '2', '14', '2', '8', '3', 'Part-time', 'No', '', '2023-08-27 07:23:09', NULL, 'Active'),
(9, 'UPS/893/002', '2021', 'Mr', 'Passport', '9897876756465', 'UPS/001/0004', 'Abubakari', 'Muniru', 'Bamba', '1956-04-08', 'Male', 'Nigerian', 'PhD', 'None', '4', '14', '3', '6', '2', 'Full-time', 'No', '', '2023-08-27 14:18:28', NULL, 'Active'),
(10, '9810205', '2023', 'Mr', 'National ID', '5426543654', 'UPS/001/0004', 'Oppong', 'Peasah', '', '1935-03-06', 'Male', 'Ghanaian', 'MBA', 'Nope', '1', '15', '1', '6', '4', 'Full-time', 'No', '', '2023-09-05 18:48:32', NULL, 'Active'),
(12, 'STF/2022/0074', '2022', 'Mr', 'Passport', 'GHA-038473-9833', 'UPS/001/0004', 'Daniel', 'Johnson', 'Ashiokai', '1965-04-01', 'Male', 'Ghanaian', 'BSc', '', '1', '14', '2', '1', '1', 'Full-time', 'No', '', '2023-09-15 14:58:43', NULL, 'Active'),
(13, 'STF/2020/053', '2023', 'Mrs', 'Ghana Card', 'GHA-03245-98361', 'UG0010', 'Mary', 'Yankson', 'Gadagoe', '1978-03-02', 'Female', 'Togolese', 'MA', '', '3', '16', '1', '2', '1', 'Part-time', 'Yes', 'Eye', '2023-09-15 14:58:43', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `staffcategory`
--

CREATE TABLE `staffcategory` (
  `id` int(11) NOT NULL,
  `staff_type` varchar(255) DEFAULT NULL,
  `ranks` text DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `default_type` varchar(20) NOT NULL DEFAULT 'default',
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffcategory`
--

INSERT INTO `staffcategory` (`id`, `staff_type`, `ranks`, `status`, `default_type`, `createdAt`, `updatedAt`) VALUES
(14, 'Research', '2', 'Active', 'default', '2023-08-27 06:44:11', NULL),
(15, 'Non-Teaching', '5,9', 'Active', 'default', '2023-08-27 06:45:18', NULL),
(16, 'Teaching', '1', 'Active', 'default', '2023-08-27 06:48:28', NULL),
(19, 'General Category', '9,6,10', 'Active', 'None', '2023-10-31 20:20:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staffranks`
--

CREATE TABLE `staffranks` (
  `id` int(11) NOT NULL,
  `rank` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `target` decimal(10,2) NOT NULL,
  `default_type` varchar(20) NOT NULL DEFAULT 'default',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffranks`
--

INSERT INTO `staffranks` (`id`, `rank`, `status`, `target`, `default_type`, `created_at`) VALUES
(5, 'Administrators', 'Active', '7.00', 'None', '2023-10-31 19:00:46'),
(2, 'Associate Professor', 'Active', '15.00', 'default', '2023-10-31 18:23:24'),
(3, 'Lecturer', 'Active', '40.00', 'default', '2023-10-31 18:26:13'),
(1, 'Professor', 'Active', '10.00', 'default', '2023-10-31 18:23:24'),
(6, 'Securityy', 'Active', '3.00', 'None', '2023-10-31 19:01:01'),
(4, 'Senior Lecturer', 'Active', '25.00', 'default', '2023-10-31 18:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `std_admissions`
--

CREATE TABLE `std_admissions` (
  `id` int(11) NOT NULL,
  `institution` varchar(50) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `month` varchar(10) DEFAULT NULL,
  `applicant_id` varchar(20) DEFAULT NULL,
  `applicant_national_id` varchar(20) DEFAULT NULL,
  `applicant_id_type` varchar(20) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `other_names` varchar(50) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_country` varchar(50) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `home_town` varchar(50) DEFAULT NULL,
  `home_region` varchar(50) DEFAULT NULL,
  `high_school` varchar(50) DEFAULT NULL COMMENT 'High school attended',
  `high_school_program` varchar(50) DEFAULT NULL COMMENT 'High school location',
  `programme_applied` varchar(255) DEFAULT NULL,
  `programme_type` varchar(50) DEFAULT NULL COMMENT 'Category based on session eg regular, evening, weekend, distance',
  `application_qualification` varchar(100) DEFAULT NULL,
  `admission_offer` varchar(15) DEFAULT NULL,
  `programme_offered` varchar(255) DEFAULT NULL,
  `admission_acceptance` varchar(15) DEFAULT NULL,
  `fee_type` varchar(15) DEFAULT NULL,
  `application_fee` varchar(15) DEFAULT NULL COMMENT 'Cost of application or application fee',
  `disability` varchar(5) DEFAULT NULL,
  `disability_type` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_applications`
--

CREATE TABLE `std_applications` (
  `id` int(11) NOT NULL,
  `institution` varchar(50) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `month` varchar(10) DEFAULT NULL,
  `applicant_id` varchar(20) DEFAULT NULL,
  `applicant_national_id` varchar(20) DEFAULT NULL,
  `applicant_id_type` varchar(20) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `other_names` varchar(50) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_country` varchar(50) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `home_town` varchar(50) DEFAULT NULL,
  `home_region` varchar(50) DEFAULT NULL,
  `high_school` varchar(50) DEFAULT NULL COMMENT 'High school attended',
  `high_school_program` varchar(50) DEFAULT NULL COMMENT 'High school location',
  `programme_applied` varchar(255) DEFAULT NULL,
  `programme_type` varchar(50) DEFAULT NULL COMMENT 'Category based on session eg regular, evening, weekend, distance',
  `application_qualification` varchar(100) DEFAULT NULL,
  `admission_offer` varchar(15) DEFAULT NULL,
  `programme_offered` varchar(255) DEFAULT NULL,
  `admission_acceptance` varchar(15) DEFAULT NULL,
  `fee_type` varchar(15) DEFAULT NULL,
  `application_fee` varchar(15) DEFAULT NULL COMMENT 'Cost of application or application fee',
  `disability` varchar(5) DEFAULT NULL,
  `disability_type` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_enrollments`
--

CREATE TABLE `std_enrollments` (
  `id` int(11) NOT NULL,
  `institution` varchar(50) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `month` varchar(10) DEFAULT NULL,
  `applicant_id` varchar(20) DEFAULT NULL,
  `applicant_national_id` varchar(20) DEFAULT NULL,
  `applicant_id_type` varchar(20) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `other_names` varchar(50) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_country` varchar(50) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `home_town` varchar(50) DEFAULT NULL,
  `home_region` varchar(50) DEFAULT NULL,
  `high_school` varchar(50) DEFAULT NULL COMMENT 'High school attended',
  `high_school_program` varchar(50) DEFAULT NULL COMMENT 'High school location',
  `programme_applied` varchar(255) DEFAULT NULL,
  `programme_type` varchar(50) DEFAULT NULL COMMENT 'Category based on session eg regular, evening, weekend, distance',
  `application_qualification` varchar(100) DEFAULT NULL,
  `admission_offer` varchar(15) DEFAULT NULL,
  `programme_offered` varchar(255) DEFAULT NULL,
  `admission_acceptance` varchar(15) DEFAULT NULL,
  `fee_type` varchar(15) DEFAULT NULL,
  `application_fee` varchar(15) DEFAULT NULL COMMENT 'Cost of application or application fee',
  `disability` varchar(5) DEFAULT NULL,
  `disability_type` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `institution` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `account_type` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `roleid` varchar(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `institution`, `phone`, `account_type`, `status`, `password`, `photo`, `roleid`, `created`, `updatedat`) VALUES
(36, 'elvixbaid@gmail.com', 'Elvis', 'Baidoo', 'KST/001/213/89', '0246636333', 'GTEC', 'Active', '$argon2i$v=19$m=65536,t=4,p=1$ZnVsU2NtWkNtYTdGb1plaQ$kz/8tjjvOIvS6mGwMb20bcPQ4xP6wZdHb5tho8C/KNE', '', '1', '2023-10-31 14:57:58', '2023-11-15 14:01:39'),
(31, 'felsina89@gmail.com', 'Felix', 'Niamah', 'KST/001/213/89', '055492332233333', 'GTEC', 'Active', '$argon2i$v=19$m=65536,t=4,p=1$YVNJMEJqdHNTbnRpL0hrTQ$OpEyjnLd/4E1R0CxJql9CJXdfmcFfDwVaJNaDkIiSpU', '', '2', '2023-05-26 08:30:35', '2023-08-10 10:36:27'),
(35, 'felsina89@yahoo.com', 'Mildred', 'Abbey', 'UG0010', '0202004266', 'Institution', 'Active', '$argon2i$v=19$m=65536,t=4,p=1$NS5ZUEZaM2RYdXhrdEVyWQ$+nY7VurLm8JCOFEi1A1Rf4X3sNdQFoFMluGRWpGZ8oI', '', '13', '2023-08-12 20:25:40', '2023-10-31 15:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `userspages`
--

CREATE TABLE `userspages` (
  `id` int(11) NOT NULL,
  `userid` varchar(50) DEFAULT NULL,
  `pages` text DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userspages`
--

INSERT INTO `userspages` (`id`, `userid`, `pages`, `createdAt`, `updatedAt`) VALUES
(27, 'felsina89@gmail.com', 'Home,ISCED,Locations,Institution Category,Institution,Contact,Programs,Proposed,Staff Category,Staff,Publications,Applications,Enrollments,Graduations,Summary Report,Analytics Report,Users,User Roles,Archive,Logs', '2023-05-26 08:30:35', NULL),
(33, 'felsina89@yahoo.com', 'Home,ISCED,Locations,Institution Category,Institution,Contact,Programs,Proposed,Staff Category,Staff,Publications,Applications,Enrollments,Graduations,Summary Report,Analytics Report,Users,User Roles,Archive,Logs', '2023-08-12 20:25:40', NULL),
(34, 'elvixbaid@gmail.com', 'Home,ISCED,Locations,Institution Category,Institution,Contact,Proposed', '2023-10-31 14:57:58', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_programmes`
--
ALTER TABLE `acc_programmes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programme_isced_id` (`fmail`);

--
-- Indexes for table `acc_programmes_proposed`
--
ALTER TABLE `acc_programmes_proposed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programme_isced_id` (`fmail`);

--
-- Indexes for table `appadmissions`
--
ALTER TABLE `appadmissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_admissions_institution` (`institution`),
  ADD KEY `app_admissions_year` (`year`),
  ADD KEY `app_admissions_month` (`month`),
  ADD KEY `app_admissions_application_qualification` (`application_qualification`),
  ADD KEY `app_admissions_admission_offer` (`admission_offer`),
  ADD KEY `app_admissions_admission_acceptance` (`admission_acceptance`);

--
-- Indexes for table `conferenceworkshop`
--
ALTER TABLE `conferenceworkshop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conference_workshop_institution` (`institution`),
  ADD KEY `conference_workshop_year` (`year`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_admissions_institution` (`institution`),
  ADD KEY `app_admissions_year` (`year`),
  ADD KEY `app_admissions_month` (`month`),
  ADD KEY `app_admissions_application_qualification` (`application_qualification`),
  ADD KEY `app_admissions_admission_offer` (`admission_offer`),
  ADD KEY `app_admissions_admission_acceptance` (`admission_acceptance`);

--
-- Indexes for table `graduates`
--
ALTER TABLE `graduates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_admissions_institution` (`institution`),
  ADD KEY `app_admissions_year` (`year`),
  ADD KEY `app_admissions_month` (`month`),
  ADD KEY `app_admissions_application_qualification` (`application_qualification`),
  ADD KEY `app_admissions_admission_offer` (`admission_offer`),
  ADD KEY `app_admissions_admission_acceptance` (`admission_acceptance`);

--
-- Indexes for table `institutes`
--
ALTER TABLE `institutes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short_name` (`short_name`),
  ADD UNIQUE KEY `institution_code` (`institution_code`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `region_id` (`region`),
  ADD KEY `district_id` (`district`),
  ADD KEY `town_id` (`town`);

--
-- Indexes for table `institute_categories`
--
ALTER TABLE `institute_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `institute_colleges`
--
ALTER TABLE `institute_colleges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `institute_departments`
--
ALTER TABLE `institute_departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `institute_faculties`
--
ALTER TABLE `institute_faculties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `isceds`
--
ALTER TABLE `isceds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_user_name` (`user_name`),
  ADD KEY `logs_access_level` (`access_level`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`prog_code`);

--
-- Indexes for table `proposed`
--
ALTER TABLE `proposed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_districts`
--
ALTER TABLE `reg_districts`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`);

--
-- Indexes for table `staffcategory`
--
ALTER TABLE `staffcategory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_type` (`staff_type`);

--
-- Indexes for table `staffranks`
--
ALTER TABLE `staffranks`
  ADD PRIMARY KEY (`rank`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `std_admissions`
--
ALTER TABLE `std_admissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_admissions_institution` (`institution`),
  ADD KEY `app_admissions_year` (`year`),
  ADD KEY `app_admissions_month` (`month`),
  ADD KEY `app_admissions_application_qualification` (`application_qualification`),
  ADD KEY `app_admissions_admission_offer` (`admission_offer`),
  ADD KEY `app_admissions_admission_acceptance` (`admission_acceptance`);

--
-- Indexes for table `std_applications`
--
ALTER TABLE `std_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_admissions_institution` (`institution`),
  ADD KEY `app_admissions_year` (`year`),
  ADD KEY `app_admissions_month` (`month`),
  ADD KEY `app_admissions_application_qualification` (`application_qualification`),
  ADD KEY `app_admissions_admission_offer` (`admission_offer`),
  ADD KEY `app_admissions_admission_acceptance` (`admission_acceptance`);

--
-- Indexes for table `std_enrollments`
--
ALTER TABLE `std_enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_admissions_institution` (`institution`),
  ADD KEY `app_admissions_year` (`year`),
  ADD KEY `app_admissions_month` (`month`),
  ADD KEY `app_admissions_application_qualification` (`application_qualification`),
  ADD KEY `app_admissions_admission_offer` (`admission_offer`),
  ADD KEY `app_admissions_admission_acceptance` (`admission_acceptance`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `userspages`
--
ALTER TABLE `userspages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_programmes`
--
ALTER TABLE `acc_programmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `acc_programmes_proposed`
--
ALTER TABLE `acc_programmes_proposed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `appadmissions`
--
ALTER TABLE `appadmissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `conferenceworkshop`
--
ALTER TABLE `conferenceworkshop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `graduates`
--
ALTER TABLE `graduates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `institutes`
--
ALTER TABLE `institutes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `institute_categories`
--
ALTER TABLE `institute_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `institute_colleges`
--
ALTER TABLE `institute_colleges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `institute_departments`
--
ALTER TABLE `institute_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `institute_faculties`
--
ALTER TABLE `institute_faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `isceds`
--
ALTER TABLE `isceds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `prog_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `proposed`
--
ALTER TABLE `proposed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `publication`
--
ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reg_districts`
--
ALTER TABLE `reg_districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `staffcategory`
--
ALTER TABLE `staffcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `staffranks`
--
ALTER TABLE `staffranks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `std_admissions`
--
ALTER TABLE `std_admissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `std_applications`
--
ALTER TABLE `std_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `std_enrollments`
--
ALTER TABLE `std_enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `userspages`
--
ALTER TABLE `userspages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
