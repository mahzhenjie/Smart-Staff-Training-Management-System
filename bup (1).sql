-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2026 at 06:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bup`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `application_date` date DEFAULT curdate(),
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`application_id`, `staff_id`, `course_id`, `application_date`, `status`) VALUES
(2, 2, 1, '2026-06-09', 'Approved'),
(3, 2, 1, '2026-06-09', 'Approved'),
(4, 2, 43, '2026-06-10', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `status` enum('Present','Absent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `staff_id`, `course_id`, `attendance_date`, `status`) VALUES
(2, 2, 1, '2026-06-08', 'Present'),
(3, 2, 1, '2026-06-08', 'Present'),
(4, 2, 1, '2026-06-02', 'Present'),
(5, 2, 1, '2026-06-02', 'Present'),
(6, 2, 1, '2026-06-02', 'Present'),
(7, 2, 1, '2026-06-02', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollment_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enroll_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role` enum('Admin','Staff') DEFAULT 'Staff',
  `email` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `username`, `password`, `full_name`, `role`, `email`, `photo`) VALUES
(1, 'admin', 'admin123', 'System Administrator', 'Admin', 'admin@bup.com', NULL),
(2, 'mah', '1234', 'zhenjie', 'Staff', 'mahzhenjie@gmail.com', '1781051515_logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `training_course`
--

CREATE TABLE `training_course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `trainer` varchar(100) NOT NULL,
  `course_date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `training_course`
--

INSERT INTO `training_course` (`course_id`, `course_name`, `trainer`, `course_date`, `duration`, `description`) VALUES
(1, 'Kursus Power BI Essentials', 'INTAN', '2026-07-01', 2, 'Data analytics using Power BI'),
(2, 'Kursus Komunikasi Tersirat', 'INTAN', '2026-07-03', 2, 'Professional communication skills'),
(3, 'Kursus Ekonomi Malaysia MADANI', 'INTAN', '2026-07-05', 1, 'Economic policy and development'),
(4, 'IMMERSIVE LAB: Virtual Production & Interactive Design', 'IPPTAR', '2026-07-07', 3, 'Virtual production technology'),
(5, 'Workshop Next Gen Content Creation', 'IPPTAR', '2026-07-10', 2, 'Digital content creation'),
(6, 'Masterclass Digital Branding', 'IPPTAR', '2026-07-12', 2, 'Digital branding strategies'),
(7, 'Kursus Pengurusan Projek', 'INTAN', '2026-07-15', 3, 'Project management fundamentals'),
(8, 'Kursus Kepimpinan Berkesan', 'INTAN', '2026-07-18', 2, 'Leadership development'),
(9, 'Kursus Pengurusan Risiko', 'INTAN', '2026-07-20', 2, 'Risk management techniques'),
(10, 'Kursus Integriti Penjawat Awam', 'INTAN', '2026-07-22', 1, 'Integrity and ethics'),
(11, 'Kursus Microsoft Excel Advanced', 'INTAN', '2026-07-25', 2, 'Advanced spreadsheet skills'),
(12, 'Kursus Microsoft Word Professional', 'INTAN', '2026-07-27', 1, 'Professional document preparation'),
(13, 'Kursus Microsoft PowerPoint', 'INTAN', '2026-07-29', 1, 'Presentation design skills'),
(14, 'Kursus Database Fundamentals', 'INTAN', '2026-08-01', 3, 'Introduction to databases'),
(15, 'Kursus SQL Programming', 'INTAN', '2026-08-04', 3, 'SQL query development'),
(16, 'Kursus Web Development Basics', 'INTAN', '2026-08-07', 3, 'HTML CSS and PHP basics'),
(17, 'Kursus Cyber Security Awareness', 'INTAN', '2026-08-10', 2, 'Cybersecurity awareness'),
(18, 'Kursus Network Fundamentals', 'INTAN', '2026-08-12', 2, 'Computer networking concepts'),
(19, 'Kursus Artificial Intelligence Basics', 'INTAN', '2026-08-15', 3, 'Introduction to AI'),
(20, 'Kursus Data Visualization', 'INTAN', '2026-08-18', 2, 'Data visualization techniques'),
(21, 'Kursus Public Speaking', 'INTAN', '2026-08-20', 2, 'Public speaking confidence'),
(22, 'Kursus Effective Communication', 'INTAN', '2026-08-22', 2, 'Communication in workplace'),
(23, 'Kursus Team Building', 'INTAN', '2026-08-24', 2, 'Building effective teams'),
(24, 'Kursus Customer Service Excellence', 'INTAN', '2026-08-27', 2, 'Customer service skills'),
(25, 'Kursus Conflict Management', 'INTAN', '2026-08-30', 2, 'Managing workplace conflicts'),
(26, 'Kursus Time Management', 'INTAN', '2026-09-02', 1, 'Productivity improvement'),
(27, 'Kursus Decision Making Skills', 'INTAN', '2026-09-04', 2, 'Decision making methods'),
(28, 'Kursus Critical Thinking', 'INTAN', '2026-09-07', 2, 'Critical thinking skills'),
(29, 'Kursus Creative Problem Solving', 'INTAN', '2026-09-10', 2, 'Problem solving techniques'),
(30, 'Kursus Change Management', 'INTAN', '2026-09-12', 2, 'Managing organizational change'),
(31, 'Kursus Financial Management', 'INTAN', '2026-09-15', 3, 'Financial planning'),
(32, 'Kursus Budget Preparation', 'INTAN', '2026-09-18', 2, 'Budget development'),
(33, 'Kursus Procurement Management', 'INTAN', '2026-09-20', 2, 'Procurement procedures'),
(34, 'Kursus Governance Excellence', 'INTAN', '2026-09-22', 2, 'Good governance practices'),
(35, 'Kursus Human Resource Management', 'INTAN', '2026-09-25', 3, 'HR management principles'),
(36, 'Kursus Strategic Planning', 'INTAN', '2026-09-28', 2, 'Strategic planning process'),
(37, 'Kursus Performance Management', 'INTAN', '2026-10-01', 2, 'Performance evaluation'),
(38, 'Kursus Quality Management', 'INTAN', '2026-10-03', 2, 'Quality improvement systems'),
(39, 'Kursus Occupational Safety', 'INTAN', '2026-10-06', 2, 'Workplace safety'),
(40, 'Kursus Emergency Response', 'INTAN', '2026-10-08', 1, 'Emergency preparedness'),
(41, 'Kursus Digital Transformation', 'INTAN', '2026-10-10', 2, 'Digital transformation concepts'),
(42, 'Kursus Cloud Computing', 'INTAN', '2026-10-12', 3, 'Cloud technology introduction'),
(43, 'Kursus Big Data Analytics', 'INTAN', '2026-10-15', 3, 'Big data analysis'),
(44, 'Kursus Mobile Application Development', 'INTAN', '2026-10-18', 3, 'Mobile app development'),
(45, 'Kursus Software Testing', 'INTAN', '2026-10-21', 2, 'Software testing methods'),
(46, 'Kursus UI UX Design', 'INTAN', '2026-10-24', 2, 'User interface design'),
(47, 'Kursus Digital Marketing', 'INTAN', '2026-10-27', 2, 'Digital marketing strategies'),
(48, 'Kursus Social Media Management', 'INTAN', '2026-10-30', 2, 'Managing social media'),
(49, 'Kursus Innovation Management', 'INTAN', '2026-11-02', 2, 'Innovation practices'),
(50, 'Kursus Research Methodology', 'INTAN', '2026-11-05', 3, 'Research fundamentals');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `training_course`
--
ALTER TABLE `training_course`
  ADD PRIMARY KEY (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `training_course`
--
ALTER TABLE `training_course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `training_course` (`course_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
