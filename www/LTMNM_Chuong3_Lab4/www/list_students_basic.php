<?php

declare(strict_types=1);

require __DIR__ . '/connect.php';

// Bài 10: kể cả truy vấn SELECT không có tham số cũng dùng Prepared Statement.
$stmt = $conn->prepare(
    'SELECT id, name, email, phone
     FROM students
     ORDER BY id ASC'
);
$stmt->execute();
$students = $stmt->fetchAll();
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên cơ bản</title>
</head>
<body>
<h2>Bài tập 03 + 10 - Danh sách sinh viên bằng Prepared Statement</h2>
<p><a href="list_students.php">Mở ứng dụng CRUD đầy đủ</a></p>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>SĐT</th>
    </tr>
    <?php foreach ($students as $row): ?>
        <tr>
            <td><?= (int) $row['id'] ?></td>
            <td><?= htmlspecialchars((string) $row['name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) $row['email'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) ($row['phone'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
