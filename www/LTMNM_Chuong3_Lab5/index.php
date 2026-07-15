<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 5 - MySQL và PDO</title>
</head>
<body>
<main>
<section>
<p>LẬP TRÌNH MÃ NGUỒN MỞ</p>
<h1>Lab 5 - MySQL nâng cao với PDO</h1>
<p>Aggregate Functions, GROUP BY, HAVING, JOIN và Subquery.</p>
<ol>
<?php
$items = [
 'Thống kê sản phẩm từng loại','Tổng doanh thu từng ngày','Loại hàng có trên 5 sản phẩm',
 'Khách hàng và tổng tiền đã mua','Sản phẩm giá cao nhất từng loại','Sản phẩm chưa từng được đặt',
 'Khách hàng mua nhiều sản phẩm nhất','Số lượng và doanh thu từng loại','3 sản phẩm bán chạy nhất',
 '5 khách hàng chi tiêu nhiều nhất','Loại hàng có doanh thu cao nhất','Sản phẩm và số lần được đặt'
];
foreach ($items as $i => $name) {
 $number = str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT);
 echo '<li><a href="exercises/bai'.$number.'.php">Bài '.$number.': '.htmlspecialchars($name, ENT_QUOTES, 'UTF-8').'</a></li>';
}
?>
</ol>
</section>
</main>
</body>
</html>
