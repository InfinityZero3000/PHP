<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả bài 12</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
$dataDir = __DIR__ . '/data';
$dataFile = $dataDir . '/data.txt';
if (!is_dir($dataDir)) mkdir($dataDir, 0775, true);

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note = trim($_POST['note'] ?? '');
    if ($note === '') {
        $message = 'Vui lòng nhập nội dung.';
    } else {
        $clean = str_replace(["\r", "\n", "|"], " ", $note);
        $line = date('Y-m-d H:i:s') . ' | ' . $clean . PHP_EOL;
        file_put_contents($dataFile, $line, FILE_APPEND | LOCK_EX);
        $message = 'Đã lưu dữ liệu.';
    }
}
$content = file_exists($dataFile) ? file_get_contents($dataFile) : '';
?>
<h1>Bài 12: Kết quả lưu file</h1>
<div class="<?= $message === 'Đã lưu dữ liệu.' ? 'success' : 'error' ?>"><?= htmlspecialchars($message) ?></div>
<h2>Toàn bộ nội dung</h2>
<pre><?= htmlspecialchars($content ?: 'Chưa có dữ liệu.') ?></pre>
<p><a href="save_form.php">Nhập thêm</a></p>

</div>
</body>
</html>
