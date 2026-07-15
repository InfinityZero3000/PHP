<?php
require_once __DIR__ . '/../includes/layout.php';

// COUNT(DISTINCT order_id) đếm số đơn khác nhau có chứa sản phẩm.
$sql = <<<SQL
    -- Lấy từng sản phẩm và đếm số đơn đã đặt sản phẩm đó.
    SELECT p.product_id, p.name,
           COUNT(DISTINCT od.order_id) AS order_count
    FROM products AS p
    -- LEFT JOIN để sản phẩm chưa từng đặt vẫn xuất hiện với số lần bằng 0.
    LEFT JOIN order_details AS od ON p.product_id = od.product_id
    -- Gom các dòng theo từng sản phẩm.
    GROUP BY p.product_id, p.name
    -- Sắp xếp theo mã sản phẩm tăng dần.
    ORDER BY p.product_id
SQL;

runExercise(
    'Bài 12: Tất cả sản phẩm và số lần được đặt hàng',
    'COUNT đếm số đơn hàng khác nhau; sản phẩm chưa đặt có kết quả bằng 0.',
    ['product_id' => 'Mã SP', 'name' => 'Sản phẩm', 'order_count' => 'Số lần đặt'],
    $sql
);
