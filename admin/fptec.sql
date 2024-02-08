-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2024 at 08:12 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `database_logs`
--

CREATE TABLE `database_logs` (
  `id` int(11) NOT NULL,
  `file_name` varchar(500) NOT NULL,
  `tstamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `fee_type` varchar(50) DEFAULT NULL,
  `application_fee` varchar(15) DEFAULT NULL COMMENT 'Cost of application or application fee',
  `disability` varchar(5) DEFAULT NULL,
  `disability_type` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_target`
--

CREATE TABLE `enrollment_target` (
  `id` smallint(6) NOT NULL,
  `postgrad` decimal(5,2) NOT NULL,
  `intern` decimal(5,2) NOT NULL,
  `feepay` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `graduates`
--

CREATE TABLE `graduates` (
  `id` int(11) NOT NULL,
  `institution` varchar(50) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `graduating_yr` varchar(10) DEFAULT NULL,
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
  `description` text DEFAULT NULL,
  `accredit` date DEFAULT NULL,
  `expire` date DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `institute_schools`
--

CREATE TABLE `institute_schools` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `target` int(5) NOT NULL DEFAULT 0,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `institute` varchar(100) NOT NULL,
  `programme` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE `publication` (
  `id` int(11) NOT NULL,
  `publication_type` varchar(50) DEFAULT NULL,
  `publication_year` varchar(10) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` int(11) NOT NULL,
  `pubid` int(10) NOT NULL,
  `staff_id` varchar(200) NOT NULL,
  `institution_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(200) NOT NULL,
  `apply` varchar(20) NOT NULL DEFAULT 'Both',
  `permissions` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `drank` varchar(255) DEFAULT NULL COMMENT 'Staff Ranks',
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

-- --------------------------------------------------------

--
-- Table structure for table `staffcategory`
--

CREATE TABLE `staffcategory` (
  `id` int(11) NOT NULL,
  `staff_type` varchar(255) DEFAULT NULL,
  `dranks` text DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `default_type` varchar(20) NOT NULL DEFAULT 'default',
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staffranks`
--

CREATE TABLE `staffranks` (
  `id` int(11) NOT NULL,
  `drank` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `target` decimal(10,2) NOT NULL,
  `default_type` varchar(20) NOT NULL DEFAULT 'default',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `photo` varchar(200) DEFAULT NULL,
  `roleid` varchar(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `institution`, `phone`, `account_type`, `status`, `password`, `photo`, `roleid`, `created`, `updatedat`) VALUES
(36, 'elvixbaid@gmail.com', 'Elvis', 'Baidoo', 'KST/001/213/89', '0246636333', 'GTEC', 'Active', '$argon2i$v=19$m=65536,t=4,p=1$ZnVsU2NtWkNtYTdGb1plaQ$kz/8tjjvOIvS6mGwMb20bcPQ4xP6wZdHb5tho8C/KNE', '', '1', '2023-10-31 14:57:58', '2023-11-15 14:01:39'),
(31, 'felsina89@gmail.com', 'Felix', 'Niamah', 'KST/001/213/89', '055492332233333', 'GTEC', 'Active', '$argon2i$v=19$m=65536,t=4,p=1$LkZZcmVwTDNHdHhqaUNVeQ$trMZZAUG/H2Byxz1bHPP+MrRsKFtxDOhoOjZxTj90z0', '', '2', '2023-05-26 08:30:35', '2023-12-28 18:49:11'),
(38, 'felsina89@yahoo.com', 'Renielle', 'Niamah', '', '0277474247', 'GTEC', 'Active', '$argon2i$v=19$m=65536,t=4,p=1$MGg5QjdYcnIwbTd6dkQ5Wg$Ovisssah2TrM45hgIwyQmcdwOSy4LfK19PA9tND8elw', NULL, '1', '2023-12-28 18:07:28', '2023-12-28 18:07:28'),
(35, 'felsina89@yahoo.commm', 'Mildred', 'Abbey', 'UPS/001/0004', '0202004266', 'Institution', 'Active', '$argon2i$v=19$m=65536,t=4,p=1$NS5ZUEZaM2RYdXhrdEVyWQ$+nY7VurLm8JCOFEi1A1Rf4X3sNdQFoFMluGRWpGZ8oI', '', '1', '2023-08-12 20:25:40', '2024-01-17 20:49:11');

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
(34, 'elvixbaid@gmail.com', 'Home,ISCED,Locations,Institution Category,Institution,Contact,Proposed', '2023-10-31 14:57:58', NULL),
(38, 'felsina89@yahoo.com', '', '2023-12-28 18:07:28', NULL),
(39, 'felsina89@yahoo.commm', 'Contact,Programs,Proposed', '2023-12-28 18:07:28', NULL);

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
-- Indexes for table `database_logs`
--
ALTER TABLE `database_logs`
  ADD PRIMARY KEY (`file_name`),
  ADD UNIQUE KEY `id` (`id`);

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
-- Indexes for table `enrollment_target`
--
ALTER TABLE `enrollment_target`
  ADD UNIQUE KEY `id` (`id`);

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
-- Indexes for table `institute_schools`
--
ALTER TABLE `institute_schools`
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
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD UNIQUE KEY `id` (`id`);

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
  ADD PRIMARY KEY (`drank`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_programmes_proposed`
--
ALTER TABLE `acc_programmes_proposed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appadmissions`
--
ALTER TABLE `appadmissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conferenceworkshop`
--
ALTER TABLE `conferenceworkshop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `database_logs`
--
ALTER TABLE `database_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollment_target`
--
ALTER TABLE `enrollment_target`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `graduates`
--
ALTER TABLE `graduates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institutes`
--
ALTER TABLE `institutes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institute_categories`
--
ALTER TABLE `institute_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institute_colleges`
--
ALTER TABLE `institute_colleges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institute_departments`
--
ALTER TABLE `institute_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institute_faculties`
--
ALTER TABLE `institute_faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institute_schools`
--
ALTER TABLE `institute_schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `isceds`
--
ALTER TABLE `isceds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `prog_code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposed`
--
ALTER TABLE `proposed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publication`
--
ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reg_districts`
--
ALTER TABLE `reg_districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffcategory`
--
ALTER TABLE `staffcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffranks`
--
ALTER TABLE `staffranks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `std_admissions`
--
ALTER TABLE `std_admissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `std_applications`
--
ALTER TABLE `std_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `std_enrollments`
--
ALTER TABLE `std_enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `userspages`
--
ALTER TABLE `userspages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
