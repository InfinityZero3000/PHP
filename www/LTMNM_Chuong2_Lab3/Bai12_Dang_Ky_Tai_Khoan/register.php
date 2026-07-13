<?php
require 'config.php';

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
    echo 'Dữ liệu không hợp lệ';
    exit;
}

$stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
$stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);

echo 'Đăng ký thành công';
?>
