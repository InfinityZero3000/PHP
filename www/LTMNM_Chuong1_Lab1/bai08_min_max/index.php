<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 08</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
$arr = [5, 12, 3, 9, -2, 20];

function minMax(array $numbers): array
{
    if ($numbers === []) {
        throw new InvalidArgumentException("Mảng không được rỗng.");
    }
    return ['min' => min($numbers), 'max' => max($numbers)];
}

$result = minMax($arr);
?>
<h1>Bài 08: Tìm Min và Max</h1>
<p>Mảng: <?= implode(", ", $arr) ?></p>
<div class="result">
    Min: <?= $result['min'] ?><br>
    Max: <?= $result['max'] ?>
</div>

</div>
</body>
</html>
