<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 20</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
$cookieName = 'user_name_lab20';

if (isset($_GET['clear'])) {
    setcookie($cookieName, '', time() - 3600, '/');
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    if ($name !== '') {
        setcookie($cookieName, $name, [
            'expires' => time() + 30 * 24 * 3600,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        header('Location: index.php');
        exit;
    }
}

$name = $_COOKIE[$cookieName] ?? '';
?>
<h1>Bài 20: Ghi nhớ tên</h1>
<?php if ($name !== ''): ?>
    <div class="success">Chào lại bạn, <?= htmlspecialchars($name) ?>!</div>
    <p><a href="?clear=1">Xóa tên đã lưu</a></p>
<?php else: ?>
    <form method="post">
        <label for="name">Tên của bạn</label>
        <input id="name" name="name" required>
        <input type="submit" value="Ghi nhớ">
    </form>
<?php endif; ?>

</div>
</body>
</html>
