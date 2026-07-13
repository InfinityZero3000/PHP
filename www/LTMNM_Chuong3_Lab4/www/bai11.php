<?php

declare(strict_types=1);

require __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/functions.php';

// Không thể bind tên cột trong ORDER BY. Vì vậy phải ánh xạ qua whitelist.
$allowedSorts = [
    'name' => 'name',
    'email' => 'email',
];

$sort = (string) ($_GET['sort'] ?? 'name');
$sort = array_key_exists($sort, $allowedSorts) ? $sort : 'name';

$direction = strtolower((string) ($_GET['direction'] ?? 'asc'));
$direction = in_array($direction, ['asc', 'desc'], true) ? $direction : 'asc';

$orderColumn = $allowedSorts[$sort];
$orderDirection = strtoupper($direction);

// Bài 10 vẫn được áp dụng: truy vấn của bài 11 cũng dùng Prepared Statement.
$sql = "SELECT id, name, email, phone, birthday
        FROM students
        ORDER BY {$orderColumn} {$orderDirection}, id ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll();

function sortUrl(string $column, string $currentSort, string $currentDirection): string
{
    $nextDirection = $column === $currentSort && $currentDirection === 'asc' ? 'desc' : 'asc';

    return '?' . http_build_query([
        'sort' => $column,
        'direction' => $nextDirection,
    ]);
}

function sortSymbol(string $column, string $currentSort, string $currentDirection): string
{
    if ($column !== $currentSort) {
        return '↕';
    }

    return $currentDirection === 'asc' ? '↑' : '↓';
}

$pageTitle = 'Bài 11 - Sắp xếp sinh viên';
require __DIR__ . '/includes/header.php';
?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <div>
        <h1 class="h3 mb-1">Bài 11 - Sắp xếp theo tên hoặc email</h1>
        <div class="text-secondary">Nhấn tiêu đề cột hoặc dùng biểu mẫu để đổi cột và chiều sắp xếp.</div>
    </div>
    <a href="list_students.php" class="btn btn-outline-primary">CRUD đầy đủ</a>
</div>

<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form method="get" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label for="sort" class="form-label">Sắp xếp theo</label>
                <select id="sort" name="sort" class="form-select">
                    <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>Họ tên</option>
                    <option value="email" <?= $sort === 'email' ? 'selected' : '' ?>>Email</option>
                </select>
            </div>
            <div class="col-md-5">
                <label for="direction" class="form-label">Chiều sắp xếp</label>
                <select id="direction" name="direction" class="form-select">
                    <option value="asc" <?= $direction === 'asc' ? 'selected' : '' ?>>Tăng dần (A → Z)</option>
                    <option value="desc" <?= $direction === 'desc' ? 'selected' : '' ?>>Giảm dần (Z → A)</option>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">Sắp xếp</button>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive shadow-sm rounded">
    <table class="table table-bordered table-hover mb-0">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>
                <a class="sort-link" href="<?= e(sortUrl('name', $sort, $direction)) ?>">
                    Họ tên <?= e(sortSymbol('name', $sort, $direction)) ?>
                </a>
            </th>
            <th>
                <a class="sort-link" href="<?= e(sortUrl('email', $sort, $direction)) ?>">
                    Email <?= e(sortSymbol('email', $sort, $direction)) ?>
                </a>
            </th>
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
            <tr><td colspan="5" class="text-center py-4">Không có dữ liệu.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="alert alert-secondary mt-3 mb-0">
    Giá trị <code>sort</code> chỉ được nhận <code>name</code> hoặc <code>email</code>; giá trị <code>direction</code> chỉ được nhận <code>asc</code> hoặc <code>desc</code>.
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
