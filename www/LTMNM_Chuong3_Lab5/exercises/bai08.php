<?php
require_once __DIR__ . '/../includes/layout.php';

// COALESCE chuyển kết quả NULL của loại chưa bán được thành số 0.
$sql = <<<SQL
    -- Tính tổng số lượng bán và tổng doanh thu của từng loại.
    SELECT c.category_name,
           COALESCE(SUM(od.quantity), 0) AS total_quantity,
           COALESCE(SUM(od.quantity * od.price), 0) AS total_revenue
    FROM categories AS c
    -- LEFT JOIN bảo đảm mọi loại hàng đều xuất hiện.
    LEFT JOIN products AS p ON c.category_id = p.category_id
    -- Ghép sản phẩm với chi tiết bán hàng nếu sản phẩm đã được đặt.
    LEFT JOIN order_details AS od ON p.product_id = od.product_id
    -- Gom kết quả theo từng loại hàng.
    GROUP BY c.category_id, c.category_name
    -- Hiển thị theo thứ tự mã loại.
    ORDER BY c.category_id
SQL;

runExercise(
    'Bài 08: Tổng số lượng và doanh thu của từng loại sản phẩm',
    'Thống kê cả loại chưa bán được sản phẩm bằng LEFT JOIN.',
    ['category_name' => 'Loại hàng', 'total_quantity' => 'Số lượng bán', 'total_revenue' => 'Doanh thu'],
    $sql
);
