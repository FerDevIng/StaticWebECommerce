<?php
require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  exit('Method Not Allowed');
}

$customer_name = trim($_POST['customer_name'] ?? '');
$email         = trim($_POST['email'] ?? '');
$product_name  = trim($_POST['product_name'] ?? '');
$quantity      = (int)($_POST['quantity'] ?? 0);
$price         = (float)($_POST['price'] ?? 0);

if ($customer_name === '' || $email === '' || $product_name === '' || $quantity < 1 || $price <= 0) {
  header('Location: ../orders.html?error=1');
  exit;
}

$stmt = $mysqli->prepare(
  'INSERT INTO orders (customer_name, email, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)'
);
$stmt->bind_param('sssii', $customer_name, $email, $product_name, $quantity, $price);
$stmt->execute();

header('Location: ../orders.html?placed=1');
exit;
