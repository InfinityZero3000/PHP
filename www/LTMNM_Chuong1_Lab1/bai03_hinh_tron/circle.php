<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả bài 03</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
$r = filter_input(INPUT_GET, 'r', FILTER_VALIDATE_FLOAT);
?>
<h1>Kết quả tính hình tròn</h1>
<?php if ($r !== false && $r !== null && $r >= 0): ?>
    <?php
    $chuVi = 2 * pi() * $r;
    $dienTich = pi() * $r * $r;
    ?>
    <div class="result">
        Bán kính: <?= htmlspecialchars((string)$r) ?><br>
        Chu vi: <?= round($chuVi, 4) ?><br>
        Diện tích: <?= round($dienTich, 4) ?>
    </div>
<?php else: ?>
    <div class="error">Vui lòng nhập bán kính hợp lệ.</div>
<?php endif; ?>
<p><a href="circle_form.php">Nhập lại</a></p>

</div>
</body>
</html>
