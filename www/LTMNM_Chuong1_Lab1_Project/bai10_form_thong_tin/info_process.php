<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả bài 10</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
$isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
$hoten = trim($_POST['hoten'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$valid = $isPost && $hoten !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && $phone !== '';
?>
<h1>Thông tin đã nhận</h1>
<?php if ($valid): ?>
    <div class="result">
        Họ tên: <?= htmlspecialchars($hoten) ?><br>
        Email: <?= htmlspecialchars($email) ?><br>
        Điện thoại: <?= htmlspecialchars($phone) ?>
    </div>
<?php else: ?>
    <div class="error">Thông tin gửi lên không hợp lệ.</div>
<?php endif; ?>
<p><a href="info_form.php">Quay lại form</a></p>

</div>
</body>
</html>
