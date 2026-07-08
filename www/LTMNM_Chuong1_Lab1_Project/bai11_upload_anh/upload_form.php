<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 11</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<div class="nav"><a href="../index.php">← Trang chủ</a></div>

<h1>Bài 11: Upload ảnh</h1>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="avatar">Chọn ảnh JPG, JPEG, PNG hoặc GIF</label>
    <input id="avatar" type="file" name="avatar" accept=".jpg,.jpeg,.png,.gif,image/*" required>
    <input type="submit" value="Upload">
</form>

</div>
</body>
</html>
