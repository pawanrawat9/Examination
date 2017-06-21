-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2016 at 09:15 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam_category`
--

CREATE TABLE IF NOT EXISTS `exam_category` (
  `ec_id` int(10) NOT NULL,
  `ec_name` varchar(255) NOT NULL,
  `ec_create_by` int(10) NOT NULL,
  `ec_display` int(10) NOT NULL,
  `ec_description` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_category`
--

INSERT INTO `exam_category` (`ec_id`, `ec_name`, `ec_create_by`, `ec_display`, `ec_description`) VALUES
(2, 'Cricket', 2, 1, 'Its for Cricket Fans');

-- --------------------------------------------------------

--
-- Table structure for table `exam_master`
--

CREATE TABLE IF NOT EXISTS `exam_master` (
  `em_id` int(11) NOT NULL,
  `em_ec_id` int(11) NOT NULL,
  `em_name` varchar(255) NOT NULL,
  `em_description` text NOT NULL,
  `em_display` int(11) NOT NULL,
  `em_create_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_master`
--

INSERT INTO `exam_master` (`em_id`, `em_ec_id`, `em_name`, `em_description`, `em_display`, `em_create_by`) VALUES
(1, 2, 'Sachin Test', 'Its for all the Sachin Maniacs', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `question_master`
--

CREATE TABLE IF NOT EXISTS `question_master` (
  `q_id` int(11) NOT NULL,
  `q_em_id` int(11) NOT NULL,
  `q_text` varchar(255) NOT NULL,
  `q_create_by` int(11) NOT NULL,
  `q_date` datetime DEFAULT NULL,
  `q_type` varchar(255) NOT NULL,
  `q_active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_master`
--

INSERT INTO `question_master` (`q_id`, `q_em_id`, `q_text`, `q_create_by`, `q_date`, `q_type`, `q_active`) VALUES
(1, 1, 'What is Sachin Birthdate', 2, '2016-04-24 23:14:31', 'Single Text Selection', 1),
(2, 1, 'His first Century was against', 2, '2016-04-25 00:09:58', 'Single Text Selection', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE IF NOT EXISTS `question_options` (
  `o_id` int(11) NOT NULL,
  `o_q_id` int(11) NOT NULL,
  `o_text` varchar(255) NOT NULL,
  `o_image_path` varchar(255) NOT NULL,
  `o_right_option` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_options`
--

INSERT INTO `question_options` (`o_id`, `o_q_id`, `o_text`, `o_image_path`, `o_right_option`) VALUES
(5, 1, '24th April', '', 1),
(6, 1, '23rd April', '', 0),
(7, 1, '26th April', '', 0),
(8, 1, '28th April', '', 0),
(9, 2, 'Bangladesh', '', 0),
(10, 2, 'Pakistan', '', 1),
(11, 2, 'Australia', '', 0),
(12, 2, 'New Zealand', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `s_feedback`
--

CREATE TABLE IF NOT EXISTS `s_feedback` (
  `f_id` int(11) NOT NULL,
  `f_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `f_subject` varchar(255) NOT NULL,
  `f_feedback` text NOT NULL,
  `f_um_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s_feedback`
--

INSERT INTO `s_feedback` (`f_id`, `f_date`, `f_subject`, `f_feedback`, `f_um_id`) VALUES
(1, '0000-00-00 00:00:00', 'Hello', 'Kaim cho', 2),
(2, '0000-00-00 00:00:00', 'Kaisan Ba', 'YoLo', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE IF NOT EXISTS `user_master` (
  `um_id` int(10) NOT NULL,
  `um_name` varchar(255) NOT NULL,
  `um_password` varchar(255) NOT NULL,
  `um_type` varchar(255) NOT NULL,
  `um_is_login` int(10) NOT NULL,
  `um_activate_date` timestamp NULL DEFAULT NULL,
  `um_email_id` varchar(255) NOT NULL,
  `um_create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`um_id`, `um_name`, `um_password`, `um_type`, `um_is_login`, `um_activate_date`, `um_email_id`, `um_create_date`) VALUES
(2, 'havingfun', '123456', 'Administrator', 1, '2016-04-23 14:33:48', 'rajesh.kc.r.1993@gmail.com', '0000-00-00 00:00:00'),
(3, 'rajesh', '123', 'Member', 1, '2016-04-23 14:44:19', 'raj@gmail.com', '0000-00-00 00:00:00'),
(4, 'love', '123', 'Researcher', 1, '2016-04-23 19:12:57', 'raje@gmail.com', '2016-04-23 14:47:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_survey`
--

CREATE TABLE IF NOT EXISTS `user_survey` (
  `us_id` int(11) NOT NULL,
  `us_um_id` int(11) NOT NULL,
  `us_em_id` int(11) NOT NULL,
  `us_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_survey`
--

INSERT INTO `user_survey` (`us_id`, `us_um_id`, `us_em_id`, `us_date`) VALUES
(1, 3, 1, '2016-04-25 00:01:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_survey_details`
--

CREATE TABLE IF NOT EXISTS `user_survey_details` (
  `usd_id` int(11) NOT NULL,
  `usd_us_id` int(11) NOT NULL,
  `usd_q_id` int(11) NOT NULL,
  `usd_o_select` int(11) NOT NULL,
  `usd_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_survey_details`
--

INSERT INTO `user_survey_details` (`usd_id`, `usd_us_id`, `usd_q_id`, `usd_o_select`, `usd_text`) VALUES
(1, 1, 1, 1, NULL),
(2, 1, 1, 0, NULL),
(3, 1, 1, 0, NULL),
(4, 1, 1, 0, NULL),
(5, 2, 1, 1, NULL),
(6, 2, 1, 0, NULL),
(7, 2, 1, 0, NULL),
(8, 2, 1, 0, NULL),
(9, 1, 1, 1, NULL),
(10, 1, 1, 0, NULL),
(11, 1, 1, 0, NULL),
(12, 1, 1, 0, NULL),
(13, 1, 1, 1, NULL),
(14, 1, 1, 0, NULL),
(15, 1, 1, 0, NULL),
(16, 1, 1, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam_category`
--
ALTER TABLE `exam_category`
  ADD PRIMARY KEY (`ec_id`);

--
-- Indexes for table `exam_master`
--
ALTER TABLE `exam_master`
  ADD PRIMARY KEY (`em_id`);

--
-- Indexes for table `question_master`
--
ALTER TABLE `question_master`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `s_feedback`
--
ALTER TABLE `s_feedback`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`um_id`);

--
-- Indexes for table `user_survey`
--
ALTER TABLE `user_survey`
  ADD PRIMARY KEY (`us_id`);

--
-- Indexes for table `user_survey_details`
--
ALTER TABLE `user_survey_details`
  ADD PRIMARY KEY (`usd_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam_category`
--
ALTER TABLE `exam_category`
  MODIFY `ec_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `exam_master`
--
ALTER TABLE `exam_master`
  MODIFY `em_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `question_master`
--
ALTER TABLE `question_master`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `s_feedback`
--
ALTER TABLE `s_feedback`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_survey`
--
ALTER TABLE `user_survey`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_survey_details`
--
ALTER TABLE `user_survey_details`
  MODIFY `usd_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
