-- Create database and tables for sample app
CREATE DATABASE IF NOT EXISTS library_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE library_db;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(150) DEFAULT NULL,
  year INT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- sample user: email: admin@example.com password: password123
INSERT INTO users (name, email, password) VALUES
('Admin User','admin@example.com', 'password123');

INSERT INTO books (title, author, year) VALUES
('The Great Gatsby','F. Scott Fitzgerald',1925),
('1984','George Orwell',1949),
('To Kill a Mockingbird','Harper Lee',1960);
