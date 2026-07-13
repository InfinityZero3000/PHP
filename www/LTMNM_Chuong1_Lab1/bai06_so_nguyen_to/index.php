<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 06</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
function isPrime(int $n): bool
{
    if ($n < 2) return false;
    if ($n === 2) return true;
    if ($n % 2 === 0) return false;

    for ($i = 3; $i <= sqrt($n); $i += 2) {
        if ($n % $i === 0) return false;
    }
    return true;
}

$primes = [];
for ($i = 1; $i <= 100; $i++) {
    if (isPrime($i)) $primes[] = $i;
}
?>
<h1>Bài 06: Số nguyên tố từ 1 đến 100</h1>
<div class="result"><?= implode(", ", $primes) ?></div>

</div>
</body>
</html>
