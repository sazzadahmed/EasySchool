-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2017 at 06:17 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `education`
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

--
-- Dumping data for table `amount`
--

INSERT INTO `amount` (`id`, `credit`, `amount`) VALUES
(1, '2', '2100'),
(2, '3', '2500');

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
  `prerequ_2` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_list`
--

INSERT INTO `course_list` (`id`, `course_code`, `course_title`, `description`, `credit`, `prerequ_1`, `prerequ_2`) VALUES
(1, 'cse-290', 'CSE Descrere', 'hhhhh', '3', 'null', 'null'),
(2, 'CSE-101', 'Computer Fundamentals', 'Computer Fundamentals', '1', 'null', '6'),
(3, 'CSE 109', 'Descrete', 'hi', '3', 'null', 'null'),
(4, 'CSE-203', 'Database Analysis', 'Database Analysis', '2', 'null', 'null'),
(6, 'cse432', 'Algorithms', 'ddgfdgf', '1', 'null', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `course_offer`
--

CREATE TABLE `course_offer` (
  `id` int(11) NOT NULL,
  `semester` varchar(75) NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `time_slot` varchar(10) NOT NULL,
  `day` varchar(10) NOT NULL,
  `section` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_offer`
--

INSERT INTO `course_offer` (`id`, `semester`, `course_id`, `teacher_id`, `time_slot`, `day`, `section`) VALUES
(7, '3', 2, 2, '13:59', 'sun', '1'),
(6, '3', 4, 2, '13:59', 'sat', 'A'),
(9, '3', 3, 2, '00:59', 'mon', '1');

-- --------------------------------------------------------

--
-- Table structure for table `education_info`
--

CREATE TABLE `education_info` (
  `id` int(11) NOT NULL,
  `s_id` varchar(50) NOT NULL,
  `degree_name` varchar(100) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `gpa` varchar(50) NOT NULL,
  `pass_year` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `education_info`
--

INSERT INTO `education_info` (`id`, `s_id`, `degree_name`, `group_name`, `school_name`, `gpa`, `pass_year`) VALUES
(1, '1096020', 'sss', 'eee', 'eee', 'eee', 'eeee'),
(2, '1096020', 's', 'e', 'e', 'e', 'e');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `rid` int(11) NOT NULL,
  `s_id` varchar(50) NOT NULL,
  `cid` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `biller_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`rid`, `s_id`, `cid`, `semester`, `status`, `biller_number`) VALUES
(9, '111', '3', '3', 0, ''),
(10, '111', '1', '3', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `s_id` varchar(50) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
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
  `extra3` int(3) DEFAULT NULL,
  `absent` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `s_id`, `semester`, `course_offer_id`, `attend`, `ct`, `quize`, `assignment`, `presentation`, `final_exam`, `total`, `lg`, `gp`, `extra1`, `extra2`, `extra3`, `absent`, `color`) VALUES
(40, '111', '3', '1', '1', '2', '8', '50', '2', '31', 94, 'A+', '4.00', NULL, NULL, NULL, '', 'green'),
(39, '14315173', '3', '3', '4', '8', '6', '8', '10', '22', 58, 'C+', '2.75', NULL, NULL, NULL, '', 'green'),
(37, '1096020', '3', '4', '2', '3', '11', '11', '5', '23', 55, 'C+', '2.75', NULL, NULL, NULL, '', 'green'),
(36, '14315173', '3', '2', '11', '11', '11', '11', '1', '13', 58, 'C+', '2.75', NULL, NULL, NULL, '', 'green'),
(41, '14315173', '3', '1', '3', '8', '7', '8', '6', '37', 69, 'B+', '3.25', NULL, NULL, NULL, '', 'green');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `semester` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `semester`) VALUES
(1, 'Spring-2017'),
(2, 'Summer-2017'),
(3, 'Fall-2017');

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `id` int(11) NOT NULL,
  `s_id` varchar(50) NOT NULL,
  `s_name` varchar(75) NOT NULL,
  `hall` varchar(50) NOT NULL,
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
  `form_submitted` int(1) NOT NULL,
  `image` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_profile`
--

INSERT INTO `student_profile` (`id`, `s_id`, `s_name`, `hall`, `f_name`, `m_name`, `g_name`, `permanent_address`, `present_address`, `gender`, `s_nid`, `f_nid`, `m_nid`, `g_nid`, `s_mobile`, `f_mobile`, `m_mobile`, `g_mobile`, `s_email`, `password`, `a_year`, `a_sem`, `a_sec`, `a_program`, `reg_no`, `cur_sem`, `cur_section`, `cur_year`, `studentship`, `experience`, `date_of_birth`, `nationality`, `form_submitted`, `image`) VALUES
(1, '1096020', 'Demo Student', '', '', 'ssssss', '', '', '', 'male', '', 'sssssssssss', '', '', 'ddddd', '', '', '', 'student@gmail.com', 'cd73502828457d15655bbd7a63fb0bc8', '2017', 'spring', 'a', 'bsc', '', 'spring', 'a', '2017', '1', '', 0, '', 1, ''),
(2, '1096021', 'Mithun chandra', '', '', '', '', '', '', '', '', '', '', '', '1740450457', '', '', '', 'adming@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2017', 'Summer', '', '', '', '', '', '', '1', '', 0, '', 0, ''),
(3, '1096023', 'Sajid', 'raju', '', '', '', '', '', '', '', '', '', '', '1740450457', '', '', '', 'teacher@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '2017', 'Summer', '', '', '', '', '', '', '1', '', 0, '', 0, ''),
(4, '1096022', 'Demo', '', '', '', '', '', '', '', '', '', '', '', '1740450457', '', '', '', 'teacdxher@gmail.com', '8d788385431273d11e8b43bb78f3aa41', '2017', 'Summer', '', '', '', '', '', '', '1', '', 0, '', 0, ''),
(5, '1096030', 'Md. Raju', '', '', '', '', '', '', '', '', '', '', '', '01827593387', '', '', '', 'mrrajuiit@gmail.com', '690da8f3f7bef93011f4bc3dd2ff04a3', '', '', '', '', '', '', '', '', '1', '', 0, '', 0, ''),
(22, '14315173', 'Rubayet', 'raju', 'raju', '3212312', 'grrtyr', '', '', 'male', '743000', '22131', '23123', 'ytry', '01742466564', '43432', '321231', 'ytry', 'student@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2017', 'spring', 'a', 'bsc', '', 'spring', 'a', '2017', '1', '', 0, 'bangladeshsi', 1, 'IMG_20160109_094803.jpg'),
(23, '111', 'aaa', 'raju', '', '', '', '', '', '', '', '', '', '', '01742466564', '', '', '', 'raju1@gmail.com', '03c017f682085142f3b60f56673e22dc', '', '', '', '', '', '', '', '', '1', '', 0, '', 0, ''),
(24, '112', 'Rubayet', 'raju', '', '', '', '', '', '', '', '', '', '', '14315', '', '', '', 'raju2@gmail.com', '03c017f682085142f3b60f56673e22dc', '', '', '', '', '', '', '', '', '1', '', 0, '', 0, ''),
(25, '113', 'raju', 'raju', '', '', '', '', '', '', '', '', '', '', '0174246564', '', '', '', 'raju3@gmail.com', '03c017f682085142f3b60f56673e22dc', '', '', '', '', '', '', '', '', '1', '', 0, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `core_id` varchar(1000) NOT NULL,
  `optional_id` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`id`, `program_id`, `core_id`, `optional_id`) VALUES
(1, 1, ',1,2,3', ',4,6');

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
(2, 'teacher', 'Demo', 'fhgfgf', 'ytytuyty', '9798789', 'teacher@gmail.com', '8d788385431273d11e8b43bb78f3aa41', 1),
(1, 'raju', 'Md. Fazlyl Karim', '', '', '01827593387', 'raju@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 1);

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
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `course_list`
--
ALTER TABLE `course_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `course_offer`
--
ALTER TABLE `course_offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `education_info`
--
ALTER TABLE `education_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `student_profile`
--
ALTER TABLE `student_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
