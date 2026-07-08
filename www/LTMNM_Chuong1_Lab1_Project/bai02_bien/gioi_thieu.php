<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 02</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
$name = "Nguyễn Văn A";
$age = 21;
?>
<h1>Bài 02: Biến và câu giới thiệu</h1>
<div class="result">
    Xin chào, tôi là <strong><?= htmlspecialchars($name) ?></strong>,
    năm nay <strong><?= $age ?></strong> tuổi.
</div>

</div>
</body>
</html>
