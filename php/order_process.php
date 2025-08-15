<?php
// Order Processing Script
// This file handles POST requests from the order form and stores order data in the database

// Include database configuration
// This gives us access to the $mysqli connection object
require __DIR__ . '/config.php';

// Security: Only allow POST requests
// This prevents direct access to the script via GET requests (which would cause 405 error)
// Forms should always use POST for data submission to prevent data exposure in URLs
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);  // Method Not Allowed
  exit('Method Not Allowed');
}

// Sanitize and validate form data
// trim() removes whitespace from beginning and end
// ?? '' provides empty string as fallback if the field doesn't exist
// This prevents undefined index errors
$customer_name = trim($_POST['customer_name'] ?? '');
$email         = trim($_POST['email'] ?? '');
$product_name  = trim($_POST['product_name'] ?? '');

// Type casting for numeric fields
// (int) and (float) ensure we get proper numeric types
// This prevents type-related issues in database operations
$quantity      = (int)($_POST['quantity'] ?? 0);
$price         = (float)($_POST['price'] ?? 0);

// Input validation for data integrity
// Check field lengths match database constraints
if (strlen($customer_name) > 100) {
  header('Location: ../orders.html?error=1');
  exit;
}

if (strlen($email) > 255) {
  header('Location: ../orders.html?error=1');
  exit;
}

if (strlen($product_name) > 150) {
  header('Location: ../orders.html?error=1');
  exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header('Location: ../orders.html?error=1');
  exit;
}

// Validate numeric values
if ($quantity < 1 || $quantity > 999999) {
  header('Location: ../orders.html?error=1');
  exit;
}

if ($price <= 0 || $price > 999999.99) {
  header('Location: ../orders.html?error=1');
  exit;
}

// Validation: Check if all required fields are filled and numeric values are valid
// Empty strings evaluate to false in PHP
// Quantity must be at least 1, price must be greater than 0
// This prevents invalid orders from being stored
if ($customer_name === '' || $email === '' || $product_name === '' || $quantity < 1 || $price <= 0) {
  header('Location: ../orders.html?error=1');
  exit;
}

// Database operation: Insert order data
// Using prepared statements to prevent SQL injection attacks
// The ? placeholders are replaced with actual values later
$stmt = $mysqli->prepare(
  'INSERT INTO orders (customer_name, email, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)'
);

// Bind parameters to the prepared statement
// 'sssii' means: 3 strings (s) followed by 2 integers (i)
// This is a security measure that prevents SQL injection
$stmt->bind_param('sssii', $customer_name, $email, $product_name, $quantity, $price);

// Execute the prepared statement
// This actually runs the SQL query with the provided data
$stmt->execute();

// Redirect back to order form with success message
// The ?placed=1 parameter will trigger a success message on the form page
header('Location: ../orders.html?placed=1');
exit;
