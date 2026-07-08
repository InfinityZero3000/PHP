<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 04</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<h1>Bài 04: Xếp loại điểm</h1>
<form action="grade.php" method="post">
    <label for="score">Điểm (0–10)</label>
    <input id="score" type="number" name="score" min="0" max="10" step="0.1" required>
    <input type="submit" value="Xem xếp loại">
</form>

</div>
</body>
</html>
