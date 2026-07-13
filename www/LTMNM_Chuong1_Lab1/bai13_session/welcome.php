<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 13 - Welcome</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<h1>Welcome</h1>
<div class="success">Xin chào, <?= htmlspecialchars($_SESSION['user']) ?>.</div>
<p><a href="logout.php">Đăng xuất</a></p>

</div>
</body>
</html>
