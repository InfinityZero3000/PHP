<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 07</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
function areaCircle(float $r): float
{
    return pi() * $r * $r;
}
$r = 3;
?>
<h1>Bài 07: Hàm tính diện tích hình tròn</h1>
<div class="result">Diện tích hình tròn bán kính <?= $r ?> là <?= round(areaCircle($r), 4) ?>.</div>

</div>
</body>
</html>
