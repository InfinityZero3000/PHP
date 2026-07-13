<?php

declare(strict_types=1);

require __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/functions.php';

$keyword = trim((string) ($_GET['keyword'] ?? ''));
$limit = 5;
$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?: 1;
$page = max(1, $page);

$allowedSorts = [
    'id' => 'id',
    'name' => 'name',
    'email' => 'email',
    'birthday' => 'birthday',
];
$sort = (string) ($_GET['sort'] ?? 'id');
$sort = array_key_exists($sort, $allowedSorts) ? $sort : 'id';
$direction = strtolower((string) ($_GET['direction'] ?? 'desc'));
$direction = in_array($direction, ['asc', 'desc'], true) ? $direction : 'desc';

$sqlCount = 'SELECT COUNT(*) FROM students WHERE name LIKE :keyword';
$stmtCount = $conn->prepare($sqlCount);
$stmtCount->execute(['keyword' => '%' . $keyword . '%']);
$totalRecords = (int) $stmtCount->fetchColumn();
$totalPages = max(1, (int) ceil($totalRecords / $limit));
$page = min($page, $totalPages);
$offset = ($page - 1) * $limit;

$orderColumn = $allowedSorts[$sort];
$sql = "SELECT id, name, email, phone, birthday
        FROM students
        WHERE name LIKE :keyword
        ORDER BY {$orderColumn} {$direction}, id DESC
        LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$students = $stmt->fetchAll();

function queryUrl(array $changes = []): string
{
    $current = [
        'keyword' => $_GET['keyword'] ?? '',
        'sort' => $_GET['sort'] ?? 'id',
        'direction' => $_GET['direction'] ?? 'desc',
        'page' => $_GET['page'] ?? 1,
    ];

    return '?' . http_build_query(array_merge($current, $changes));
}

function nextDirection(string $column, string $currentSort, string $currentDirection): string
{
    return $column === $currentSort && $currentDirection === 'asc' ? 'desc' : 'asc';
}

$pageTitle = 'Danh sách sinh viên';
require __DIR__ . '/includes/header.php';
?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <div>
        <h1 class="h3 mb-1">Danh sách sinh viên</h1>
        <div class="text-secondary">CRUD, tìm kiếm, phân trang và sắp xếp bằng PDO.</div>
    </div>
    <a href="add_student.php" class="btn btn-success">+ Thêm sinh viên</a>
</div>

<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form method="get" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label for="keyword" class="form-label">Tìm theo tên</label>
                <input
                    type="search"
                    id="keyword"
                    name="keyword"
                    class="form-control"
                    value="<?= e($keyword) ?>"
                    placeholder="Nhập tên cần tìm"
                >
            </div>
            <div class="col-md-3">
                <label for="sort" class="form-label">Sắp xếp</label>
                <select id="sort" name="sort" class="form-select">
                    <option value="id" <?= $sort === 'id' ? 'selected' : '' ?>>ID</option>
                    <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>Họ tên</option>
                    <option value="email" <?= $sort === 'email' ? 'selected' : '' ?>>Email</option>
                    <option value="birthday" <?= $sort === 'birthday' ? 'selected' : '' ?>>Ngày sinh</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="direction" class="form-label">Thứ tự</label>
                <select id="direction" name="direction" class="form-select">
                    <option value="asc" <?= $direction === 'asc' ? 'selected' : '' ?>>Tăng dần</option>
                    <option value="desc" <?= $direction === 'desc' ? 'selected' : '' ?>>Giảm dần</option>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">Áp dụng</button>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive shadow-sm rounded">
    <table class="table table-bordered table-hover mb-0">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>
                <a class="sort-link" href="<?= e(queryUrl(['sort' => 'name', 'direction' => nextDirection('name', $sort, $direction), 'page' => 1])) ?>">
                    Họ và tên
                </a>
            </th>
            <th>
                <a class="sort-link" href="<?= e(queryUrl(['sort' => 'email', 'direction' => nextDirection('email', $sort, $direction), 'page' => 1])) ?>">
                    Email
                </a>
            </th>
            <th>Số điện thoại</th>
            <th>
                <a class="sort-link" href="<?= e(queryUrl(['sort' => 'birthday', 'direction' => nextDirection('birthday', $sort, $direction), 'page' => 1])) ?>">
                    Ngày sinh
                </a>
            </th>
            <th class="text-center">Thao tác</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($students): ?>
            <?php foreach ($students as $index => $row): ?>
                <tr>
                    <td><?= $offset + $index + 1 ?></td>
                    <td><?= e($row['name']) ?></td>
                    <td><a href="mailto:<?= e($row['email']) ?>"><?= e($row['email']) ?></a></td>
                    <td><?= e($row['phone']) ?></td>
                    <td><?= $row['birthday'] ? e(date('d/m/Y', strtotime($row['birthday']))) : '-' ?></td>
                    <td class="text-center actions">
                        <a href="edit_student.php?id=<?= (int) $row['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="delete_student.php" method="post" class="d-inline" onsubmit="return confirm('Bạn chắc chắn muốn xóa sinh viên này?')">
                            <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                            <input type="hidden" name="id" value="<?= (int) $row['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center py-4">Không có dữ liệu phù hợp.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
    <div class="text-secondary">
        Tổng: <?= $totalRecords ?> sinh viên - Trang <?= $page ?>/<?= $totalPages ?>
    </div>

    <?php if ($totalPages > 1): ?>
        <nav aria-label="Phân trang">
            <ul class="pagination mb-0">
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= e(queryUrl(['page' => 1])) ?>">Đầu</a>
                </li>
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= e(queryUrl(['page' => max(1, $page - 1)])) ?>">Trước</a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                        <a class="page-link" href="<?= e(queryUrl(['page' => $i])) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= e(queryUrl(['page' => min($totalPages, $page + 1)])) ?>">Sau</a>
                </li>
                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= e(queryUrl(['page' => $totalPages])) ?>">Cuối</a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
