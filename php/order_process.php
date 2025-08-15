<?php
// php/order_process.php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  exit('Method Not Allowed');
}

require __DIR__ . '/config.php';

$customer_name = trim($_POST['customer_name'] ?? '');
$email         = trim($_POST['email'] ?? '');
$product_name  = trim($_POST['product_name'] ?? '');
$quantity      = (int)($_POST['quantity'] ?? 0);
$price         = (float)($_POST['price'] ?? 0);

$errors = [];
if ($customer_name === '' || strlen($customer_name) > 255) $errors[] = 'Invalid customer_name';
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255) $errors[] = 'Invalid email';
if ($product_name === '' || strlen($product_name) > 255) $errors[] = 'Invalid product_name';
if ($quantity < 1) $errors[] = 'Invalid quantity';
if ($price <= 0) $errors[] = 'Invalid price';

if ($errors) {
  http_response_code(422);
  echo 'Validation errors: ' . implode(', ', $errors);
  exit;
}

$sql = "INSERT INTO orders (customer_name, email, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
  http_response_code(500);
  exit('Prepare failed: ' . $mysqli->error);
}
$stmt->bind_param('sssii', $customer_name, $email, $product_name, $quantity, $price);

if ($stmt->execute()) {
  header('Location: /progear-hub/orders.html?ok=1');
  exit;
} else {
  http_response_code(500);
  echo 'Insert failed: ' . $stmt->error;
}
