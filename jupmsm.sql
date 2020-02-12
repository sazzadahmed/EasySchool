--
-- Table structure for table `education_info`
--

CREATE TABLE `education_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` varchar(50) NOT NULL,
  `degree_name` varchar(100) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `gpa` varchar(50) NOT NULL,
  `pass_year` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` varchar(50) NOT NULL,
  `s_name` varchar(75) NOT NULL,
  `f_name` varchar(75) NOT NULL,
  `m_name` varchar(75) NOT NULL,
  `g_name` varchar(75) NOT NULL,
  `permanent_address` text NOT NULL,
  `present_address` text NOT NULL,
  `gender` varchar(10) NOT NULL,
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
  `cur_sem` varchar(20) NOT NULL,
  `cur_section` varchar(20) NOT NULL,
  `cur_year` varchar(4) NOT NULL,
  `reg_no` varchar(20) NOT NULL,
  `studentship` varchar(5) NOT NULL,
  `experience` text NOT NULL,
  `date_of_birth` int(11) NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `form_submitted` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_profile`
--

CREATE TABLE `teacher_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `name` varchar(75) NOT NULL,
  `permanent_address` text NOT NULL,
  `present_address` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE `course_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(10) NOT NULL,
  `course_title` varchar(75) NOT NULL,
  `description` text NOT NULL,
  `credit` varchar(10) NOT NULL,
  `prerequ_1` varchar(10) NOT NULL,
  `prerequ_2` varchar(10) NOT NULL,
  `cost` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_offer`
--

CREATE TABLE `course_offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(10) NOT NULL,
  `semester` varchar(75) NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `time_slot` varchar(10) NOT NULL,
  `day` varchar(10) NOT NULL,
  `section` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_course_offered`
--

CREATE TABLE `student_course_offered` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` varchar(50) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `course_offer_id1` int(11) NOT NULL,
  `course_offer_id2` int(11) NOT NULL,
  `course_offer_id3` int(11) NOT NULL,
  `course_offer_id4` int(11) NOT NULL,
  `course_offer_id5` int(11) NOT NULL,
  `course_offer_id6` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `course_offer_id` varchar(50) NOT NULL,
  `incourse` int(3) NOT NULL,
  `exam` int(3) NOT NULL,
  `total` int(3) NOT NULL,
  `extra1` int(3) DEFAULT NULL,
  `extra2` int(3) DEFAULT NULL,
  `extra3` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------












--
-- Dumping data for table `student_profile`
--

INSERT INTO `student_profile` (`id`,`s_name`,`s_email`, `password`,`studentship`,`form_submitted`) VALUES
(1, 'Demo Student', 'student@gmail.com', 'cd73502828457d15655bbd7a63fb0bc8', 1, 0);

--
-- Dumping data for table `student_profile`
--

INSERT INTO `teacher_profile` (`id`,`username`,`name`,`email`,`password`,`status`) VALUES
(1, 'teacher', 'Demo Teacher', 'teacher@gmail.com', '8d788385431273d11e8b43bb78f3aa41',1);

-- --------------------------------------------------------

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `name`, `password`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', 'Demo Admin', '21232f297a57a5a743894a0e4a801fc3', 1);