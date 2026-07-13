<?php

declare(strict_types=1);

require __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf($_POST['csrf_token'] ?? null)) {
        http_response_code(419);
        exit('CSRF token không hợp lệ.');
    }

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
} else {
    // Hỗ trợ đúng kiểu đường dẫn trong PDF: delete_student.php?id=...
    // Giao diện chính vẫn dùng POST để an toàn hơn.
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
}

if (!$id) {
    setFlash('danger', 'ID sinh viên không hợp lệ.');
    redirect('list_students.php');
}

$stmt = $conn->prepare('DELETE FROM students WHERE id = :id');
$stmt->execute(['id' => $id]);

if ($stmt->rowCount() > 0) {
    setFlash('success', 'Đã xóa sinh viên.');
} else {
    setFlash('warning', 'Không tìm thấy sinh viên cần xóa.');
}

redirect('list_students.php');
