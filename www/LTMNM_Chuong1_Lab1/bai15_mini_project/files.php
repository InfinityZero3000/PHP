<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 15 - Danh sách file</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$dataFile = __DIR__ . '/data/uploads.txt';
$records = [];
if (file_exists($dataFile)) {
    foreach (file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $item = json_decode($line, true);
        if (is_array($item)) $records[] = $item;
    }
}
?>
<h1>Danh sách tập tin đã upload</h1>
<div class="nav">
    <a href="upload.php">Upload thêm</a>
    <a href="logout.php">Đăng xuất</a>
</div>
<?php if ($records): ?>
<table>
    <thead>
        <tr><th>Thời gian</th><th>Người upload</th><th>Tên file</th></tr>
    </thead>
    <tbody>
    <?php foreach (array_reverse($records) as $record): ?>
        <tr>
            <td><?= htmlspecialchars($record['time'] ?? '') ?></td>
            <td><?= htmlspecialchars($record['user'] ?? '') ?></td>
            <td>
                <a target="_blank" href="uploads/<?= rawurlencode($record['stored_name'] ?? '') ?>">
                    <?= htmlspecialchars($record['original_name'] ?? '') ?>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<div class="result">Chưa có file nào.</div>
<?php endif; ?>

</div>
</body>
</html>
