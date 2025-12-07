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














