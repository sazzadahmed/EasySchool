-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2017 at 09:19 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jupmsm_v3`
--

-- --------------------------------------------------------

--
-- Table structure for table `amount`
--

CREATE TABLE `amount` (
  `id` int(11) NOT NULL,
  `credit` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE `course_list` (
  `id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_title` varchar(75) NOT NULL,
  `description` text NOT NULL,
  `credit` varchar(10) NOT NULL,
  `prerequ_1` varchar(10) NOT NULL,
  `prerequ_2` varchar(10) NOT NULL,
  `cost` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_list`
--

INSERT INTO `course_list` (`id`, `course_code`, `course_title`, `description`, `credit`, `prerequ_1`, `prerequ_2`, `cost`) VALUES
(1, 'cse-290', 'CSE Descrere', 'hhhhh', '3', 'null', 'null', ''),
(2, 'CSE-101', 'Computer Fundamentals', 'Computer Fundamentals', '1', '3', 'null', ''),
(3, 'CSE 109', 'Descrete', 'hi', '3', 'null', 'null', ''),
(4, 'CSE-203', 'Database Analysis', 'Database Analysis', '3', '1', 'null', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `course_offer`
--

CREATE TABLE `course_offer` (
  `id` int(11) NOT NULL,
  `year` varchar(10) NOT NULL,
  `semester` varchar(75) NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `time_slot` varchar(10) NOT NULL,
  `day` varchar(10) NOT NULL,
  `section` varchar(10) NOT NULL,
  `amount` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_offer`
--

INSERT INTO `course_offer` (`id`, `year`, `semester`, `course_id`, `teacher_id`, `sem_id`, `time_slot`, `day`, `section`, `amount`) VALUES
(1, '2017', '1', 1, 1, 1, '13:01', 'sat', '', '3000'),
(2, '2017', '1', 2, 1, 2, '12:20', 'sun', '', '2000'),
(7, '2017', '1', 2, 1, 1, '2:30', 'sun', '', '6000'),
(6, '2017', '1', 4, 1, 2, '1:30', 'sat', 'A', '300');

-- --------------------------------------------------------

--
-- Table structure for table `education_info`
--

CREATE TABLE `education_info` (
  `id` int(11) NOT NULL,
  `s_roll` varchar(50) NOT NULL,
  `degree_name` varchar(100) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `gpa` varchar(50) NOT NULL,
  `pass_year` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `rid` int(11) NOT NULL,
  `s_id` varchar(50) NOT NULL,
  `cid` varchar(50) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `year` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `biller_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`rid`, `s_id`, `cid`, `sem_id`, `year`, `semester`, `amount`, `status`, `biller_number`) VALUES
(1, '1', '4', 2, '', '1', '300', 0, ''),
(2, '2', '4', 2, '1', '1', '1', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `s_id` varchar(50) DEFAULT NULL,
  `st_name` varchar(50) DEFAULT NULL,
  `sem_id` int(11) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `course_offer_id` varchar(50) DEFAULT NULL,
  `attend` varchar(30) DEFAULT NULL,
  `ct` varchar(11) DEFAULT NULL,
  `quize` varchar(11) DEFAULT NULL,
  `assignment` varchar(11) DEFAULT NULL,
  `presentation` varchar(11) DEFAULT NULL,
  `final_exam` varchar(11) DEFAULT NULL,
  `total` int(3) DEFAULT NULL,
  `lg` varchar(30) DEFAULT NULL,
  `gp` varchar(30) DEFAULT NULL,
  `extra1` int(3) DEFAULT NULL,
  `extra2` int(3) DEFAULT NULL,
  `extra3` int(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `semester`, `year`) VALUES
(1, 'Spring', '2017'),
(2, 'Summer', '2017'),
(3, 'Fall', '2017');

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `id` int(11) NOT NULL,
  `s_id` varchar(50) NOT NULL,
  `s_name` varchar(75) NOT NULL,
  `f_name` varchar(75) NOT NULL,
  `m_name` varchar(75) NOT NULL,
  `g_name` varchar(75) NOT NULL,
  `permanent_address` text NOT NULL,
  `present_address` text NOT NULL,
  `gender` varchar(50) NOT NULL,
  `s_nid` varchar(40) NOT NULL,
  `f_nid` varchar(40) NOT NULL,
  `m_nid` varchar(40) NOT NULL,
  `g_nid` varchar(40) NOT NULL,
  `s_mobile` varchar(15) NOT NULL,
  `f_mobile` varchar(15) NOT NULL,
  `m_mobile` varchar(15) NOT NULL,
  `g_mobile` varchar(15) NOT NULL,
  `s_email` varchar(75) NOT NULL,
  `password` text NOT NULL,
  `a_year` varchar(4) NOT NULL,
  `a_sem` varchar(20) NOT NULL,
  `a_sec` varchar(20) NOT NULL,
  `a_program` varchar(20) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `cur_sem` varchar(20) NOT NULL,
  `cur_section` varchar(20) NOT NULL,
  `cur_year` varchar(4) NOT NULL,
  `studentship` varchar(5) NOT NULL,
  `experience` text NOT NULL,
  `date_of_birth` int(11) NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `form_submitted` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_profile`
--

INSERT INTO `student_profile` (`id`, `s_id`, `s_name`, `f_name`, `m_name`, `g_name`, `permanent_address`, `present_address`, `gender`, `s_nid`, `f_nid`, `m_nid`, `g_nid`, `s_mobile`, `f_mobile`, `m_mobile`, `g_mobile`, `s_email`, `password`, `a_year`, `a_sem`, `a_sec`, `a_program`, `reg_no`, `cur_sem`, `cur_section`, `cur_year`, `studentship`, `experience`, `date_of_birth`, `nationality`, `form_submitted`) VALUES
(1, '1096024', 'Demo Student', '', 'ssssss', '', 'fffff', 'gggggf', 'male', '', 'sssssssssss', '', '', 'ddddd', '', '', '', 'student@gmail.com', 'cd73502828457d15655bbd7a63fb0bc8', '2017', 'Summer', 'a', 'bsc', '', 'spring', 'a', '2017', '1', '', 0, '', 1),
(2, '1096021', 'Mithun chandra', '', '', '', '', '', '', '', '', '', '', '1740450457', '', '', '', 'adming@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2017', 'Summer', '', '', '', '', '', '', '1', '', 0, '', 0),
(3, '1096023', 'Sajid', '', '', '', '', '', '', '', '', '', '', '1740450457', '', '', '', 'teacher@gmail.com', '8d788385431273d11e8b43bb78f3aa41', '2017', 'Summer', '', '', '', '', '', '', '1', '', 0, '', 0),
(4, '1096022', 'Demo', '', '', '', '', '', '', '', '', '', '', '1740450457', '', '', '', 'teacdxher@gmail.com', '8d788385431273d11e8b43bb78f3aa41', '2017', 'Summer', '', '', '', '', '', '', '1', '', 0, '', 0),
(5, '1096030', 'Md. Raju', '', '', '', '', '', '', '', '', '', '', '01827593387', '', '', '', 'mrrajuiit@gmail.com', '690da8f3f7bef93011f4bc3dd2ff04a3', '', '', '', '', '', '', '', '', '1', '', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_profile`
--

CREATE TABLE `teacher_profile` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(75) NOT NULL,
  `permanent_address` text NOT NULL,
  `present_address` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_profile`
--

INSERT INTO `teacher_profile` (`id`, `username`, `name`, `permanent_address`, `present_address`, `mobile`, `email`, `password`, `status`) VALUES
(1, 'teacher', 'Demo Teacher', '', '', '', 'teacher@gmail.com', '8d788385431273d11e8b43bb78f3aa41', 1),
(2, 'mrraju', 'Md. Fazlyl Karim', '', '', '01827593387', 'mrrajuiit2@gmail.com', '690da8f3f7bef93011f4bc3dd2ff04a3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'Demo Admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amount`
--
ALTER TABLE `amount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_list`
--
ALTER TABLE `course_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_offer`
--
ALTER TABLE `course_offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_info`
--
ALTER TABLE `education_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
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
-- AUTO_INCREMENT for table `amount`
--
ALTER TABLE `amount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_list`
--
ALTER TABLE `course_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `course_offer`
--
ALTER TABLE `course_offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `education_info`
--
ALTER TABLE `education_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `student_profile`
--
ALTER TABLE `student_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
