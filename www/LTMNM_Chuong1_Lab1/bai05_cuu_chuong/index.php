<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 05</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<h1>Bài 05: Bảng cửu chương 2–9</h1>
<div class="card-grid">
<?php for ($i = 2; $i <= 9; $i++): ?>
    <div class="card">
        <h3>Bảng <?= $i ?></h3>
        <?php for ($j = 1; $j <= 10; $j++): ?>
            <?= $i ?> × <?= $j ?> = <?= $i * $j ?><br>
        <?php endfor; ?>
    </div>
<?php endfor; ?>
</div>

</div>
</body>
</html>
