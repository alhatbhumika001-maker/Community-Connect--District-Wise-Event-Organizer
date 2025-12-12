-- Create Database
CREATE DATABASE  community_connect;
USE community_connect;

-- =========================
-- USERS TABLE
-- =========================
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    confirm_password VARCHAR(255) NOT NULL,
    role VARCHAR(100) NOT NULL,
    district VARCHAR(100) NOT NULL,
    bio VARCHAR(300) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- =========================
-- DISTRICTS TABLE
-- =========================
CREATE TABLE districts (
    district_id INT AUTO_INCREMENT PRIMARY KEY,
    district_name VARCHAR(100) NOT NULL UNIQUE
);

-- Insert default districts (you can add/remove)
INSERT INTO districts (district_name) VALUES
('Pune'),
('Mumbai'),
('Nashik'),
('Nagpur'),
('Thane'),
('Satara'),
('Kolhapur');

-- =========================
-- CATEGORIES TABLE
-- =========================
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE
);

-- Insert default categories
INSERT INTO categories (category_name) VALUES
('Cultural'),
('Sports'),
('College Event'),
('Festival'),
('Government Program'),
('Social Event');

-- =========================
-- EVENTS TABLE
-- =========================
CREATE TABLE community_events (
    id INT AUTO_INCREMENT PRIMARY KEY,

    event_name VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    other_category VARCHAR(255),

    district VARCHAR(100) NOT NULL,

    start_time TIME,
    end_time TIME,

    date DATE,

    image VARCHAR(255) DEFAULT 'default_event.jpg',

    event_type VARCHAR(150) NOT NULL,

    about TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL
);

-- =========================
-- EVENT REGISTRATION TABLE
-- =========================
CREATE TABLE registrations (
    reg_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    event_id INT,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (event_id) REFERENCES community_events(id)
);

-- =========================
-- DEFAULT ADMIN
-- =========================


-- =========================
-- DEFAULT USERS
-- =========================
INSERT INTO users 
(full_name, username, email, password, confirm_password, role, district, bio)
VALUES
('Bhumika Alhat', 'bhumika', 'bhumika@gmail.com', '123', '123', 'organizer', 'jalgaon', 'Default Organizer User'),

('Akansha Sheet', 'akansha', 'akanshasheet@gmail.com', '123', '123', 'volunteer', 'pune', 'Default Volunteer User'),

('Nikita Patil', 'nikita', 'nikitapatil@gmail.com', '123', '123', 'admin', 'mumbai', 'Default Admin User');

CREATE TABLE communities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    community_name VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    other_category VARCHAR(100),
    privacy VARCHAR(100) NOT NULL,
    image VARCHAR(255),
    district VARCHAR(100) NOT NULL,
    about VARCHAR(300),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL
);


INSERT INTO communities 
(community_name, category, other_category, privacy, image, district, about, created_by)
VALUES
('Youth Cultural Club', 'Cultural', NULL, 'Public', 'default.png', 'Pune', 'A community for cultural activities and events', 3),

('Green Earth Volunteers', 'Social Event', NULL, 'Public', 'default.png', 'Mumbai', 'A group working on environmental awareness', 2),

('Fitness & Sports Hub', 'Sports', NULL, 'Public', 'default.png', 'Nagpur', 'Sports lovers and fitness activities group', 1),

('College Innovators Forum', 'College Event', NULL, 'Private', 'default.png', 'Nashik', 'A community for college students and innovators', 1),

('Women Empowerment Group', 'Social Event', NULL, 'Public', 'default.png', 'Thane', 'Focused on women empowerment activities', 2),

('Tech Learners Community', 'Government Program', NULL, 'Public', 'default.png', 'Pune', 'Digital skills and government tech training programs', 3);


INSERT INTO community_events 
(event_name, category, other_category, district, start_time, end_time, date, image, event_type, about, created_by)
VALUES
('Ganesh Utsav Cultural Night', 'Cultural', NULL, 'Pune', '18:00:00', '22:00:00', '2025-01-20', 'default_event.jpg', 'Offline', 'Cultural performances, dance & singing', 1),

('Marathon 2025', 'Sports', NULL, 'Mumbai', '06:00:00', '10:00:00', '2025-02-15', 'default_event.jpg', 'Offline', 'Annual city marathon for all age groups', 2),

('College Tech Fest', 'College Event', NULL, 'Nagpur', '09:00:00', '18:00:00', '2025-03-10', 'default_event.jpg', 'Offline', 'A technical festival with competitions and workshops', 3),

('Tree Plantation Drive', 'Social Event', NULL, 'Thane', '08:00:00', '12:00:00', '2025-04-05', 'default_event.jpg', 'Offline', 'Community tree planting event', 2),

('Digital India Awareness Program', 'Government Program', NULL, 'Nashik', '10:00:00', '13:00:00', '2025-05-01', 'default_event.jpg', 'Offline', 'Government-run digital skills awareness session', 3),

('Women Safety Workshop', 'Social Event', NULL, 'Satara', '11:00:00', '14:00:00', '2025-06-09', 'default_event.jpg', 'Offline', 'Self-defense and safety awareness workshop', 1);















