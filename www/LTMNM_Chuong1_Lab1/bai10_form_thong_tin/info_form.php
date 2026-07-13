<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 10</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<h1>Bài 10: Form thông tin cá nhân</h1>
<form action="info_process.php" method="post">
    <label for="hoten">Họ tên</label>
    <input id="hoten" type="text" name="hoten" required>

    <label for="email">Email</label>
    <input id="email" type="email" name="email" required>

    <label for="phone">Số điện thoại</label>
    <input id="phone" type="tel" name="phone" pattern="[0-9+\-\s]{8,15}" required>

    <input type="submit" value="Gửi">
</form>

</div>
</body>
</html>
