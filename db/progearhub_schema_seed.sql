-- ProGear Hub Database Schema
-- This file creates the database and tables needed for the ProGear Hub application
-- Run this file in phpMyAdmin or MySQL command line to set up the database

-- Create the database if it doesn't exist
-- CHARACTER SET utf8mb4 supports full Unicode including emojis and special characters
-- COLLATE utf8mb4_unicode_ci provides case-insensitive sorting and comparison
CREATE DATABASE IF NOT EXISTS ProGearHub
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Switch to the ProGearHub database for subsequent operations
USE ProGearHub;

-- Contact form submissions table
-- Stores messages submitted through the contact form
CREATE TABLE IF NOT EXISTS contact_us (
  id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each contact submission
  name VARCHAR(100) NOT NULL,         -- Customer's name (max 100 characters)
  email VARCHAR(255) NOT NULL,        -- Customer's email address (max 255 characters)
  subject VARCHAR(100) NOT NULL,      -- Subject/topic of the message (max 100 characters)
  message TEXT NOT NULL,              -- The actual message content (unlimited length)
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- When the message was submitted (auto-filled)
) ENGINE=InnoDB;  -- InnoDB engine supports transactions and foreign keys

-- Orders table
-- Stores customer orders placed through the order form
CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each order
  customer_name VARCHAR(100) NOT NULL,  -- Customer's name (max 100 characters)
  email VARCHAR(255) NOT NULL,          -- Customer's email address (max 255 characters)
  product_name VARCHAR(150) NOT NULL,   -- Name of the product being ordered (max 150 characters)
  quantity INT NOT NULL,                -- Number of items ordered (must be positive integer)
  price DECIMAL(10,2) NOT NULL,         -- Unit price with 2 decimal places (e.g., 99.99)
  total_price DECIMAL(10,2) GENERATED ALWAYS AS (quantity * price) STORED,  -- Calculated total (auto-computed)
  order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- When the order was placed (auto-filled)
) ENGINE=InnoDB;  -- InnoDB engine supports transactions and foreign keys
