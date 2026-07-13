<?php

declare(strict_types=1);

require __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/functions.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)
    ?: filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    setFlash('danger', 'ID sinh viên không hợp lệ.');
    redirect('list_students.php');
}

$stmt = $conn->prepare('SELECT id, name, email, phone, birthday FROM students WHERE id = :id');
$stmt->execute(['id' => $id]);
$student = $stmt->fetch();

if (!$student) {
    setFlash('warning', 'Không tìm thấy sinh viên.');
    redirect('list_students.php');
}

$data = [
    'name' => (string) $student['name'],
    'email' => (string) $student['email'],
    'phone' => (string) ($student['phone'] ?? ''),
    'birthday' => (string) ($student['birthday'] ?? ''),
];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf($_POST['csrf_token'] ?? null)) {
        http_response_code(419);
        exit('CSRF token không hợp lệ.');
    }

    $validated = validateStudentInput($_POST);
    $data = $validated['data'];
    $errors = $validated['errors'];

    if (!$errors) {
        try {
            $stmt = $conn->prepare(
                'UPDATE students
                 SET name = :name, email = :email, phone = :phone, birthday = :birthday
                 WHERE id = :id'
            );
            $stmt->execute([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] !== '' ? $data['phone'] : null,
                'birthday' => $data['birthday'] !== '' ? $data['birthday'] : null,
                'id' => $id,
            ]);

            setFlash('success', 'Cập nhật sinh viên thành công.');
            redirect('list_students.php');
        } catch (PDOException $exception) {
            if ((string) $exception->getCode() === '23000') {
                $errors['email'] = 'Email đã được sử dụng bởi sinh viên khác.';
            } else {
                throw $exception;
            }
        }
    }
}

$pageTitle = 'Cập nhật sinh viên';
require __DIR__ . '/includes/header.php';
?>
<div class="card shadow-sm mx-auto" style="max-width: 720px">
    <div class="card-body p-4">
        <h1 class="h3 mb-4">Cập nhật sinh viên #<?= (int) $id ?></h1>
        <form method="post" novalidate>
            <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
            <input type="hidden" name="id" value="<?= (int) $id ?>">

            <div class="mb-3">
                <label for="name" class="form-label required">Họ tên</label>
                <input type="text" id="name" name="name" maxlength="100" required
                       class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                       value="<?= e($data['name']) ?>">
                <?php if (isset($errors['name'])): ?><div class="invalid-feedback"><?= e($errors['name']) ?></div><?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label required">Email</label>
                <input type="email" id="email" name="email" maxlength="100" required
                       class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                       value="<?= e($data['email']) ?>">
                <?php if (isset($errors['email'])): ?><div class="invalid-feedback"><?= e($errors['email']) ?></div><?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" id="phone" name="phone" maxlength="20"
                       class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>"
                       value="<?= e($data['phone']) ?>">
                <?php if (isset($errors['phone'])): ?><div class="invalid-feedback"><?= e($errors['phone']) ?></div><?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="birthday" class="form-label">Ngày sinh</label>
                <input type="date" id="birthday" name="birthday"
                       class="form-control <?= isset($errors['birthday']) ? 'is-invalid' : '' ?>"
                       value="<?= e($data['birthday']) ?>">
                <?php if (isset($errors['birthday'])): ?><div class="invalid-feedback"><?= e($errors['birthday']) ?></div><?php endif; ?>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="list_students.php" class="btn btn-outline-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
