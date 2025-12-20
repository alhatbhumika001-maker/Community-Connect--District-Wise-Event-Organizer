
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



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
(3, 5, 4, 8, 'Satyameva Jayate..', '2025-12-11 06:30:32');

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
(11, 'Green Warriors', 'Environment', NULL, 'public', 'image/green_warriors.jpg', 'Pune', 'Community focused on cleanliness, tree plantation, and environmental awareness.', '2025-12-18 11:59:50', 1),
(12, 'Women Rise', 'Social', 'Women Empowerment', 'public', 'image/women_rise.jpg', 'Mumbai', 'A community dedicated to empowering women through education and leadership.', '2025-12-18 11:59:50', 2),
(13, 'Life Savers', 'Health', NULL, 'public', 'image/life_savers.jpg', 'Nagpur', 'Community organizing blood donation and health awareness camps.', '2025-12-18 11:59:50', 3),
(14, 'Skill India', 'Education', 'Technology', 'public', 'image/skill_india.jpg', 'Online', 'Community for youth skill development, coding, and career guidance.', '2025-12-18 11:59:50', 1),
(15, 'Fit India Club', 'Sports', NULL, 'public', 'image/fit_india.jpg', 'Aurangabad', 'Community promoting fitness, sports activities, and healthy lifestyle.', '2025-12-18 11:59:50', 3),
(16, 'Youth Connect', 'Social', NULL, 'public', 'image/youth_connect.jpg', 'Nashik', 'Community for youth engagement, volunteering, and leadership activities.', '2025-12-18 11:59:50', 2),
(17, 'Tech Learners Hub', 'Education', 'Programming', 'private', 'image/tech_learners.jpg', 'Pune', 'Private community for students learning programming and new technologies.', '2025-12-18 11:59:50', 1),
(18, 'Helping Hands', 'Social Work', NULL, 'public', 'image/helping_hands.jpg', 'Mumbai', 'Community involved in social service and helping underprivileged people.', '2025-12-18 11:59:50', 2);


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
  `image` varchar(255) DEFAULT 'default_event.jpg',
  `event_type` varchar(150) NOT NULL,
  `location` varchar(255) NOT NULL,
  `about` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `Community` int(11) DEFAULT NULL,
  `event_code` varchar(50) DEFAULT NULL,
  `privacy` varchar(10) NOT NULL DEFAULT 'public',
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_events`
--

INSERT INTO `community_events` (`id`, `event_name`, `category`, `other_category`, `district`, `start_time`, `end_time`, `date`, `image`, `event_type`, `location`, `about`, `created_at`, `created_by`, `Community`, `event_code`, `privacy`, `details`) VALUES
(14, 'Clean India Drive', 'Social Work', NULL, 'Pune', '07:00:00', '10:00:00', '2025-01-05', 'image/clean_india.jpg', 'Offline', 'JM Road, Pune', 'A cleanliness drive to promote hygiene and public awareness.', '2025-12-18 11:37:12', 1, 1, 'EVT001', 'public', 'Cleaning kits will be provided to volunteers.'),
(15, 'Tree Plantation Program', 'Environment', NULL, 'Nashik', '08:00:00', '11:00:00', '2025-01-08', 'image/tree_plantation.jpg', 'Offline', 'College Road, Nashik', 'Tree plantation event to support green environment.', '2025-12-18 11:37:12', 2, 2, 'EVT002', 'public', 'Participants should carry water bottles.'),
(16, 'Blood Donation Camp', 'Health', NULL, 'Nagpur', '09:00:00', '16:00:00', '2025-01-12', 'image/blood_donation.jpg', 'Offline', 'Civil Hospital, Nagpur', 'Blood donation camp with certified medical staff.', '2025-12-18 11:37:12', 3, 3, 'EVT003', 'public', 'Free health check-up available.'),
(17, 'Women Empowerment Workshop', 'Seminar', NULL, 'Mumbai', '10:00:00', '14:00:00', '2025-01-15', 'image/women_empowerment.jpg', 'Offline', 'Andheri East, Mumbai', 'Workshop focusing on women safety and leadership.', '2025-12-18 11:37:12', 2, 2, 'EVT004', 'public', 'Certificates will be given to participants.'),
(18, 'Youth Skill Development Webinar', 'Education', 'Technology', 'Online', '18:00:00', '20:00:00', '2025-01-18', 'image/skill_webinar.jpg', 'Online', 'Google Meet', 'Online webinar for youth skill development.', '2025-12-18 11:37:12', 1, 1, 'EVT005', 'private', 'Meeting link will be shared after registration.'),
(19, 'Community Sports Meet', 'Sports', NULL, 'Aurangabad', '06:30:00', '12:00:00', '2025-01-22', 'image/sports_meet.jpg', 'Offline', 'City Sports Ground, Aurangabad', 'Sports activities to promote fitness and teamwork.', '2025-12-18 11:37:12', 3, 3, 'EVT006', 'public', 'Sports kits will be provided.');

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
(6, 10, 4, '2025-12-17 08:25:50', 'approved', 0);

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
(6, 2, 1, '', 'Creating effective international fashion community post descriptions requires a focus on authentic connection, shared global values, and engaging visual storytelling. These posts serve as digital platforms where fashion is not just displayed but discussed and democratized among global participants.', 1, '2025-12-11 06:18:10', 0);

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
(1, 6, 7, 'Dholida Garba Night – Navratri Special', 'Seema Jitendra Patil', 'seema1234@gmail.com', '1234567890', 'event_registration_id/1765615835_id1.jpg', 'jalgaon', 'KCE-NAVRATRI-2025-XX99', '2026-10-07', '10:00:00', 'Collage Auditorium, KCE Collage Jalgaon 425001', 'pending', '2025-12-13 08:50:35'),
(2, 6, 3, 'Career Fairs & Networking Event ', 'Nikita Jitendra Patil', 'seema@gmail.com', '1234567890', 'event_registration_id/1765617037_id1.jpg', 'mumbai', NULL, '2026-01-31', '08:00:00', '', 'approved', '2025-12-13 09:10:37'),
(3, 3, 2, 'PM Sabha Prime Minister’s Modi ', 'ABCD', 'abc@gmail.com', '0987654321', 'event_registration_id/1765642993_id1.jpg', 'mumbai', NULL, '2026-01-06', '09:00:00', '', 'pending', '2025-12-13 16:23:13');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `communities`
--
ALTER TABLE `communities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `community_events`
--
ALTER TABLE `community_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `community_members`
--
ALTER TABLE `community_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `community_events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Defult Admin
INSERT INTO `users` (`user_id`, `full_name`, `username`, `email`, `password`, `confirm_password`, `role`, `district`, `bio`, `created_at`) VALUES
(7, 'Bhumika', 'bhumika01', 'santoshalhat1405@gmail.com', '123456', '123456', 'volenteer', 'Pune', 'Hello I am Bhumika', '2025-12-18 11:14:03'),

(9, 'Nikita', 'nikita01', 'nikita@gmail.com', '123456', '123456', 'user', 'organizer', 'Hello I am Nikita', '2025-12-18 11:14:03');


INSERT INTO `users` (`user_id`, `full_name`, `username`, `email`, `password`, `confirm_password`, `role`, `district`, `bio`, `created_at`) VALUES (NULL, 'Akanksha Sheet', 'akanksha', 'dummy234765@gmail.com', '123', '123', 'admin', 'pune', 'I am the default admin ', current_timestamp());





