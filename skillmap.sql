-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2025 at 11:15 AM
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
-- Database: `skillmap`
--

-- --------------------------------------------------------

--
-- Table structure for table `career_interests`
--

CREATE TABLE `career_interests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_title` varchar(100) DEFAULT NULL,
  `field` varchar(100) DEFAULT NULL,
  `focus_area` varchar(150) DEFAULT NULL,
  `goal` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_title` varchar(150) NOT NULL,
  `platform` varchar(100) DEFAULT NULL,
  `course_url` varchar(255) DEFAULT NULL,
  `related_skills` text DEFAULT NULL,
  `cost_type` enum('Free','Paid') DEFAULT 'Free'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_title`, `platform`, `course_url`, `related_skills`, `cost_type`) VALUES
(1, 'Complete Web Development Bootcamp', 'Udemy', 'https://www.udemy.com/course/web-development-bootcamp/', 'HTML, CSS, JavaScript, React, Node.js', 'Paid'),
(2, 'HTML & CSS Full Course', 'YouTube', 'https://www.youtube.com/watch?v=mU6anWqZJcc', 'HTML, CSS, Web Design', 'Free'),
(3, 'JavaScript Tutorial for Beginners', 'YouTube', 'https://www.youtube.com/watch?v=W6NZfCO5SIk', 'JavaScript, Programming', 'Free'),
(4, 'React - The Complete Guide', 'Udemy', 'https://www.udemy.com/course/react-the-complete-guide/', 'React, JavaScript, Frontend Development', 'Paid'),
(5, 'Python for Everybody Specialization', 'Coursera', 'https://www.coursera.org/specializations/python', 'Python, Data Structures, Web Scraping', 'Free'),
(6, 'Data Analysis with Python', 'freeCodeCamp', 'https://www.freecodecamp.org/learn/data-analysis-with-python/', 'Python, Pandas, NumPy, Data Analysis', 'Free'),
(7, 'Excel Skills for Business Specialization', 'Coursera', 'https://www.coursera.org/specializations/excel', 'Excel, Data Analysis, Business Analytics', 'Free'),
(8, 'UI/UX Design Specialization', 'Coursera', 'https://www.coursera.org/specializations/ui-ux-design', 'Figma, Prototyping, User Research, Design Thinking', 'Paid'),
(9, 'The Complete Digital Marketing Course', 'Udemy', 'https://www.udemy.com/course/digital-marketing-course/', 'Social Media, SEO, Content Marketing, Google Analytics', 'Paid'),
(10, 'Git & GitHub Crash Course', 'YouTube', 'https://www.youtube.com/watch?v=RGOj5yH7evk', 'Git, GitHub, Version Control', 'Free'),
(11, 'SQL for Data Science', 'Coursera', 'https://www.coursera.org/learn/sql-for-data-science', 'SQL, Database, Data Querying', 'Free'),
(12, 'Java Programming Masterclass', 'Udemy', 'https://www.udemy.com/course/java-programming-masterclass/', 'Java, OOP, Spring Boot', 'Paid'),
(13, 'Machine Learning Specialization', 'Coursera', 'https://www.coursera.org/specializations/machine-learning-introduction', 'Python, Machine Learning, TensorFlow, AI', 'Paid'),
(14, 'Graphic Design Masterclass', 'Udemy', 'https://www.udemy.com/course/graphic-design-masterclass/', 'Photoshop, Illustrator, Branding, Design', 'Paid'),
(15, 'Communication Skills for Professionals', 'LinkedIn Learning', 'https://www.linkedin.com/learning/paths/communication-skills', 'Communication, Presentation, Public Speaking', 'Paid'),
(16, 'Docker and Kubernetes Complete Guide', 'Udemy', 'https://www.udemy.com/course/docker-kubernetes/', 'Docker, Kubernetes, DevOps, Cloud', 'Paid'),
(17, 'Node.js Tutorial for Beginners', 'YouTube', 'https://www.youtube.com/watch?v=TlB_eWDSMt4', 'Node.js, JavaScript, Backend Development', 'Free'),
(18, 'Cybersecurity Fundamentals', 'edX', 'https://www.edx.org/learn/cybersecurity', 'Network Security, Ethical Hacking, Security', 'Free'),
(19, 'Adobe Premiere Pro CC Course', 'Udemy', 'https://www.udemy.com/course/adobe-premiere-pro-cc-course/', 'Premiere Pro, Video Editing, Post Production', 'Paid'),
(20, 'Agile Project Management', 'Coursera', 'https://www.coursera.org/learn/agile-project-management', 'Agile, Scrum, Project Management, Jira', 'Free');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `organization` varchar(150) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_title` varchar(150) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `location` varchar(100) DEFAULT 'Remote',
  `required_skills` text DEFAULT NULL,
  `exp_level` enum('Fresher','Junior','Mid','Senior') DEFAULT 'Fresher',
  `job_type` enum('Internship','Part-time','Full-time','Freelance') DEFAULT 'Full-time',
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_title`, `company_name`, `location`, `required_skills`, `exp_level`, `job_type`, `description`, `created_at`) VALUES
(1, 'Frontend Developer', 'TechBangla', 'Dhaka', 'HTML,CSS,JavaScript,React', 'Fresher', 'Full-time', 'Develop and maintain responsive web applications using modern frontend technologies.', '2025-11-12 18:28:25'),
(2, 'Backend Developer', 'CodeHub', 'Chattogram', 'PHP,MySQL,Laravel,APIs', 'Junior', 'Full-time', 'Build and maintain backend systems and APIs for web applications.', '2025-11-12 18:28:25'),
(3, 'UI/UX Designer', 'Creative Minds', 'Khulna', 'Figma,Adobe XD,Prototyping,Wireframing', 'Fresher', 'Internship', 'Design user interfaces and experiences for web and mobile applications.', '2025-11-12 18:28:25'),
(4, 'Data Analyst', 'DataWorks', 'Rajshahi', 'Excel,SQL,Python,Tableau', 'Mid', 'Part-time', 'Analyze business data and provide insights to support decision making.', '2025-11-12 18:28:25'),
(5, 'Mobile App Developer', 'AppSolutions', 'Barishal', 'Flutter,Dart,Firebase,APIs', 'Junior', 'Full-time', 'Develop cross-platform mobile applications with Flutter and Firebase.', '2025-11-12 18:28:25'),
(6, 'Digital Marketing Intern', 'MarketPro', 'Rangpur', 'SEO,Google Ads,Content Marketing,Social Media', 'Fresher', 'Internship', 'Assist in digital marketing campaigns and social media management.', '2025-11-12 18:28:25'),
(7, 'QA Tester', 'QualitySoft', 'Sylhet', 'Manual Testing,Automation Testing,Selenium,Bug Tracking', 'Fresher', 'Part-time', 'Perform software testing and quality assurance for applications.', '2025-11-12 18:28:25'),
(8, 'Full Stack Developer', 'WebCraft', 'Mymensingh', 'HTML,CSS,JavaScript,Node.js,Express,MongoDB', 'Mid', 'Full-time', 'Build full stack web applications with modern technologies.', '2025-11-12 18:28:25'),
(9, 'Graphic Designer', 'DesignHub', 'Dhaka', 'Photoshop,Illustrator,InDesign,Branding', 'Junior', '', 'Create graphics and visual content for clients and campaigns.', '2025-11-12 18:28:25'),
(10, 'Content Writer', 'WriteSmart', 'Chattogram', 'Writing,SEO,Research,WordPress', 'Fresher', 'Part-time', 'Produce high-quality written content for blogs and websites.', '2025-11-12 18:28:25'),
(11, 'DevOps Engineer', 'CloudOps', 'Khulna', 'AWS,Docker,Kubernetes,CI/CD', 'Senior', 'Full-time', 'Manage cloud infrastructure and deployment pipelines.', '2025-11-12 18:28:25'),
(12, 'Social Media Manager', 'BrandBuzz', 'Rajshahi', 'Facebook,Instagram,Analytics,Content Creation', 'Junior', 'Full-time', 'Manage social media accounts and content strategy for clients.', '2025-11-12 18:28:25'),
(13, 'Python Developer', 'AI Solutions', 'Barishal', 'Python,Django,Flask,APIs', 'Mid', 'Full-time', 'Develop web applications and backend systems using Python frameworks.', '2025-11-12 18:28:25'),
(14, 'Customer Support Executive', 'SupportHub', 'Rangpur', 'Communication,CRM,Problem Solving,Email Handling', 'Fresher', 'Part-time', 'Assist customers and handle queries efficiently via email and chat.', '2025-11-12 18:28:25'),
(15, 'UI Designer', 'CreativeLabs', 'Sylhet', 'Figma,Sketch,Adobe XD,Prototyping', 'Junior', 'Internship', 'Design modern and intuitive user interfaces for web and mobile apps.', '2025-11-12 18:28:25'),
(16, 'Marketing Analyst', 'MarketIntel', 'Mymensingh', 'Excel,PowerBI,Data Analysis,Reporting', 'Mid', 'Full-time', 'Analyze marketing data and provide actionable insights to management.', '2025-11-12 18:28:25'),
(17, 'WordPress Developer', 'WebBuilders', 'Dhaka', 'PHP,WordPress,HTML,CSS', 'Fresher', 'Full-time', 'Develop and maintain WordPress websites for various clients.', '2025-11-12 18:28:25'),
(18, 'Mobile QA Tester', 'AppTesters', 'Chattogram', 'Manual Testing,Appium,Bug Tracking,Reporting', 'Junior', 'Part-time', 'Test mobile applications for bugs and performance issues.', '2025-11-12 18:28:25'),
(19, 'Project Manager', 'TechBangla', 'Khulna', 'Agile,Scrum,Communication,Planning', 'Senior', 'Full-time', 'Manage software development projects and coordinate teams.', '2025-11-12 18:28:25'),
(20, 'Intern Frontend Developer', 'CodeStart', 'Rajshahi', 'HTML,CSS,JavaScript,React', 'Fresher', 'Internship', 'Learn and assist in frontend development tasks for web applications.', '2025-11-12 18:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `skill_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `user_id`, `skill_name`) VALUES
(1, 1, 'HTML'),
(3, 1, 'CSS'),
(1, 1, 'HTML'),
(3, 1, 'CSS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `edu_level` varchar(100) DEFAULT NULL,
  `experience_level` enum('Fresher','Junior','Mid','Senior') DEFAULT 'Fresher',
  `preferred_track` varchar(100) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT '../Image/placeholder-image-person-jpg.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `phone`, `location`, `password`, `edu_level`, `experience_level`, `preferred_track`, `profile_photo`, `created_at`) VALUES
(1, 'Sazid Mahmud Emon', 'sazid.bsmru.cse1@gmail.com', '01408495612', 'Kishorejang, Dhaka', '$2y$10$kiFr7Xk466j.hZjvqCfqluErDWMmoHA.0yrubDLQMV8C/A8IYx8RO', 'Undergraduate', 'Junior', 'Web Development', 'placeholder-image-person-jpg.jpg', '2025-11-12 09:44:57'),
(2, 'Abdullah Al Mahmud', 'limon1230987@gmail.com', NULL, NULL, '$2y$10$N0RZvYPgXMoeqGX5mgATBuE2RQRXTBTtMt8cPFMy7OR4xKiF880By', 'HSC', 'Junior', 'Data Science', '../Image/placeholder-image-person-jpg.jpg', '2025-11-12 09:48:17'),
(3, 'Hasib Sarker', 'muizdhrubocse30@gmail.com', NULL, NULL, '$2y$10$5WcV1yO/WtzlXPhYzlySZONp0nH/ps1dQqninpT3DtWGzqC3xuLji', 'HSC', 'Junior', 'Data Science', '../Image/placeholder-image-person-jpg.jpg', '2025-11-12 10:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_cv`
--

CREATE TABLE `user_cv` (
  `cv_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cv_text` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_cv`
--
ALTER TABLE `user_cv`
  ADD PRIMARY KEY (`cv_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_cv`
--
ALTER TABLE `user_cv`
  MODIFY `cv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_cv`
--
ALTER TABLE `user_cv`
  ADD CONSTRAINT `user_cv_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
