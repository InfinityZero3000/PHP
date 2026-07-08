<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả upload</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
$message = '';
$imagePath = '';
$uploadDir = __DIR__ . '/uploads';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0775, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
    $file = $_FILES['avatar'];
    $allowedMime = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $message = 'Lỗi upload, mã lỗi: ' . $file['error'];
    } elseif ($file['size'] > 5 * 1024 * 1024) {
        $message = 'Ảnh không được vượt quá 5 MB.';
    } else {
        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        if (!isset($allowedMime[$mime])) {
            $message = 'Định dạng ảnh không hợp lệ.';
        } else {
            $safeName = bin2hex(random_bytes(8)) . '.' . $allowedMime[$mime];
            $target = $uploadDir . '/' . $safeName;
            if (move_uploaded_file($file['tmp_name'], $target)) {
                $message = 'Upload thành công.';
                $imagePath = 'uploads/' . $safeName;
            } else {
                $message = 'Không thể lưu file.';
            }
        }
    }
}
?>
<h1>Kết quả upload ảnh</h1>
<div class="<?= $imagePath ? 'success' : 'error' ?>"><?= htmlspecialchars($message ?: 'Không có file được gửi.') ?></div>
<?php if ($imagePath): ?>
    <img class="preview" src="<?= htmlspecialchars($imagePath) ?>" alt="Ảnh đã upload">
<?php endif; ?>
<p><a href="upload_form.php">Upload ảnh khác</a></p>

</div>
</body>
</html>
