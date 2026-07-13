<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 19</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
$file = __DIR__ . '/note.txt';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note = trim($_POST['note'] ?? '');
    if ($note !== '') {
        $entry = date('Y-m-d H:i:s') . ' | ' . str_replace(["\r", "\n"], ' ', $note) . PHP_EOL;
        file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
        $message = 'Đã lưu ghi chú.';
    } else {
        $message = 'Vui lòng nhập nội dung.';
    }
}
$content = file_exists($file) ? file_get_contents($file) : '';
?>
<h1>Bài 19: Ứng dụng ghi chú</h1>
<form method="post">
    <label for="note">Nội dung ghi chú</label>
    <textarea id="note" name="note" rows="5" required></textarea>
    <input type="submit" value="Lưu ghi chú">
</form>
<?php if ($message): ?><div class="<?= $message === 'Đã lưu ghi chú.' ? 'success' : 'error' ?>"><?= htmlspecialchars($message) ?></div><?php endif; ?>
<h2>Các ghi chú đã lưu</h2>
<pre><?= htmlspecialchars($content ?: 'Chưa có ghi chú.') ?></pre>

</div>
</body>
</html>
