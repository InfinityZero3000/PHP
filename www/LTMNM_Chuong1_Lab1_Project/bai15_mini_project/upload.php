<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 15 - Upload</title>
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

$uploadDir = __DIR__ . '/uploads';
$dataDir = __DIR__ . '/data';
$dataFile = $dataDir . '/uploads.txt';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0775, true);
if (!is_dir($dataDir)) mkdir($dataDir, 0775, true);

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    if ($file['error'] === UPLOAD_ERR_OK) {
        $original = basename($file['name']);
        $safeOriginal = preg_replace('/[^A-Za-z0-9._-]/', '_', $original);
        $storedName = time() . '_' . bin2hex(random_bytes(4)) . '_' . $safeOriginal;
        $target = $uploadDir . '/' . $storedName;

        if (move_uploaded_file($file['tmp_name'], $target)) {
            $record = [
                'user' => $_SESSION['user'],
                'stored_name' => $storedName,
                'original_name' => $original,
                'time' => date('Y-m-d H:i:s'),
            ];
            file_put_contents(
                $dataFile,
                json_encode($record, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL,
                FILE_APPEND | LOCK_EX
            );
            setcookie('last_uploaded_file', $original, [
                'expires' => time() + 3600,
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
            $message = 'Upload thành công.';
        } else {
            $message = 'Không thể lưu file.';
        }
    } else {
        $message = 'Lỗi upload, mã lỗi: ' . $file['error'];
    }
}
?>
<h1>Upload tập tin</h1>
<p>Xin chào, <strong><?= htmlspecialchars($_SESSION['user']) ?></strong>.</p>
<div class="nav">
    <a href="files.php">Danh sách file</a>
    <a href="logout.php">Đăng xuất</a>
</div>
<?php if (!empty($_COOKIE['last_uploaded_file'])): ?>
    <p class="small">File upload gần nhất: <?= htmlspecialchars($_COOKIE['last_uploaded_file']) ?></p>
<?php endif; ?>
<form method="post" enctype="multipart/form-data">
    <label for="file">Chọn tập tin</label>
    <input id="file" type="file" name="file" required>
    <input type="submit" value="Upload">
</form>
<?php if ($message): ?>
    <div class="<?= $message === 'Upload thành công.' ? 'success' : 'error' ?>"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

</div>
</body>
</html>
