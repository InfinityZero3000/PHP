<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 13 - Đăng nhập</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
session_start();
if (!empty($_SESSION['user'])) {
    header('Location: welcome.php');
    exit;
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';

    if ($user === 'admin' && $pass === '123') {
        session_regenerate_id(true);
        $_SESSION['user'] = $user;
        header('Location: welcome.php');
        exit;
    }
    $error = 'Sai tên đăng nhập hoặc mật khẩu.';
}
?>
<h1>Bài 13: Đăng nhập bằng Session</h1>
<p class="small">Tài khoản demo: admin / 123</p>
<form method="post">
    <label for="username">Username</label>
    <input id="username" name="username" required>
    <label for="password">Password</label>
    <input id="password" type="password" name="password" required>
    <input type="submit" value="Đăng nhập">
</form>
<?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

</div>
</body>
</html>
