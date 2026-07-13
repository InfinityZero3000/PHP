<?php

declare(strict_types=1);

require __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/functions.php';

$keyword = trim((string) ($_GET['keyword'] ?? ''));

// Bài 10: SELECT dùng Prepared Statement và tham số đặt tên.
$sql = 'SELECT id, name, email, phone, birthday
        FROM students
        WHERE name LIKE :keyword OR email LIKE :keyword
        ORDER BY id DESC';
$stmt = $conn->prepare($sql);
$stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
$stmt->execute();
$students = $stmt->fetchAll();

$pageTitle = 'Bài 10 - Prepared Statement';
require __DIR__ . '/includes/header.php';
?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <div>
        <h1 class="h3 mb-1">Bài 10 - Prepared Statement</h1>
        <div class="text-secondary">Toàn bộ truy vấn SELECT, INSERT, UPDATE và DELETE trong project đều dùng <code>prepare()</code> + <code>execute()</code>.</div>
    </div>
    <a href="list_students.php" class="btn btn-outline-primary">CRUD đầy đủ</a>
</div>

<div class="alert alert-info">
    <strong>Các file đã chuyển:</strong>
    <code>list_students_basic.php</code>, <code>list_students.php</code>,
    <code>add_student.php</code>, <code>edit_student.php</code> và <code>delete_student.php</code>.
</div>

<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form method="get" class="row g-2 align-items-end">
            <div class="col-md-8">
                <label for="keyword" class="form-label">Tìm theo tên hoặc email</label>
                <input type="search" id="keyword" name="keyword" class="form-control"
                       value="<?= e($keyword) ?>" placeholder="Ví dụ: Nguyen hoặc example.com">
            </div>
            <div class="col-md-4 d-grid">
                <button type="submit" class="btn btn-primary">Tìm bằng Prepared Statement</button>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive shadow-sm rounded">
    <table class="table table-bordered table-hover mb-0">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Ngày sinh</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($students): ?>
            <?php foreach ($students as $row): ?>
                <tr>
                    <td><?= (int) $row['id'] ?></td>
                    <td><?= e((string) $row['name']) ?></td>
                    <td><?= e((string) $row['email']) ?></td>
                    <td><?= e((string) ($row['phone'] ?? '')) ?></td>
                    <td><?= $row['birthday'] ? e(date('d/m/Y', strtotime((string) $row['birthday']))) : '-' ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5" class="text-center py-4">Không có dữ liệu phù hợp.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
