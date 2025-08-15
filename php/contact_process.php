<?php
// Contact Form Processing Script
// This file handles POST requests from the contact form and stores data in the database

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
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// Input validation for data integrity
// Check field lengths match database constraints
if (strlen($name) > 100) {
  header('Location: ../contact.html?error=1');
  exit;
}

if (strlen($email) > 255) {
  header('Location: ../contact.html?error=1');
  exit;
}

if (strlen($subject) > 100) {
  header('Location: ../contact.html?error=1');
  exit;
}

if (strlen($message) > 65535) { // TEXT field max length
  header('Location: ../contact.html?error=1');
  exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header('Location: ../contact.html?error=1');
  exit;
}

// Validation: Check if all required fields are filled
// Empty strings evaluate to false in PHP
// If any field is empty, redirect back to form with error parameter
if ($name === '' || $email === '' || $subject === '' || $message === '') {
  header('Location: ../contact.html?error=1');
  exit;
}

// Database operation: Insert contact form data
// Using prepared statements to prevent SQL injection attacks
// The ? placeholders are replaced with actual values later
$stmt = $mysqli->prepare(
  'INSERT INTO contact_us (name, email, subject, message) VALUES (?, ?, ?, ?)'
);

// Bind parameters to the prepared statement
// 'ssss' means all 4 parameters are strings (s)
// This is a security measure that prevents SQL injection
$stmt->bind_param('ssss', $name, $email, $subject, $message);

// Execute the prepared statement
// This actually runs the SQL query with the provided data
$stmt->execute();

// Redirect back to contact form with success message
// The ?sent=1 parameter will trigger a success message on the form page
header('Location: ../contact.html?sent=1');
exit;
