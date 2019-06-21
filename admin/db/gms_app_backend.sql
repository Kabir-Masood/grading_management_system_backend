-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2019 at 10:21 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gms_app_backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `admin_role` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_date` datetime(6) NOT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime(6) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `email`, `user_id`, `admin_role`, `password`, `mobile`, `created_by`, `created_date`, `modified_by`, `modified_date`, `remarks`, `is_active`) VALUES
(1, 'Md. Masudul Kabir', 'masood.k13b@gmail.com', 'UG02-38-15-051', 1, '123', '01878883163', 'Admin', '2018-10-20 09:49:16.000000', '', '0000-00-00 00:00:00.000000', NULL, 1),
(2, 'Md. Shibli Shadik', 'tusharbd@gmail.com', 'UG02-26-11-003', 1, '123', '01743012366', 'Admin', '2018-11-02 10:41:08.000000', '', '0000-00-00 00:00:00.000000', NULL, 1),
(4, 'Md. Masud Tarek', 'tarek@sub.edu.bd', '01557', 1, '123456', '01714587558', 'Admin', '2018-11-02 10:44:33.000000', 'Admin', '2019-02-04 05:17:35.000000', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch`
--

CREATE TABLE `tbl_batch` (
  `id` int(20) NOT NULL,
  `batch_name` int(11) NOT NULL,
  `dept_id` int(20) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_date` int(11) NOT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime(6) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_batch`
--

INSERT INTO `tbl_batch` (`id`, `batch_name`, `dept_id`, `created_by`, `created_date`, `modified_by`, `modified_date`, `remarks`, `is_active`) VALUES
(1, 26, 1, 'Admin', 2019, '', '0000-00-00 00:00:00.000000', '1', 1),
(2, 38, 1, 'Admin', 2019, '', '0000-00-00 00:00:00.000000', '1', 1),
(3, 43, 1, 'Admin', 2019, '', '0000-00-00 00:00:00.000000', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class_test`
--

CREATE TABLE `tbl_class_test` (
  `id` int(20) NOT NULL,
  `ct_name` varchar(100) NOT NULL,
  `student_id` int(20) NOT NULL,
  `course_id` int(20) NOT NULL,
  `teacher_id` int(20) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_date` datetime(6) NOT NULL,
  `modified_by` varchar(100) NOT NULL,
  `modified_date` datetime(6) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `id` int(20) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `course_credit` double NOT NULL,
  `teacher_id` int(20) NOT NULL,
  `semester_id` int(20) NOT NULL,
  `dept_id` int(20) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_date` datetime(6) NOT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime(6) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`id`, `course_name`, `course_code`, `course_credit`, `teacher_id`, `semester_id`, `dept_id`, `created_by`, `created_date`, `modified_by`, `modified_date`, `remarks`, `is_active`) VALUES
(1, 'Mathematics-I', 'MATH 191', 3, 10, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(2, 'English-I ', 'ENG 171', 3, 4, 1, 3, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(3, 'Mathematics-II ', 'MATH 193 ', 3, 10, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(4, 'English-II ', 'ENG 173', 3, 4, 1, 3, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(5, 'Introduction to Electrical Engineering', 'EEE 105', 3, 6, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(6, 'Introduction to Electrical Engineering Sessional', 'EEE 106', 1.5, 6, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(7, 'Mathematics-III', 'MATH 195', 3, 10, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(8, 'Physics', 'PHY 109', 3, 5, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(9, 'Basic Electronics', 'EEE 205', 3, 6, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(10, 'Basic Electronics Sessional', 'EEE 206', 1.5, 6, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(11, 'Basic Mechanical Engineering', 'ME 107', 3, 6, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(12, 'Mathematics-IV', 'MATH 197', 3, 10, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(13, 'Electrical Drives and Instrumentation', 'EEE 213', 3, 6, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(14, 'Mathematics-V', 'MATH 199', 3, 10, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(15, 'Digital Electronics and Pulse Techniques', 'EEE 301', 3, 3, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(16, 'Artificial Intelligence', 'CSE-0407', 3, 1, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(17, 'Artificial Intelligence Lab', 'CSE-0408', 0.75, 1, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(18, 'Project', 'CSE-0400', 4, 1, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(19, 'Computer Vision And Image Processing', 'CSE-0411', 3, 8, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(20, 'Computer Vision And Image Processing Lab', 'CSE-0412', 0.75, 8, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(21, 'Cellular And Mobile Communication', 'CSE-0427', 3, 9, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(22, 'Cellular And Mobile Communication Lab', 'CSE-0428', 0.75, 9, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(23, 'Structured Programming Language Lab', 'CSE-0104', 1.5, 7, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(24, 'Linear Algebra', 'MAT-0201', 3, 10, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(25, 'Computer Networks', 'CSE-0311', 3, 5, 1, 1, 'Admin', '2019-05-02 09:41:55.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_registration`
--

CREATE TABLE `tbl_course_registration` (
  `id` int(20) NOT NULL,
  `course_id` int(20) NOT NULL,
  `student_result_id` int(20) NOT NULL,
  `student_id` int(20) DEFAULT NULL,
  `semester_id` int(20) NOT NULL,
  `registration_type` varchar(50) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime(6) DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime(6) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_course_registration`
--

INSERT INTO `tbl_course_registration` (`id`, `course_id`, `student_result_id`, `student_id`, `semester_id`, `registration_type`, `created_by`, `created_date`, `modified_by`, `modified_date`, `remarks`, `is_active`) VALUES
(1, 18, 0, 2, 1, 'Regular', 'Admin', '2019-05-06 10:15:21.000000', '', '0000-00-00 00:00:00.000000', '', 1),
(2, 16, 0, 2, 1, 'Regular', 'Admin', '2019-05-06 10:15:22.000000', '', '0000-00-00 00:00:00.000000', '', 1),
(3, 17, 0, 2, 1, 'Regular', 'Admin', '2019-05-06 10:15:22.000000', '', '0000-00-00 00:00:00.000000', '', 1),
(4, 1, 0, 2, 2, 'Regular', 'Admin', '2019-05-06 10:38:37.000000', '', '0000-00-00 00:00:00.000000', '', 1),
(5, 3, 0, 2, 2, 'Regular', 'Admin', '2019-05-06 10:38:37.000000', '', '0000-00-00 00:00:00.000000', '', 1),
(6, 7, 0, 2, 2, 'Regular', 'Admin', '2019-05-06 10:38:37.000000', '', '0000-00-00 00:00:00.000000', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(20) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `dept_code` varchar(11) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_date` datetime(6) NOT NULL,
  `modified_by` varchar(100) NOT NULL,
  `modified_date` datetime(6) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `dept_name`, `dept_code`, `created_by`, `created_date`, `modified_by`, `modified_date`, `remarks`, `is_active`) VALUES
(1, 'Computer Science and Engineering', 'CSE', 'Admin', '2019-03-15 00:00:00.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(2, 'LAW', '013', 'Admin', '2019-05-02 02:00:20.000000', '', '0000-00-00 00:00:00.000000', '', 1),
(3, 'Food Science', '015', 'Admin', '2019-05-02 02:18:34.000000', '', '0000-00-00 00:00:00.000000', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_program`
--

CREATE TABLE `tbl_program` (
  `id` int(20) NOT NULL,
  `program_name` varchar(100) NOT NULL,
  `program_code` varchar(50) NOT NULL,
  `started_on` date DEFAULT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_date` datetime(6) NOT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime(6) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_program`
--

INSERT INTO `tbl_program` (`id`, `program_name`, `program_code`, `started_on`, `created_by`, `created_date`, `modified_by`, `modified_date`, `remarks`, `is_active`) VALUES
(1, 'BSc in CSE', 'UG02', '2018-11-14', 'Admin', '0000-00-00 00:00:00.000000', '', '0000-00-00 00:00:00.000000', NULL, 1),
(2, 'Bsc in Law', '013', '2019-05-05', 'Admin', '2019-05-02 02:00:01.000000', '', '0000-00-00 00:00:00.000000', '', 1),
(3, 'Msc in CSE', 'PG02', '2019-05-04', 'Admin', '2019-05-02 02:18:03.000000', '', '0000-00-00 00:00:00.000000', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semester`
--

CREATE TABLE `tbl_semester` (
  `id` int(20) NOT NULL,
  `semester_name` varchar(100) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_date` datetime(6) NOT NULL,
  `modified_by` varchar(100) NOT NULL,
  `modified_date` datetime(6) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_semester`
--

INSERT INTO `tbl_semester` (`id`, `semester_name`, `created_by`, `created_date`, `modified_by`, `modified_date`, `remarks`, `is_active`) VALUES
(1, 'Spring - 2019', 'Admin', '2019-05-06 10:05:46.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(2, 'Summer - 2019', 'Admin', '2019-05-06 10:37:16.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `id` int(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `batch_id` int(20) NOT NULL,
  `dept_id` int(20) NOT NULL,
  `semester_id` int(20) NOT NULL,
  `program_id` int(20) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_date` datetime(6) NOT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime(6) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `full_name`, `user_id`, `email`, `password`, `mobile`, `batch_id`, `dept_id`, `semester_id`, `program_id`, `created_by`, `created_date`, `modified_by`, `modified_date`, `remarks`, `is_active`) VALUES
(1, 'Md. Masudul Kabir', 'UG02-38-15-051', 'masood.k13b@gmail.com', '1234', '01878883163', 2, 1, 1, 1, 'Admin', '2018-10-20 09:28:06.000000', '', '0000-00-00 00:00:00.000000', '', 1),
(2, 'Md. Shibli Shadik', 'UG02-26-11-003', 'tusharbd@gmail.com', '123455', '01743012366', 1, 1, 1, 1, 'Admin', '2018-10-20 09:28:06.000000', '', '0000-00-00 00:00:00.000000', '', 1),
(3, 'Jinia', 'UG02-43-16-016', 'mrs.kabir13b@gmail.com', '1234', '01878923269', 3, 1, 1, 1, 'Admin', '2018-12-21 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000', NULL, 1),
(4, 'Ananya Chowdhury', 'UG02-38-15-001', 'ananya@gmail.com', '123', '01715477025', 2, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(5, 'Md. Shahariar Alam', 'UG02-38-15-002', 'shahariar@gmail.com', '123', '01725964263', 2, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(6, 'Sayma Zaman Tethli', 'UG02-38-15-003', 'sayma@gmail.com', '123', '01922311831', 2, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(7, 'Shimanta Ghosh', 'UG02-38-15-007', 'shimanto@gmail.com', '123', '01717740012', 2, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(8, 'Md.Sajib Hossain', 'UG02-38-15-009', 'sajib@gmail.com', '123', '', 2, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(9, 'Md. Sohanur Rahman', 'UG02-38-15-017', 'sohan@gmail.com', '123', '\'01716459079', 2, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(10, 'Anika Tasnim', 'UG02-38-15-019', 'anika@gmail.com', '123', '\'01921107922', 2, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(11, 'Sumaiya Akter Shammy', 'UG02-38-15-020', 'tori@gmail.com', '123', '01716508173', 2, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(12, 'Azim Hossain', 'UG02-38-15-022', 'azim@gmail.com', '123', '\'01817400403', 2, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(13, 'Md.Shariful Islam', 'UG02-38-15-023', 'sharif@gmail.com', '123', '\'01834447551', 2, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(14, 'Abdullah Al-Mamun', 'UG02-38-15-024', 'abdullahalmamun@gmail.com', '123', '\'01912037745', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(15, 'Chironjit Sarker Dwip', 'UG02-38-15-035', 'dwip@gmail.com', '123', '01712512452', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(16, 'Papi Halder', 'UG02-38-15-036', 'papi@gmail.com', '123', '01728873514', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(17, 'Md. Mahmudul Hasan', 'UG02-38-15-037', 'mahmudul@gmail.com', '123', '01718216739', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(18, 'Noorjhan Hossain', 'UG02-38-15-041', 'noorjhan@gmail.com', '123', '01911349857', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(19, 'Md. Ratan Mia', 'UG02-38-15-043', 'ratantvc@gmail.com', '123', '01759012080', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(20, 'Md. Mamunur Roshid', 'UG02-38-15-047', 'roshid873@gmail.com', '123', '1710315516', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(21, 'Sakhawat Rahman', 'UG02-38-15-048', 'sakhawat@gmail.com', '123', '01713502506', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(22, 'Md. Jonayed Hossain', 'UG02-38-15-049', 'jonayed@gmail.com', '123', '', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(23, 'Iftikhar Ahmed', 'UG02-38-15-050', 'iftikhar@gmail.com', '123', '01937382293', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(24, 'Md Abdulllah Al Hossain', 'UG02-38-15-053', 'avy@gmail.com', '123', '', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(25, 'Md. Tanvir Hasan', 'UG02-38-15-055', 'tanvir38@gmail.com', '123', '\'01798703712', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(26, 'Jannat Ara Jyoti', 'UG02-38-15-058', 'jyoti@gmail.com', '123', '\'01715345219', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(27, 'Sadakatul Ajam Md.Shakil', 'UG02-38-15-061', 'shakil@gmail.com', '123', '', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1),
(28, 'Faisal Dewan', 'UG02-38-15-063', 'faisal@gmail.com', '123', '01720231900', 1, 1, 1, 1, 'Admin', '2028-06-00 00:00:00.000000', '', '2028-06-00 00:00:00.000000', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_result`
--

CREATE TABLE `tbl_student_result` (
  `id` int(20) NOT NULL,
  `student_id` int(20) NOT NULL,
  `course_id` int(20) NOT NULL,
  `teacher_id` int(20) NOT NULL,
  `semester_id` int(20) NOT NULL,
  `class_test_marks` double NOT NULL DEFAULT '0',
  `mid_term_marks` double NOT NULL DEFAULT '0',
  `final_term_marks` double NOT NULL DEFAULT '0',
  `attendance_marks` double NOT NULL DEFAULT '0',
  `is_class_test_finally_submitted` int(11) NOT NULL DEFAULT '0',
  `is_mid_finally_submitted` int(11) NOT NULL DEFAULT '0',
  `is_final_finally_submitted` int(11) NOT NULL DEFAULT '0',
  `is_attandance_finally_submitted` int(11) NOT NULL DEFAULT '0',
  `created_by` varchar(100) NOT NULL,
  `created_date` datetime(6) NOT NULL,
  `modified_by` varchar(100) NOT NULL,
  `modified_date` datetime(6) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_student_result`
--

INSERT INTO `tbl_student_result` (`id`, `student_id`, `course_id`, `teacher_id`, `semester_id`, `class_test_marks`, `mid_term_marks`, `final_term_marks`, `attendance_marks`, `is_class_test_finally_submitted`, `is_mid_finally_submitted`, `is_final_finally_submitted`, `is_attandance_finally_submitted`, `created_by`, `created_date`, `modified_by`, `modified_date`, `remarks`, `is_active`) VALUES
(1, 2, 18, 1, 1, 10, 25, 30, 9, 1, 1, 1, 1, 'Admin', '2019-05-06 10:22:58.000000', '', '0000-00-00 00:00:00.000000', 'Remarks', 1),
(2, 2, 16, 1, 1, 12, 22, 33, 9, 1, 1, 1, 1, 'Admin', '2019-05-06 10:24:31.000000', '', '0000-00-00 00:00:00.000000', 'Remarks', 1),
(3, 2, 17, 1, 1, 15, 22, 15, 8, 1, 1, 1, 1, 'Admin', '2019-05-06 10:25:15.000000', '', '0000-00-00 00:00:00.000000', 'Remarks', 1),
(4, 2, 1, 1, 2, 20, 22, 35, 8, 1, 1, 1, 1, 'Admin', '2019-05-06 10:40:46.000000', '', '0000-00-00 00:00:00.000000', 'Remarks', 1),
(5, 2, 3, 1, 2, 11, 15, 20, 9, 1, 1, 1, 1, 'Admin', '2019-05-06 10:41:35.000000', '', '0000-00-00 00:00:00.000000', 'Remarks', 1),
(6, 2, 7, 1, 2, 20, 30, 40, 10, 1, 1, 1, 1, 'Admin', '2019-05-06 10:42:08.000000', '', '0000-00-00 00:00:00.000000', 'Remarks', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `id` int(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `dept_id` int(20) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_date` datetime(6) NOT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime(6) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`id`, `full_name`, `email`, `user_id`, `password`, `mobile`, `dept_id`, `created_by`, `created_date`, `modified_by`, `modified_date`, `remarks`, `is_active`) VALUES
(1, 'Mohammad Masud Tarek', 'Tarek@sub.edu.bd', '01557', '123', '1710000000', 1, 'Admin', '2019-05-02 10:08:02.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(2, 'Mamoon Al Rasheed', 'mamoon@sub.edu.bd', '610', '123', '1710000000', 1, 'Admin', '2019-05-02 10:08:02.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(3, 'Sharmin Akter Sumy', 'sumy@sub.edu.bd', '1922', '123', '1710000000', 1, 'Admin', '2019-05-02 10:08:02.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(4, 'muntasir hasan kanchan', 'muntasirhasank@gmail.com', '2000', '123', '1710000000', 1, 'Admin', '2019-05-02 10:08:02.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(5, 'Farhan Fuad Chowdhury', 'farhan@sub.edu.bd', '2049', '123', '1710000000', 1, 'Admin', '2019-05-02 10:08:02.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(6, 'Sajjad Uddin Mahmud', 'sajjad0430@gmail.com', '2167', '123', '1710000000', 1, 'Admin', '2019-05-02 10:08:02.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(7, 'Amina Rahman', 'aminarahman01@gmail.com', '2202', '123', '1710000000', 1, 'Admin', '2019-05-02 10:08:02.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(8, 'Tisa Islam Irana', 'erana@sub.edu.bd', '2276', '123', '1710000000', 1, 'Admin', '2019-05-02 10:08:02.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(9, 'Nasid Habib Barna', 'barna@sub.edu.bd', '2284', '123', '1710000000', 1, 'Admin', '2019-05-02 10:08:02.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1),
(10, 'Mahruna Kader', 'mahruna@sub.edu.bd', '02283', '123', '1710000000', 1, 'Admin', '2019-05-02 10:08:02.000000', 'null', '0000-00-00 00:00:00.000000', 'null', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `batch_name` (`batch_name`);

--
-- Indexes for table `tbl_class_test`
--
ALTER TABLE `tbl_class_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `tbl_course_registration`
--
ALTER TABLE `tbl_course_registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_result_id` (`student_result_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dept_code` (`dept_code`);

--
-- Indexes for table `tbl_program`
--
ALTER TABLE `tbl_program`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `program_code` (`program_code`);

--
-- Indexes for table `tbl_semester`
--
ALTER TABLE `tbl_semester`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `semester_name` (`semester_name`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_student_result`
--
ALTER TABLE `tbl_student_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_class_test`
--
ALTER TABLE `tbl_class_test`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_course_registration`
--
ALTER TABLE `tbl_course_registration`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_program`
--
ALTER TABLE `tbl_program`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_semester`
--
ALTER TABLE `tbl_semester`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_student_result`
--
ALTER TABLE `tbl_student_result`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
