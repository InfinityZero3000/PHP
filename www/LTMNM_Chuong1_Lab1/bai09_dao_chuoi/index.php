<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 09</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
function reverseUnicode(string $text): string
{
    return implode('', array_reverse(preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY)));
}

$input = trim($_POST['text'] ?? 'Hello');
$output = reverseUnicode($input);
?>
<h1>Bài 09: Đảo ngược chuỗi</h1>
<form method="post">
    <label for="text">Nhập chuỗi</label>
    <input id="text" name="text" value="<?= htmlspecialchars($input) ?>" required>
    <input type="submit" value="Đảo chuỗi">
</form>
<div class="result">Kết quả: <?= htmlspecialchars($output) ?></div>

</div>
</body>
</html>
