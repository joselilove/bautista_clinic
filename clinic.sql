-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2020 at 01:22 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `rec_medication` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rec_diagnosis` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rec_bp` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `rec_cr` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `rec_wt` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `rec_status` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT 'ongoing',
  `rec_date` timestamp NULL DEFAULT NULL,
  `rec_complains` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rec_rr` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `rec_qn` int(8) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`id`, `patient_id`, `rec_medication`, `rec_diagnosis`, `rec_bp`, `rec_cr`, `rec_wt`, `rec_status`, `rec_date`, `rec_complains`, `rec_rr`, `rec_qn`, `user_id`, `is_deleted`, `modified`, `created`) VALUES
(1, 23, 'None', 'None', '90/78', '78', '90', 'done', '2019-12-01 00:10:00', 'None', '90', NULL, 2, 0, '2019-12-01 00:10:00', '2019-11-30 16:11:33'),
(2, 17, 'Salbutamol', 'Normal', '89/78', '56', '89', 'done', '2019-12-02 06:11:00', 'None', '76', NULL, 2, 0, '2019-12-02 06:11:00', '2019-11-30 16:11:55'),
(3, 15, 'Neozep', 'Normal', '89/89', '78', '78', 'done', '2019-12-03 05:12:00', 'None', '56', NULL, 2, 0, '2019-12-03 05:12:00', '2019-11-30 16:13:01'),
(4, 2, 'None', 'Overweight', '90/90', '89', '89', 'done', '2020-01-01 00:13:00', 'None', '78', NULL, 2, 0, '2020-01-01 00:13:00', '2019-11-30 16:13:34'),
(5, 21, 'Eat some Vagetables', 'none', '90/89', '90', '90', 'done', '2020-01-02 00:13:00', 'none', '87', NULL, 2, 0, '2020-01-02 00:13:00', '2019-11-30 16:14:09'),
(6, 12, 'Vitamin C', 'None', '90/89', '89', '87', 'done', '2020-01-04 00:14:00', 'NONE', '90', NULL, 2, 0, '2020-01-04 00:14:00', '2019-11-30 16:15:02'),
(7, 28, 'None', 'None', '89/90', '78', '89', 'done', '2020-02-01 00:15:00', 'None', '78', NULL, 2, 0, '2020-02-01 00:15:00', '2019-11-30 16:16:11'),
(8, 24, 'None', 'None', '90/78', '90', '90', 'done', '2020-02-06 00:16:00', 'None', '79', NULL, 2, 0, '2020-02-06 00:16:00', '2019-11-30 16:16:40'),
(9, 8, 'None', 'None', '89/67', '56', '45', 'done', '2020-02-12 00:17:00', 'None', '89', NULL, 2, 0, '2020-02-12 00:17:00', '2019-11-30 16:17:45'),
(10, 20, 'None', 'None', '90/89', '89', '67', 'done', '2018-11-04 11:57:00', 'None', '90', NULL, 2, 0, '2019-11-04 11:57:00', '2019-12-01 03:58:13'),
(11, 27, 'None', 'None', '90/90', '89', '90', 'done', '2018-10-01 11:58:00', 'None', '78', NULL, 2, 0, '2019-10-01 11:58:00', '2019-12-01 03:58:57'),
(12, 23, 'Low Calories Food', 'Normal', '90/78', '99', '90', 'done', '2019-11-01 04:38:20', 'None', '78', NULL, 2, 0, '2019-11-01 04:38:20', '2019-12-01 04:22:54'),
(13, 6, 'None', 'None', '90/78', '89', '87', 'done', '2019-10-16 13:16:00', 'None', '89', NULL, 2, 0, '2019-10-16 13:16:00', '2019-12-01 05:17:09'),
(14, 16, 'Normal', 'Normal', '90/90', '78', '90', 'done', '2019-10-23 13:17:00', 'Normal', '78', NULL, 2, 0, '2019-10-23 13:17:00', '2019-12-01 05:17:43'),
(15, 24, 'None', 'None', '90/90', '78', '89', 'done', '2019-10-31 13:18:00', 'None', '89', NULL, 2, 0, '2019-10-31 13:18:00', '2019-12-01 05:18:25'),
(16, 18, 'Need some vitamin C', 'Normal', '90/90', '90', '89', 'done', '2019-09-17 13:19:00', 'Normal', '89', NULL, 2, 0, '2019-09-17 13:19:00', '2019-12-01 05:19:43'),
(17, 28, '90', '78', '90/89', '89', '90', 'done', '2019-09-23 13:19:00', '67', '89', NULL, 2, 0, '2019-09-23 13:19:00', '2019-12-01 05:20:00'),
(18, 25, 'Normal', 'Normal', '90/90', '97', '56', 'done', '2019-09-20 13:20:00', 'Normal\r\n', '67', NULL, 2, 0, '2019-09-20 13:20:00', '2019-12-01 05:20:59'),
(19, 19, 'None', 'None', '90/78', '67', '78', 'done', '2019-08-01 13:24:00', 'None', '90', NULL, 2, 0, '2019-08-01 13:24:00', '2019-12-01 05:24:49'),
(20, 19, 'Good', 'Normal', '90/78', '90', '90', 'done', '2019-08-22 13:24:00', 'None', '90', NULL, 2, 0, '2019-08-22 13:24:00', '2019-12-01 05:25:15'),
(21, 31, 'Good', 'Good', '90/78', '90', '90', 'done', '2019-09-17 13:25:00', 'Good', '90', NULL, 2, 0, '2019-09-17 13:25:00', '2019-12-01 05:25:34'),
(22, 12, 'None', 'None', '90/90', '78', '78', 'done', '2019-07-10 13:32:00', 'None', '90', NULL, 2, 0, '2019-07-10 13:32:00', '2019-12-01 05:33:06'),
(23, 11, 'None', 'None', '89/90', '79', '90', 'done', '2019-07-02 13:33:00', 'None', '89', NULL, 2, 0, '2019-07-02 13:33:00', '2019-12-01 05:33:33'),
(24, 31, 'Drink some juice :>', 'None', '90/90', '78', '90', 'done', '2019-07-04 13:33:00', 'None', '78', NULL, 2, 0, '2019-07-04 13:33:00', '2019-12-01 05:33:50'),
(25, 25, 'None', 'None', '90/89', '89', '78', 'done', '2019-07-04 13:34:00', 'None', '90', NULL, 2, 0, '2019-07-04 13:34:00', '2019-12-01 05:34:26'),
(26, 26, 'None', 'None', '89/89', '78', '90', 'done', '2019-07-18 13:34:00', 'None', '90', NULL, 2, 0, '2019-07-18 13:34:00', '2019-12-01 05:34:41'),
(27, 29, 'None', 'None', '89/67', '89', '89', 'done', '2019-07-18 13:37:00', 'None', '67', NULL, 2, 0, '2019-07-18 13:37:00', '2019-12-01 05:37:19'),
(28, 24, '90', '90', '90/90', '90', '90', 'done', '2019-07-25 13:40:00', '90', '90', NULL, 2, 0, '2019-07-25 13:40:00', '2019-12-01 05:40:16'),
(29, 19, 'None', 'None', '90/90', '78', '78', 'done', '2019-06-01 13:43:00', 'None', '78', NULL, 2, 0, '2019-06-01 13:43:00', '2019-12-01 05:43:33'),
(30, 15, 'None', 'None', '89/89', '67', '90', 'done', '2019-06-02 13:43:00', 'None', '89', NULL, 2, 0, '2019-06-02 13:43:00', '2019-12-01 05:43:55'),
(31, 16, 'None', 'Above normal', '80/89', '89', '90', 'done', '2019-06-04 13:44:00', 'Normal', '90', NULL, 2, 0, '2019-06-04 13:44:00', '2019-12-01 05:44:20'),
(32, 27, 'None', 'None', '90/78', '90', '78', 'done', '2019-05-01 13:55:00', 'None', '90', NULL, 2, 0, '2019-05-01 13:55:00', '2019-12-01 05:55:35'),
(33, 28, 'None', 'None', '90/90', '67', '89', 'done', '2019-05-09 13:55:00', 'None', '78', NULL, 2, 0, '2019-05-09 13:55:00', '2019-12-01 05:56:02'),
(34, 29, 'None', 'None', '89/78', '67', '90', 'done', '2019-05-16 13:56:00', 'None', '89', NULL, 2, 0, '2019-05-16 13:56:00', '2019-12-01 05:56:23'),
(35, 16, 'None', 'None', '90/90', '90', '78', 'done', '2019-04-01 13:59:00', 'None', '89', NULL, 2, 0, '2019-04-01 13:59:00', '2019-12-01 05:59:46'),
(36, 19, 'None', 'None', '90/78', '67', '90', 'done', '2019-04-02 14:00:00', 'None', '89', NULL, 2, 0, '2019-04-02 14:00:00', '2019-12-01 06:00:21'),
(37, 18, 'None', 'None', '90/90', '90', '56', 'done', '2019-04-01 14:00:00', 'None', '78', NULL, 2, 0, '2019-04-01 14:00:00', '2019-12-01 06:00:45'),
(38, 27, 'none', 'none', '89/67', '78', '90', 'done', '2019-03-01 14:02:00', 'none', '78', NULL, 2, 0, '2019-03-01 14:02:00', '2019-12-01 06:02:49'),
(39, 28, 'none', 'none', '89/78', '67', '90', 'done', '2019-03-01 14:04:00', 'none', '89', NULL, 2, 0, '2019-03-01 14:04:00', '2019-12-01 06:04:37'),
(40, 31, 'Done', 'Done', '80/89', '67', '90', 'done', '2019-03-20 14:04:00', 'Done', '89', NULL, 2, 0, '2019-03-20 14:04:00', '2019-12-01 06:05:11'),
(41, 9, 'None', 'None', '89/90', '89', '90', 'done', '2019-02-14 14:06:00', 'None', '90', NULL, 2, 0, '2019-02-14 14:06:00', '2019-12-01 06:07:00'),
(42, 27, 'None', 'None', '90/78', '89', '78', 'done', '2019-02-01 14:07:00', 'None', '90', NULL, 2, 0, '2019-02-01 14:07:00', '2019-12-01 06:07:20'),
(43, 28, 'None', 'None', '89/89', '67', '89', 'done', '2019-02-28 14:07:00', 'None', '89', NULL, 2, 0, '2019-02-28 14:07:00', '2019-12-01 06:07:39'),
(44, 2, 'None', 'None', '90/78', '78', '78', 'done', '2019-01-15 14:09:00', 'None', '90', NULL, 2, 0, '2019-01-15 14:09:00', '2019-12-01 06:09:38'),
(45, 1, 'None', 'None', '89/67', '89', '89', 'done', '2019-01-01 14:10:00', 'None', '67', NULL, 2, 0, '2019-01-01 14:10:00', '2019-12-01 06:10:18'),
(46, 3, 'None', 'None', '90/78', '89', '89', 'done', '2019-01-23 14:10:00', 'None', '90', NULL, 2, 0, '2019-01-23 14:10:00', '2019-12-01 06:10:53'),
(47, 27, 'None', 'None', '89/89', '67', '890', 'done', '2019-01-21 14:11:00', 'None', '68', NULL, 2, 0, '2019-01-21 14:11:00', '2019-12-01 06:11:23'),
(48, 28, 'None', 'None', '90/78', '90', '89', 'done', '2019-01-07 14:11:00', 'None', '80', NULL, 2, 0, '2019-01-07 14:11:00', '2019-12-01 06:11:59'),
(49, 1, 'None', 'None', '90/89', '89', '90', 'done', '2019-12-26 19:57:00', 'None', '90', NULL, 2, 0, '2019-12-08 11:57:46', '2019-12-08 11:57:21'),
(50, 1, 'None', 'None', '90/90', '9', '90', 'done', '2019-12-28 19:58:00', 'None', '90', NULL, 2, 0, '2019-12-08 11:58:53', '2019-12-08 11:58:21'),
(51, 30, '', '', '90/89', '90', '61', 'ongoing', '2019-12-12 08:42:00', '', '89', NULL, 2, 0, '2019-12-11 00:43:11', '2019-12-11 00:43:11'),
(52, 27, '', '', '90/70', '89', '90', 'ongoing', '2019-12-19 08:43:00', '', '76', NULL, 2, 0, '2019-12-11 00:43:31', '2019-12-11 00:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `pat_middle_initial` varchar(2) DEFAULT NULL,
  `pat_address` varchar(100) DEFAULT NULL,
  `pat_gender` varchar(60) DEFAULT NULL,
  `pat_occupation` varchar(100) DEFAULT NULL,
  `pat_contact` varchar(20) DEFAULT NULL,
  `pat_age` int(10) DEFAULT NULL,
  `pat_birthdate` date DEFAULT NULL,
  `pat_fname` varchar(100) DEFAULT NULL,
  `pat_lname` varchar(100) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `pat_middle_initial`, `pat_address`, `pat_gender`, `pat_occupation`, `pat_contact`, `pat_age`, `pat_birthdate`, `pat_fname`, `pat_lname`, `user_id`, `is_deleted`, `modified`, `created`) VALUES
(1, 'A', 'Brgy 04 Maria Aurora', '1', 'Software Enginner', '09352609206', 21, NULL, 'Israels', 'Alisoso', 1, 0, '2019-11-09 07:20:16', '2019-11-09 05:42:14'),
(2, 'V', 'Brgy 04 Maria Aurora', '1', 'Mechanical Enginer', '09997265241', 22, NULL, 'Andro', 'Tubeje', 1, 0, '2019-11-24 02:23:43', '2019-11-09 06:05:27'),
(3, 'Y', 'Brgy San Joaquin', '1', 'Civil Engineer', '09837362518', 21, NULL, 'Mark', 'DelaCruz', 2, 0, '2019-11-09 07:15:23', '2019-11-09 06:07:37'),
(5, 'R', 'Brgy 04 Maria Aurora', '1', 'Programmer', '09245251515', 21, NULL, 'Kryss', 'Bartolome', 2, 0, '2019-11-09 07:15:27', '2019-11-09 06:11:03'),
(6, 'T', 'Bazal Maria Aurora', '0', 'Flight attendant', '09245626346', 23, NULL, 'Janine', 'Raval', 2, 0, '2019-11-09 07:15:30', '2019-11-09 06:13:09'),
(7, 'R', 'Makati Ave', '0', 'Quality Assurance Engineer', '09123456789', 22, NULL, 'Pathria', 'Pumajad', 2, 0, '2019-11-09 07:15:32', '2019-11-09 06:15:21'),
(8, 'R', 'St. Rosa Manila', '1', 'Backen Software Engineer', '09352609206', 23, NULL, 'Brian Daivd', 'Kulata', 2, 0, '2019-11-09 07:15:34', '2019-11-09 06:17:26'),
(9, 'T', '1474 Galvani Street Makati', '1', 'System Engineer', '09453627815', 21, NULL, 'Edwuardo', 'DelaCruz', 2, 0, '2019-11-09 14:27:28', '2019-11-09 06:19:16'),
(10, 'U', 'Taguig City', '1', 'Backen Software Engineer', '0976383625', 21, NULL, 'Jarrel', 'Mapangahas', 1, 0, '2019-11-09 14:27:32', '2019-11-09 06:46:02'),
(11, 'I', 'Mandaluyonh', '1', 'Backen Software Engineer', '09875473221', 23, NULL, 'JImmy Man', 'Towrtw', 1, 0, '2019-11-10 03:10:36', '2019-11-09 06:47:25'),
(12, 'R', 'Brgy 02 Purok 07 Maria Aurora Aurora', '1', 'Teacher', '09876456321', 23, NULL, 'Arnold', 'Sanjose', 2, 0, '2019-11-10 04:00:12', '2019-11-10 04:00:12'),
(14, 'A', 'Brgy San Isidro Makati Cuty', '0', 'Janitor', '09352871911', 21, NULL, 'Colin', 'Smith', 2, 0, '2019-11-30 15:39:29', '2019-11-30 15:39:29'),
(15, 'A', 'Brgy Rizal Maria Aurora Aurora', '0', 'Pricipal II', '09671876531', 46, NULL, 'Andrea', 'Schlieker', 2, 0, '2019-11-30 15:40:46', '2019-11-30 15:40:46'),
(16, 'B', 'Rizal Nueva Ecija', '1', 'Auto Mechanic', '09876538291', 45, NULL, 'Gavin', 'Coley', 2, 0, '2019-11-30 15:41:55', '2019-11-30 15:41:55'),
(17, 'U', 'Cabanatuan City Nueva Ecija', '1', 'Sales Executive', '09567834261', 34, NULL, 'Alistair', 'Warman', 2, 0, '2019-11-30 15:43:05', '2019-11-30 15:43:05'),
(18, 'Y', 'Santa Rosa Neuva Ecija', '1', 'Assistant Manager', '09764729187', 35, NULL, 'Victor', 'Sloan', 2, 0, '2019-11-30 15:44:07', '2019-11-30 15:44:07'),
(19, 'P', 'Munuz Nueva Ecija', '0', 'Sales Lady', '09675618716', 34, NULL, 'Julia Peyton', 'Jones', 2, 0, '2019-11-30 15:45:17', '2019-11-30 15:45:17'),
(20, 'U', 'Brgy Tondod Sanjose Nueva Ecija', '0', 'Manager', '09458791345', 34, NULL, 'Tina', 'Keanne', 2, 0, '2019-11-30 15:46:14', '2019-11-30 15:46:14'),
(21, 'C', 'Gilpuyat Ave Makati City', '0', 'Quality Assurance Engineer', '09568916518', 23, NULL, 'Anne', 'Coley', 2, 0, '2019-11-30 15:47:44', '2019-11-30 15:47:44'),
(22, 'I', 'Reliance Street Mandaluyong', '1', 'Call center Agent', '09735461748', 36, NULL, 'Richard', 'Wentworth', 2, 0, '2019-11-30 15:48:44', '2019-11-30 15:48:44'),
(23, 'O', 'Cubao Quezon City', '1', 'Driver', '09564378184', 23, NULL, 'Alex', 'Hartle', 2, 0, '2019-11-30 15:52:40', '2019-11-30 15:52:40'),
(24, 'K', 'Mankato Mississippi 965222', '0', 'Tech Support', '09784532786', 21, NULL, 'Cecilia', 'Chapman', 2, 0, '2019-11-30 15:53:48', '2019-11-30 15:53:48'),
(25, 'W', 'Frederick Nebraska 20620', '1', 'Voice Assistant support', '09794530921', 34, NULL, 'Iris', 'Watson', 2, 0, '2019-11-30 15:54:44', '2019-11-30 15:54:44'),
(26, 'F', 'Roseville NH 11523', '1', 'Road Maintenance', '09651865483', 45, NULL, 'Celeste', 'Slater', 2, 0, '2019-11-30 15:55:34', '2019-11-30 15:55:34'),
(27, 'D', 'Azusa New York 39531', '1', 'Reporter', '09678934517', 34, NULL, 'Theodore', 'Lowe', 2, 0, '2019-11-30 15:56:37', '2019-11-30 15:56:37'),
(28, 'N', 'San Antonio MI 47096', '0', 'Trainor', '09785613456', 42, NULL, 'Calista', 'Wise', 2, 0, '2019-11-30 15:57:30', '2019-11-30 15:57:30'),
(29, 'K', 'Tamuning PA 10855', '0', 'Eye Doctor', '09785641356', 56, NULL, 'Kyla', 'Olsen', 2, 0, '2019-11-30 15:58:30', '2019-11-30 15:58:30'),
(30, 'J', 'Corona New Mexico 08219', '0', 'Elevator Maintenance', '09786543567', 34, NULL, 'Forrest', 'Ray', 2, 0, '2019-11-30 15:59:48', '2019-11-30 15:59:48'),
(31, 'K', 'Muskegon KY 12482', '1', 'Backen Software Engineer', '09784563721', 45, NULL, 'Hiroko', 'Potter', 2, 0, '2019-11-30 16:02:51', '2019-11-30 16:02:51'),
(32, 'G', 'Chelsea MI 67708', '1', 'Student Assistant', '09684536712', 26, NULL, 'Nyssa', 'Vazquez', 2, 0, '2019-11-30 16:03:46', '2019-11-30 16:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `emp_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `activated` int(1) NOT NULL DEFAULT '0',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `emp_type`, `email`, `activated`, `modified`, `created`) VALUES
(1, 'John Y. Polanes', 'selin1223', '$2y$10$trfec8bA73SGIwBgtUgg/OCwo4jTPB82IgLhuHxwk.y0yzH319yxy', '1', 'macayananjoselin@gmail.com', 1, '2020-01-07 12:03:47', '2019-11-08 22:04:48'),
(2, 'Vic U. Kahatas', 'jasmin1223', '$2y$10$trfec8bA73SGIwBgtUgg/OCwo4jTPB82IgLhuHxwk.y0yzH319yxy', '0', 'jasmin@gmail.com', 1, '2020-01-07 12:50:55', '2019-11-09 04:58:23'),
(3, 'DelaCruz', 'edu12234', '$2y$10$413ZjR7HYojkDVbBKCl5Du4NlibKuUXFdPTdKnlExxFtjr/Gw3lXK', '0', 'edu@gmail.com', 1, '2019-11-24 09:53:59', '2019-11-24 08:44:41'),
(4, 'Test Test', 'test1223', '$2y$10$jJSp16.8LV/iPcpc2BLYX.w7hRrCeDe/VDo9v7X8yYNT/XuFHf8M2', '0', 'test@gmail.com', 1, '2019-12-01 13:04:27', '2019-12-01 12:52:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medications`
--
ALTER TABLE `medications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
