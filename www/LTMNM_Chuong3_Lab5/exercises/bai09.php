<?php
require_once __DIR__ . '/../includes/layout.php';

// Sản phẩm bán chạy được xác định theo tổng quantity, không phải số dòng đơn hàng.
$sql = <<<SQL
    -- Cộng số lượng bán của từng sản phẩm.
    SELECT p.product_id, p.name, SUM(od.quantity) AS total_quantity
    FROM products AS p
    -- Chỉ lấy sản phẩm từng xuất hiện trong chi tiết đơn hàng.
    INNER JOIN order_details AS od ON p.product_id = od.product_id
    -- Gom các lần bán của cùng một sản phẩm.
    GROUP BY p.product_id, p.name
    -- Xếp tổng số lượng từ cao xuống thấp.
    ORDER BY total_quantity DESC, p.product_id ASC
    -- Chỉ lấy ba sản phẩm đầu tiên.
    LIMIT 3
SQL;

runExercise(
    'Bài 09: Top 3 sản phẩm bán chạy nhất',
    'Xếp hạng theo tổng số lượng bán ra.',
    ['product_id' => 'Mã SP', 'name' => 'Sản phẩm', 'total_quantity' => 'Số lượng bán'],
    $sql
);
