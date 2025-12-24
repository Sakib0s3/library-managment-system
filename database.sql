-- ===== Library Management System (OEL) =====
-- Create database (you may rename, but then update config.php)
CREATE DATABASE IF NOT EXISTS library_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE library_db;

-- Admin table
CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Books table
CREATE TABLE IF NOT EXISTS books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  author VARCHAR(120) NOT NULL,
  category VARCHAR(80) NOT NULL,
  status ENUM('Available','Issued') NOT NULL DEFAULT 'Available',
  notes VARCHAR(200) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contacts table (for protected Contact page)
CREATE TABLE IF NOT EXISTS contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(120) NOT NULL,
  message VARCHAR(120) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Seed admin (change later if you want)
INSERT INTO admins (username, password_hash)
VALUES ('admin', '$2b$10$xXHOPBM/FlMXQYWEPyDn5uhq2D5f6UxpNseUcbvhn1tnqJVOYAIg6')
ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash);

-- Sample books
INSERT INTO books (title, author, category, status, notes) VALUES
('Clean Code', 'Robert C. Martin', 'Programming', 'Available', 'Good for coding practice'),
('Operating System Concepts', 'Silberschatz', 'Computer Science', 'Available', ''),
('Data Structures', 'Mark Allen Weiss', 'Computer Science', 'Issued', 'Currently issued')
;
