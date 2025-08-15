<?php
// php/contact_process.php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

require __DIR__ . '/config.php';

// Sanitización básica y validación
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

$errors = [];

// Enhanced validation
if ($name === '' || strlen($name) > 255) {
    $errors[] = 'Invalid name';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255) {
    $errors[] = 'Invalid email';
}
if ($subject === '' || strlen($subject) > 255) {
    $errors[] = 'Invalid subject';
}
if ($message === '' || strlen($message) > 1000) {
    $errors[] = 'Message is required and must be less than 1000 characters';
}

if ($errors) {
    $_SESSION['contact_errors'] = $errors;
    $_SESSION['contact_data'] = [
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'message' => $message
    ];
    header('Location: /progear-hub/contact.html?error=1');
    exit;
}

// Insert con prepared statement
$sql = "INSERT INTO contact_us (name, email, subject, message) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    $_SESSION['contact_errors'] = ['Database error: ' . $mysqli->error];
    header('Location: /progear-hub/contact.html?error=1');
    exit;
}

$stmt->bind_param('ssss', $name, $email, $subject, $message);

if ($stmt->execute()) {
    $_SESSION['contact_success'] = 'Thank you for your message! We will get back to you soon.';
    header('Location: /progear-hub/contact.html?sent=1');
    exit;
} else {
    $_SESSION['contact_errors'] = ['Failed to send message: ' . $stmt->error];
    header('Location: /progear-hub/contact.html?error=1');
    exit;
}

$stmt->close();
$mysqli->close();
?>
