<?php
require_once __DIR__ . '/functions.php';
$pageTitle = $pageTitle ?? 'Quản lý sinh viên';
$flash = pullFlash();
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="list_students.php">Lab 4 - PDO</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="test_connection.php">Kiểm tra kết nối</a>
            <a class="nav-link" href="exercise_10_prepared_statements.php">Bài 10</a>
            <a class="nav-link" href="exercise_11_sort_students.php">Bài 11</a>
            <a class="nav-link" href="add_student.php">Thêm sinh viên</a>
        </div>
    </div>
</nav>
<main class="container pb-5">
    <?php if ($flash): ?>
        <div class="alert alert-<?= e($flash['type'] ?? 'info') ?> alert-dismissible fade show" role="alert">
            <?= e($flash['message'] ?? '') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    <?php endif; ?>
