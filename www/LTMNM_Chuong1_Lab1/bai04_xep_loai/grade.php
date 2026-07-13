<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả bài 04</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<?php
$score = filter_input(INPUT_POST, 'score', FILTER_VALIDATE_FLOAT);
$rank = null;
if ($score !== false && $score !== null && $score >= 0 && $score <= 10) {
    if ($score >= 8) {
        $rank = "Giỏi";
    } elseif ($score >= 6.5) {
        $rank = "Khá";
    } elseif ($score >= 5) {
        $rank = "Trung bình";
    } else {
        $rank = "Yếu";
    }
}
?>
<h1>Kết quả xếp loại</h1>
<?php if ($rank !== null): ?>
    <div class="result">Điểm: <?= $score ?> — Xếp loại: <strong><?= $rank ?></strong></div>
<?php else: ?>
    <div class="error">Điểm phải nằm trong khoảng từ 0 đến 10.</div>
<?php endif; ?>
<p><a href="grade_form.php">Nhập lại</a></p>

</div>
</body>
</html>
