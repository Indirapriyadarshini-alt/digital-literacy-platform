-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2026 at 06:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_literacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `module_id`, `title`, `content`, `video`) VALUES
(1, 1, 'What is Digital Literacy', 'Digital literacy means using mobile and internet easily', 'videos/digital1.mp4'),
(2, 1, 'Types of Devices', 'Smartphone, tablet, laptop basics', 'videos/device.mp4'),
(3, 1, 'Basic Phone Usage', 'Tap, swipe, open apps', 'videos/phone.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `description_te` text DEFAULT NULL,
  `description_hi` text DEFAULT NULL,
  `video_link` varchar(200) NOT NULL,
  `video_link_te` varchar(255) DEFAULT NULL,
  `video_link_hi` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `description`, `description_te`, `description_hi`, `video_link`, `video_link_te`, `video_link_hi`, `thumbnail`) VALUES
(1, 'Basic Phone Usage', 'Learn how to use a smartphone, make calls, save contacts, and use basic apps.', 'Telugu version', 'Hindi version', 'videos/mobile.mp4', NULL, NULL, 'assets/mobile.png'),
(2, 'Digital Payments', 'Learn how to use UPI, scan QR codes, and safely send or receive money online.', NULL, NULL, 'videos/payment.mp4', NULL, NULL, 'assets/payment.png'),
(3, 'Internet Basics', 'Learn how to browse the internet, search on Google, and use online services.', NULL, NULL, 'videos/internet.mp4', NULL, NULL, 'assets/internet.png'),
(4, 'Women Safety', 'Learn how to stay safe online and offline, use emergency contacts, and protect personal information.', NULL, NULL, 'videos/women_safety.mp4', NULL, NULL, 'assets/women_safety.png'),
(5, 'Earning Skills', 'Learn basic online earning methods, small business ideas, and how to use mobile for income.', NULL, NULL, 'videos/earning.mp4', NULL, NULL, 'assets/earning.png');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `option1` varchar(100) DEFAULT NULL,
  `option2` varchar(100) DEFAULT NULL,
  `option3` varchar(100) DEFAULT NULL,
  `option4` varchar(100) DEFAULT NULL,
  `correct_answer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `lesson_id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_answer`) VALUES
(1, 1, 'What is digital literacy?', 'Using mobile', 'Cooking', 'Driving', 'Reading', 'Using mobile'),
(2, 2, 'Which is a device?', 'Car', 'Phone', 'Chair', 'Table', 'Phone'),
(3, 3, 'Tap means?', 'Touch screen', 'Sleep', 'Run', 'Jump', 'Touch screen'),
(4, 1, ' What is used to make a phone call?', 'Camera', 'Dialer', 'Gallery', 'Music', ' Dialer'),
(5, 1, 'Where are contacts saved?', 'Contacts App', 'Calculator', 'Settings', 'Play Store', 'Contacts App'),
(6, 1, 'Which app is used to take photos?', 'Camera', 'Gallery', 'Maps', 'Dialer', 'Camera'),
(7, 1, 'Which app stores your photos?', 'Camera', 'Gallery', 'Contacts', 'Music', 'Gallery'),
(8, 1, ' What is used to listen to songs?', 'Dialer', 'Music App', 'Contacts', '\r\nSettings', 'Music App'),
(9, 1, 'Which app is used to find locations?', 'Maps', 'Gallery', 'Dialer', 'Music', 'Maps'),
(10, 1, 'Where do you install apps from?', 'Play Store', 'Camera', 'Messages', 'Contacts', 'Play Store'),
(11, 1, 'Which app is used to change phone settings?', 'Settings', 'Music', 'Camera', 'Maps', 'Settings'),
(12, 1, 'What is used to save phone numbers?', 'Contacts', 'Gallery', 'Music', 'Maps', 'Contacts');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `language` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `language`) VALUES
(1, 'k.Indira Priyadarshini', 'ikavvampalli@gmail.com', '1234', 'English'),
(2, 'Ramesh', 'rameshkavvampalli@gmail.com', '$2y$10$12mn79fiI7IeqXwdVY6nd.a0NTdFc.qqX0J.K2V3CL1sAMYTKJUim', 'English'),
(3, 'laxmi', 'laxmikavvampalli@gmail.com', '$2y$10$NsOq5XNp7xFkX3TJi/n.9.IWxmVOWm75Uud3Qwazn3bHldl8Lp2k2', 'English'),
(4, 'vishruthi', 'vishruthigurram@gmail.com', '$2y$10$xjOiprCdPMEo1qb1hkhwZ.HpwO.etce6aF3W5TkdWV70TMGzKOsfG', 'English'),
(5, 'bhushani', 'bhushani@gmail.com', '$2y$10$Cq7C7dKnbR9xl8PuQ3SoHeY974YYLz9bpiQyfgUadh4CbLqfXdm6C', 'English'),
(6, 'indira', 'indira@gmail.com', '$2y$10$ylHWU5BY7uBUbkoONmzOf.BQlN7FSt9gIb702bBfaG21ngPpsUPyi', 'English'),
(7, 'vishruthi', 'vishu@gmail.com', '$2y$10$.OlyX39tcP2VbqkbnLi1puQjbGBrBmvtlYiwmF0fm6L.ywwbWA8hS', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `user_progress`
--

CREATE TABLE `user_progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `completed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_progress`
--

INSERT INTO `user_progress` (`id`, `user_id`, `module_id`, `completed`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 2, 2, 1),
(4, 5, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_progress`
--
ALTER TABLE `user_progress`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_progress`
--
ALTER TABLE `user_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
