`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_task`
--

CREATE TABLE `admin_task` (
  `username` varchar(50) NOT NULL,
  `accepted` tinyint(1) NOT NULL default '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `admin_task`
--


-- --------------------------------------------------------

--
-- Table structure for table `group_title`
--

CREATE TABLE `group_title` (
  `group_name` varchar(50) NOT NULL,
  `group_leader` varchar(50) NOT NULL,
  PRIMARY KEY  (`group_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Dumping data for table `group_title`
--

INSERT INTO `group_title` (`group_name`, `group_leader`) VALUES
('admin', 'admin'),
('server', 'philip'),
('computer_lab_tech', 'reintje'),
('telephone_tech', 'brian'),
('admin_tech', 'lyndon');


-- --------------------------------------------------------

--
-- Table structure for table `info`
--


CREATE TABLE `info` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `groups` varchar(20) NOT NULL,
  `position` varchar(20) NOT NULL,
  `group_task` varchar(50) NOT NULL,
  `individ_task` varchar(50) NOT NULL,
  `task_status_indi` varchar(50) NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Dumping data for table `info`
--

INSERT INTO `info` (`username`, `password`, `groups`, `position`, `group_task`, `individ_task`, `task_status_indi`) VALUES
('admin', 'admin', 'admin', 'admin', '', '', ''),
('philip', '1234', 'server', 'leader', 'server_maintenace', '', ''),
('amoy', '1234', 'computer_lab_tech', 'member', '', 'network_ict_dept', '20'),
('boyit', '1234', 'computer_lab_tech', 'member', '', 'network_simlab', '60'),
('alex', 'admin', 'admin', 'admin', '', '', ''),
('lyndon', '1234', 'admin_tech', 'leader', 'admin_task', '', ''),
('reintje', '1234', 'computer_lab_tech', 'leader', 'networking', '', ''),
('brian', '1234', 'telephone_tech', 'leader', 'resolve_telephone', '', ''),
('rex', '1234', 'telephone_tech', 'member', '', '', ''),
('smith', '1234', 'admin_tech', 'member', '', '', ''),
('bryan', '1234', 'server', 'member', '', 'backup_all_files', '10'),
('mendoza', '1234', 'admin_tech', 'member', '', '', '');


-- --------------------------------------------------------

--
-- Table structure for table `messaging`
--


CREATE TABLE `messaging` (
  `ctrl_no` int(255) NOT NULL auto_increment,
  `date_send` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `to_receiver` varchar(50) NOT NULL,
  `from_sender` varchar(50) NOT NULL,
  `opened` tinyint(1) NOT NULL default '0',
  `mail_subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY  (`ctrl_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=262 ;

--
-- Dumping data for table `messaging`
--

INSERT INTO `messaging` (`ctrl_no`, `date_send`, `to_receiver`, `from_sender`, `opened`, `mail_subject`, `message`) VALUES
(260, '2009-10-15 20:26:20', 'boyit', 'reintje', 0, ' notification', 'Your leader give you task. Go to TASK to know your task.'),
(261, '2009-10-15 20:27:41', 'bryan', 'philip', 0, ' notification', 'Your leader give you task. Go to TASK to know your task.'),
(255, '2009-10-15 20:13:43', 'lyndon', 'alex', 0, ' notification', 'Administrator assigned you to be a leader. Go to TASK to know your task.'),
(256, '2009-10-15 20:13:44', 'reintje', 'alex', 1, ' notification', 'Administrator assigned you to be a leader. Go to TASK to know your task.'),
(257, '2009-10-15 20:13:44', 'philip', 'alex', 1, ' notification', 'Administrator assigned you to be a leader. Go to TASK to know your task.'),
(258, '2009-10-15 20:13:45', 'brian', 'alex', 0, ' notification', 'Administrator assigned you to be a leader. Go to TASK to know your task.'),
(259, '2009-10-15 20:26:19', 'amoy', 'reintje', 0, ' notification', 'Your leader give you task. Go to TASK to know your task.');


-- --------------------------------------------------------

--
-- Table structure for table `networking`
--

CREATE TABLE `networking` (
  `username` varchar(50) NOT NULL,
  `accepted` tinyint(1) NOT NULL default '0',
  `network_simlab` varchar(255) NOT NULL,
  `network_ict_dept` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `networking`
--

INSERT INTO `networking` (`username`, `accepted`, `network_simlab`, `network_ict_dept`) VALUES
('boyit', 1, 'working', ''),
('amoy', 1, '', 'working');

-- --------------------------------------------------------

--
-- Table structure for table `resolve_telephone`
--

CREATE TABLE `resolve_telephone` (
  `username` varchar(50) NOT NULL,
  `accepted` tinyint(1) NOT NULL default '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resolve_telephone`
--


-- --------------------------------------------------------

--
-- Table structure for table `sent_items`
--


CREATE TABLE `sent_items` (
  `ctrl_no` int(255) NOT NULL auto_increment,
  `date_send` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `to_receiver` varchar(50) NOT NULL,
  `from_sender` varchar(50) NOT NULL,
  `opened` tinyint(1) NOT NULL default '0',
  `mail_subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY  (`ctrl_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `sent_items`
--


INSERT INTO `sent_items` (`ctrl_no`, `date_send`, `to_receiver`, `from_sender`, `opened`, `mail_subject`, `message`) VALUES
(59, '2009-10-15 20:26:20', 'boyit', 'reintje', 0, ' notification', 'Your leader give you task. Go to TASK to know your task.'),
(58, '2009-10-15 20:26:19', 'amoy', 'reintje', 0, ' notification', 'Your leader give you task. Go to TASK to know your task.'),
(56, '2009-10-15 20:13:44', 'philip', 'alex', 0, ' notification', 'Administrator assigned you to be a leader. Go to TASK to know your task.'),
(57, '2009-10-15 20:13:45', 'brian', 'alex', 0, ' notification', 'Administrator assigned you to be a leader. Go to TASK to know your task.'),
(54, '2009-10-15 20:13:43', 'lyndon', 'alex', 0, ' notification', 'Administrator assigned you to be a leader. Go to TASK to know your task.'),
(55, '2009-10-15 20:13:44', 'reintje', 'alex', 0, ' notification', 'Administrator assigned you to be a leader. Go to TASK to know your task.'),
(60, '2009-10-15 20:27:41', 'bryan', 'philip', 0, ' notification', 'Your leader give you task. Go to TASK to know your task.');

-- --------------------------------------------------------

--
-- Table structure for table `server_maintenace`
--


CREATE TABLE `server_maintenace` (
  `username` varchar(50) NOT NULL,
  `accepted` tinyint(1) NOT NULL default '0',
  `backup_all_files` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `server_maintenace`
--


INSERT INTO `server_maintenace` (`username`, `accepted`, `backup_all_files`) VALUES
('bryan', 1, 'working');


-- --------------------------------------------------------

--
-- Table structure for table `task_list`
--


CREATE TABLE `task_list` (
  `taskname` varchar(50) NOT NULL,
  `ds` text NOT NULL,
  PRIMARY KEY  (`taskname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Dumping data for table `task_list`
--

INSERT INTO `task_list` (`taskname`, `ds`) VALUES
('networking', 'network all desktop computer in campus (MUST)'),
('resolve_telephone', 'resolve telephone line in ICT department'),
('server_maintenace', 'maintain server...upgrade server'),
('admin_task', 'network all computers in admin');


-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--


CREATE TABLE `user_profile` (
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `verification_code` varchar(50) NOT NULL,
  PRIMARY KEY  (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`email`, `username`, `password`, `fname`, `lname`, `verification_code`) VALUES
('aquarius_1727@yahoo.com', 'admin', 'admin', 'admin', 'admin', 'admin'),
('.....', 'alex', 'admin', 'alex', 'maureal', 'admin'),
('b', 'brian', '1234', 'brian', 'torres', '21119'),
('d', 'lyndon', '1234', 'lydon', 'baylin', '11382'),
('c', 'philip', '1234', 'philip', 'abamonga', '16298'),
('a', 'reintje', '1234', 'reintje', 'francisco', '30745');
