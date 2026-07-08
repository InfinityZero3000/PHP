<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 14</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
if (isset($_GET['del'])) {
    setcookie('remember_name', '', time() - 3600, '/');
    header('Location: remember.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    if ($name !== '') {
        setcookie('remember_name', $name, [
            'expires' => time() + 3600,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        header('Location: remember.php');
        exit;
    }
}

$name = $_COOKIE['remember_name'] ?? '';
?>
<h1>Bài 14: Cookie ghi nhớ tên</h1>
<?php if ($name !== ''): ?>
    <div class="success">Chào mừng lại, <?= htmlspecialchars($name) ?>!</div>
    <p><a href="?del=1">Xóa cookie</a></p>
<?php else: ?>
    <form method="post">
        <label for="name">Nhập tên để ghi nhớ trong 1 giờ</label>
        <input id="name" name="name" required>
        <input type="submit" value="Lưu">
    </form>
<?php endif; ?>

</div>
</body>
</html>
