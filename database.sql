-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2026 at 07:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `community_connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(3, 'College Event'),
(1, 'Cultural'),
(4, 'Festival'),
(5, 'Government Program'),
(6, 'Social Event'),
(2, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `community_id`, `content`, `created_at`) VALUES
(1, 5, 1, 8, 'I Love india..', '2025-12-10 15:16:02'),
(2, 5, 6, 8, 'Yesterday is but a dream, tomorrow but a vision.', '2025-12-11 06:29:00'),
(3, 5, 4, 8, 'Satyameva Jayate..', '2025-12-11 06:30:32'),
(4, 7, 4, 4, 'Jay Mata di...', '2025-12-19 16:55:43'),
(5, 8, 4, 11, 'The best event for indian culture...', '2025-12-21 16:55:27'),
(6, 8, 1, 1, 'hello', '2025-12-22 05:47:19'),
(7, 11, 1, 16, 'hii', '2026-01-17 04:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `communities`
--

CREATE TABLE `communities` (
  `id` int(11) NOT NULL,
  `community_name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `other_category` varchar(100) DEFAULT NULL,
  `privacy` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `district` varchar(100) NOT NULL,
  `about` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `communities`
--

INSERT INTO `communities` (`id`, `community_name`, `category`, `other_category`, `privacy`, `image`, `district`, `about`, `created_at`, `created_by`) VALUES
(11, 'Bharat Utsav Community ', 'festive', '', 'public', 'image/Screenshot (607).png', 'pune', 'Bharat Utsav is a vibrant community created to celebrate the rich culture, traditions, and festivals of India. The purpose of this community is to bring together festivals from all religions, regions, and traditions and celebrate them with pride and unity.\r\n✨ “One Nation, Many Festivals” ', '2025-12-21 15:13:13', 1),
(12, 'Academic & Cultural Forum Community.', 'college-level', '', 'public', 'image/c1.jpg', 'jalgaon', 'Academic & Cultural Forum is a college-level community dedicated to promoting academic excellence and cultural engagement among students. It provides a platform where students can learn, share knowledge, and participate in cultural activities alongside their academic journey.', '2025-12-21 15:23:20', 1),
(13, 'PlayHard Community', 'sports', '', 'public', 'image/commnity4.jpg', 'pune', 'PlayHard Community is a vibrant sports community built for athletes, fans, and fitness lovers who believe in giving their best—on and off the field. We bring together people who love competition, teamwork, and an active lifestyle.', '2025-12-21 15:30:12', 4),
(14, 'Public Service Connect Community', 'governmental', '', 'public', 'image/c3.png', 'jalgaon', 'Public Service Connect brings citizens together to support government programs, share accurate information, and promote social responsibility. Our mission is to strengthen trust, communication, and collaboration within the community.', '2025-12-21 15:33:06', 4),
(15, 'Social Vibes Community', 'social', '', 'public', 'image/c4.webp', 'nashik', 'Social Vibes is all about positivity, interaction, and connection. We provide a space where people can share stories, support each other, and enjoy the power of community.', '2025-12-21 15:36:17', 6),
(16, 'Governance Circle Community', 'governmental', '', 'public', 'image/community5.webp', 'nashik', 'Governance Circle is a community that encourages informed citizen participation, policy awareness, and public accountability. We aim to strengthen trust between people and government.', '2025-12-21 15:39:26', 6);

-- --------------------------------------------------------

--
-- Table structure for table `community_events`
--

CREATE TABLE `community_events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `other_category` varchar(255) DEFAULT NULL,
  `district` varchar(100) NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `registration_deadline` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT 'default_event.jpg',
  `event_type` varchar(150) NOT NULL,
  `event_ty` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `about` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `Community` int(11) DEFAULT NULL,
  `event_code` varchar(50) DEFAULT NULL,
  `privacy` varchar(10) NOT NULL DEFAULT 'public',
  `details` text DEFAULT NULL,
  `status` enum('Upcoming','Ongoing','Completed','Cancelled') DEFAULT 'Upcoming'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_events`
--

INSERT INTO `community_events` (`id`, `event_name`, `category`, `other_category`, `district`, `start_time`, `end_time`, `date`, `registration_deadline`, `image`, `event_type`, `event_ty`, `location`, `about`, `created_at`, `created_by`, `Community`, `event_code`, `privacy`, `details`, `status`) VALUES
(7, 'Dholida Garba Night – Navratri Special', 'college-level', '', 'jalgaon', '10:00:00', '17:00:00', '2026-10-07', '2026-10-07', 'event_images/event7.jpg', 'Cultural Program', '', 'Collage Auditorium, KCE Collage Jalgaon 425001', 'A vibrant and energetic Garba night to celebrate Navratri with traditional music, dhol beats, and festive colors!', '2025-12-12 16:19:25', 4, 4, 'KCE-NAVRATRI-2025-XX99', 'private', 'Instructions\r\n🎉 Open for all age groups  (In Collage)\r\n🎟 Registration required  \r\n👗 Dress Code: Traditional Navratri Attire  \r\n\r\nLet’s come together to celebrate the spirit of Navratri with joy, music, and dance. ', 'Cancelled'),
(9, ' International Kite Festival.', 'festive', '', 'pune', '12:00:00', '17:00:00', '2026-01-01', '2026-01-14', 'event_images/e1.jpg', '', 'offline', 'Ahmedabad (Gujarat)', 'makar sankranti is a significant hindu festival known as light event bacause it makes the end of the winter solstice.', '2025-12-21 15:57:06', 1, 11, '', 'public', '!Nothing Event is Offline Mode...', 'Upcoming'),
(11, 'Career & Internship Fair. ', 'college-level', '', 'jalgaon', '10:00:00', '17:00:00', '2026-01-01', '2026-01-31', 'event_images/images.jpg', '', 'offline', 'KCE Collage (Jalgaon) ', 'This straightforward name indicates the host and the primary purpose connecting students with employers for both full time jobs and internship', '2025-12-21 16:09:29', 1, 12, '1234', 'public', '!Nothing Event is Offline Mode...', 'Cancelled'),
(12, 'Celebrate Bharat Event.', 'festive', '', 'nashik', '12:00:00', '17:00:00', '2026-02-01', '2026-02-18', 'event_images/1766334324_3-2.jpg', 'Workshop', 'offline', 'Bharat Mandapam, Pragati Maidan, New Delhi', 'Celebrate Bharat is a theme used for major ongoing cultural events, such as Bharat Kalachar\\\'s 37th Margazhi Mahotsav in Chennai, which features various music and dance performances. ', '2025-12-21 16:25:24', 1, 11, '', 'public', 'Nothing...', 'Upcoming'),
(13, 'Code Fiesta Event.', 'college-level', '', 'jalgaon', '12:00:00', '17:00:00', '2025-12-01', '2025-12-21', 'event_images/1766334625_images (1).jpg', 'Workshop', 'offline', 'KCE Collage (Jalgaon) ', 'Code Fiesta is an exciting celebration for programmers, tech enthusiasts, and innovators! Join us for a day full of coding challenges, hackathons, workshops, and networking opportunities.', '2025-12-21 16:30:25', 1, 12, 'KCE009172', 'private', 'Nothing...', 'Upcoming'),
(14, 'Game On! – Community Sports Festival', 'sports', '', 'nagpur', '10:00:00', '14:00:00', '2027-04-01', '2026-04-07', 'event_images/1766335039_s1.png', 'Sports Event', 'offline', '123 Greenfield Avenue, Riverside Park, Nagpur, 12345', 'Game On! – Community Sports Festival is an action-packed day bringing together sports enthusiasts of all ages. Participate in friendly competitions, team games, and fun challenges designed to promote fitness, teamwork, and community spirit.', '2025-12-21 16:37:19', 4, 13, '', 'public', 'Nothing....', 'Upcoming'),
(15, 'Bright Futures – Community Care Day', 'sports', '', 'nagpur', '10:00:00', '14:00:00', '2027-04-09', '2026-04-30', 'event_images/1766335280_images (2).jpg', 'Sports Event', 'offline', '123 Greenfield Avenue, Riverside Park, Pune, 44411', 'Bright Futures is a heartwarming community event dedicated to supporting underprivileged children. The day will include educational activities, fun games, storytelling, and distribution of essential supplies like books, clothes, and school kits.', '2025-12-21 16:41:20', 4, 14, '', 'public', 'Nothing....', 'Upcoming'),
(16, 'Growing Tree – Nurturing Young Minds', 'cultural', '', 'jalgaon', '10:00:00', '14:00:00', '2027-04-09', '2026-04-30', 'event_images/1766335448_e.jpg', 'Community Service', 'offline', '123 Greenfield Avenue, Riverside Park, Pune, 44411', 'Growing Tree is a community initiative focused on empowering children and fostering holistic development. Through educational activities, creative workshops, and mentorship programs, we aim to plant the seeds of knowledge, confidence, and hope.', '2025-12-21 16:44:08', 4, 14, '', 'public', 'Nothing....', 'Upcoming'),
(17, 'Together We Thrive', 'social', '', 'mumbai', '17:00:00', '20:00:00', '2025-12-11', '2025-12-21', 'event_images/1766335700_s12.jpg', 'Seminar', 'offline', 'Bharat Mandapam, Pragati Maidan, New Mumbai', 'Together We Thrive is a community-focused social event designed to bring people closer, foster connections, and celebrate unity. Join us for engaging activities, interactive workshops, and fun networking opportunities that encourage collaboration, friendship, and shared growth. Whether it’s learning, volunteering, or simply connecting, this event', '2025-12-21 16:48:20', 6, 15, '', 'public', 'Nothing...', 'Upcoming'),
(18, 'Tech Workshop - Dolida', '', NULL, 'Pune', '10:00:00', NULL, '2026-02-20', '', 'event_images/e0.jpg', 'Workshop', '', 'Dolida College Auditorium', 'Exclusive tech workshop for registered students only.', '2026-01-16 16:10:18', 1, 15, 'KCEDolida2026k', 'private', NULL, 'Upcoming');

-- --------------------------------------------------------

--
-- Table structure for table `community_members`
--

CREATE TABLE `community_members` (
  `id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved') DEFAULT 'pending',
  `created_by` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_members`
--

INSERT INTO `community_members` (`id`, `community_id`, `user_id`, `joined_at`, `status`, `created_by`) VALUES
(2, 9, 4, '2025-12-11 06:37:27', 'approved', 4),
(4, 9, 6, '2025-12-11 12:44:08', 'approved', 6),
(5, 9, 3, '2025-12-12 05:24:19', 'pending', 0),
(6, 10, 4, '2025-12-17 08:25:50', 'approved', 0),
(7, 15, 4, '2025-12-21 16:56:00', 'approved', 0),
(8, 16, 3, '2025-12-21 16:56:37', 'pending', 0),
(9, 11, 6, '2025-12-21 16:57:05', 'pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`district_id`, `district_name`) VALUES
(7, 'Kolhapur'),
(2, 'Mumbai'),
(4, 'Nagpur'),
(3, 'Nashik'),
(1, 'Pune'),
(6, 'Satara'),
(5, 'Thane');

-- --------------------------------------------------------

--
-- Table structure for table `event_cancellations`
--

CREATE TABLE `event_cancellations` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `reason_title` varchar(255) NOT NULL,
  `reason_detail` text DEFAULT NULL,
  `cancelled_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_cancellations`
--

INSERT INTO `event_cancellations` (`id`, `event_id`, `reason_title`, `reason_detail`, `cancelled_at`) VALUES
(1, 7, 'Outdated event', 'Not enter any public only for KCE collage jalgaon staff and students with id proof ', '2025-12-21 10:27:58'),
(2, 11, 'Outdated event', 'The events are outdated and make it conflicting for many user.', '2025-12-22 05:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `community_id`, `user_id`, `title`, `content`, `created_at`) VALUES
(1, 9, 1, 'PM Interaction Program – Guidelines for Attendees.', 'The PM Interaction Program is designed to facilitate meaningful engagement between participants and the Prime Minister, enabling open dialogue on key national priorities, development initiatives, and citizen-centric issues. To ensure the session is productive, respectful, and smoothly organized, attendees are expected to follow a set of guidelines throughout the program.', '2025-12-10 22:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post` varchar(300) NOT NULL,
  `content` text NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `comments` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `community_id`, `user_id`, `post`, `content`, `likes`, `created_at`, `comments`) VALUES
(3, 9, 1, 'posts_image/post1.jpg', '\"PM Sabha\" likely refers to the Prime Minister\'s role in the Indian Parliament (Sabha), which involves leading the majority in the Lok Sabha (House of the People)', 4, '2025-12-10 07:08:06', 0),
(4, 8, 1, 'posts_image/post1.jpg', '\"PM Sabha\" likely refers to the Prime Minister\'s role in the Indian Parliament (Sabha), which involves leading the majority in the Lok Sabha (House of the People)', 10, '2025-12-10 07:58:00', 0),
(5, 8, 1, 'posts_image/post2.webp', '“JAI JAWAN, JAI KISAN, JAI VIGYAN, JAI ANUSANDHAN”- SLOGANOF NEW INDIA-PM NARENDRA MODI.', 2, '2025-12-10 14:36:33', 3),
(6, 2, 1, '', 'Creating effective international fashion community post descriptions requires a focus on authentic connection, shared global values, and engaging visual storytelling. These posts serve as digital platforms where fashion is not just displayed but discussed and democratized among global participants.', 1, '2025-12-11 06:18:10', 0),
(7, 4, 4, 'posts_image/p2.webp', 'a vibrant, traditional folk dance from Gujarat, India, performed during Navratri, featuring energetic circular movements where dancers use decorated wooden sticks (dandiyas) to clap rhythms, symbolizing Goddess Durga\'s battle with the demon king Mahishasura', 1, '2025-12-19 16:54:55', 1),
(8, 11, 1, 'posts_image/2-5.jpg', 'This nine-day cultural festival was held from July 5-13, 2025, at Manezhnaya Square, showcasing Indian culture, dance, music, and yoga to a Russian audience. The event was organized by the Embassy of India in collaboration with the Moscow City Government.', 1, '2025-12-21 16:52:11', 2),
(9, 14, 4, 'posts_image/event1.jpg', 'provide essential oxygen, clean the air by absorbing pollutants, combat climate change by sequestering carbon, prevent soil erosion, provide food and medicine, cool urban areas, and offer vital habitats and resources for wildlife, making them crucial for a healthy planet and human well survival', 0, '2025-12-21 16:54:36', 0),
(10, 15, 6, 'posts_image/images (3).jpg', '\"Get ready to party! Join us for an unforgettable night\"Feeling the joy and spreading the celebration vibes. Today calls for a big smile and a bigger celebration.', 0, '2025-12-21 16:59:47', 0),
(11, 16, 1, 'posts_image/co2.jpg', '“JAI JAWAN, JAI KISAN, JAI VIGYAN, JAI ANUSANDHAN”- SLOGANOF NEW INDIA-PM NARENDRA MODI.', 1, '2026-01-17 04:22:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `id_card` varchar(255) NOT NULL,
  `district` varchar(100) NOT NULL,
  `event_code` varchar(100) DEFAULT NULL,
  `event_date` date NOT NULL,
  `start_time` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'approved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `user_id`, `event_id`, `event_name`, `name`, `email`, `phone`, `id_card`, `district`, `event_code`, `event_date`, `start_time`, `location`, `status`, `created_at`) VALUES
(1, 6, 7, 'Dholida Garba Night – Navratri Special', 'Seema Jitendra Patil', 'seema1234@gmail.com', '1234567890', 'event_registration_id/1765615835_id1.jpg', 'jalgaon', 'KCE-NAVRATRI-2025-XX99', '2026-10-07', '10:00:00', 'Collage Auditorium, KCE Collage Jalgaon 425001', 'pending', '2025-12-13 08:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `bio` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `username`, `email`, `password`, `confirm_password`, `role`, `district`, `bio`, `created_at`) VALUES
(1, 'Nikita Jitendra Patil..', 'Nikita-2007', 'nikita2007@gmail.com', '2007', '2007', 'volunteer', 'pune', 'Web Developer..', '2025-12-03 11:10:18'),
(3, 'ABCD', 'ABC1234', 'abc@gmail.com', '1234', '1234', 'volunteer', 'thane', '.......................', '2025-12-03 12:23:54'),
(4, 'Lalit Jitendra Patil', 'Lalit-2009', 'lalit2009@gmail.com', 'Lalit2009', '', 'volunteer', 'pune', '....................................', '2025-12-06 15:11:25'),
(5, 'XYZ', 'XYZ-123', 'xyz123@gmail.com', '123', '', 'volunteer', 'thane', '................', '2025-12-06 15:41:15'),
(6, 'Seema Jitendra patil', 'seema1234', 'seema1234@gmail.com', '1234', '', 'volunteer', 'pune', '....................', '2025-12-07 07:27:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `communities`
--
ALTER TABLE `communities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community_events`
--
ALTER TABLE `community_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community_members`
--
ALTER TABLE `community_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`district_id`),
  ADD UNIQUE KEY `district_name` (`district_name`);

--
-- Indexes for table `event_cancellations`
--
ALTER TABLE `event_cancellations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `communities`
--
ALTER TABLE `communities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `community_events`
--
ALTER TABLE `community_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `community_members`
--
ALTER TABLE `community_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event_cancellations`
--
ALTER TABLE `event_cancellations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_cancellations`
--
ALTER TABLE `event_cancellations`
  ADD CONSTRAINT `event_cancellations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `community_events` (`id`);

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `community_events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
