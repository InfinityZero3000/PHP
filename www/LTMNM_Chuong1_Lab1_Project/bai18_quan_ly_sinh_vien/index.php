<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 18</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
$students = [
    ['name' => 'Nguyễn An', 'score' => 7.5],
    ['name' => 'Trần Bình', 'score' => 8.8],
    ['name' => 'Lê Chi', 'score' => 9.2],
    ['name' => 'Phạm Dũng', 'score' => 6.9],
];

function findTopStudents(array $students): array
{
    if ($students === []) return [];
    $maxScore = max(array_column($students, 'score'));
    return array_values(array_filter(
        $students,
        fn(array $student): bool => (float)$student['score'] === (float)$maxScore
    ));
}

$topStudents = findTopStudents($students);
?>
<h1>Bài 18: Quản lý danh sách sinh viên</h1>
<table>
    <thead><tr><th>Họ tên</th><th>Điểm</th></tr></thead>
    <tbody>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= htmlspecialchars($student['name']) ?></td>
            <td><?= number_format($student['score'], 1) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="result">
    Sinh viên có điểm cao nhất:
    <?php foreach ($topStudents as $index => $student): ?>
        <?= $index ? ', ' : '' ?><?= htmlspecialchars($student['name']) ?>
        (<?= number_format($student['score'], 1) ?>)
    <?php endforeach; ?>
</div>

</div>
</body>
</html>
