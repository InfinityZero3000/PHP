<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 16</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
$n = null;
$sum = null;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n = filter_input(INPUT_POST, 'n', FILTER_VALIDATE_INT);
    if ($n === false || $n === null || $n < 1) {
        $error = 'N phải là số nguyên dương.';
    } else {
        $sum = $n * ($n + 1) / 2;
    }
}
?>
<h1>Bài 16: Tính tổng từ 1 đến N</h1>
<form method="post">
    <label for="n">Nhập N</label>
    <input id="n" type="number" name="n" min="1" step="1" required>
    <input type="submit" value="Tính tổng">
</form>
<?php if ($sum !== null): ?><div class="result">Tổng từ 1 đến <?= $n ?> là <?= $sum ?>.</div><?php endif; ?>
<?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

</div>
</body>
</html>
