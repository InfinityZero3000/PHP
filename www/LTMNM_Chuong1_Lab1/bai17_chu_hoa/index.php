<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 17</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
function toUpperVietnamese(string $text): string
{
    return function_exists('mb_strtoupper')
        ? mb_strtoupper($text, 'UTF-8')
        : strtoupper($text);
}
$text = trim($_POST['text'] ?? '');
$result = $text !== '' ? toUpperVietnamese($text) : '';
?>
<h1>Bài 17: Chuyển chuỗi thành chữ hoa</h1>
<form method="post">
    <label for="text">Nhập chuỗi</label>
    <input id="text" name="text" value="<?= htmlspecialchars($text) ?>" required>
    <input type="submit" value="Chuyển thành chữ hoa">
</form>
<?php if ($result !== ''): ?><div class="result"><?= htmlspecialchars($result) ?></div><?php endif; ?>

</div>
</body>
</html>
