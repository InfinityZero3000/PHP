<?php

declare(strict_types=1);

require __DIR__ . '/connect.php';
$pageTitle = 'Kiểm tra kết nối PDO';
require __DIR__ . '/includes/header.php';
?>
<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="h4">Bài tập 01 - Kết nối CSDL bằng PDO</h1>
        <div class="alert alert-success mb-0">
            Kết nối thành công tới CSDL <strong><?= e(getenv('DB_NAME') ?: 'labdb') ?></strong>.
        </div>
    </div>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
