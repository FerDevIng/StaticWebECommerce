CREATE DATABASE IF NOT EXISTS ProGearHub;
USE ProGearHub;

CREATE TABLE contact_us (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  subject VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
  order_id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  product_name VARCHAR(255) NOT NULL,
  quantity INT NOT NULL CHECK (quantity > 0),
  price DECIMAL(10,2) NOT NULL,
  total_price DECIMAL(10,2) GENERATED ALWAYS AS (quantity * price) STORED,
  order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO contact_us (name,email,subject,message) VALUES
('John Doe','john@example.com','Product Inquiry','Do you have mountain bikes available?'),
('Jane Smith','jane@example.com','Order Issue','I need to change my shipping address.');

INSERT INTO orders (customer_name,email,product_name,quantity,price) VALUES
('Alice Brown','alice@example.com','Running Shoes',2,59.99),
('Bob White','bob@example.com','Tennis Racket',1,89.99);