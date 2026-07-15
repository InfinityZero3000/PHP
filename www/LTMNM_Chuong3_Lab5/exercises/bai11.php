<?php
require_once __DIR__ . '/../includes/layout.php';

// Doanh thu loại hàng là tổng doanh thu của mọi sản phẩm thuộc loại đó.
$sql = <<<SQL
    -- Tính tổng doanh thu của từng loại hàng.
    SELECT c.category_id, c.category_name,
           SUM(od.quantity * od.price) AS total_revenue
    FROM categories AS c
    -- Nối loại hàng với các sản phẩm thuộc loại.
    INNER JOIN products AS p ON c.category_id = p.category_id
    -- Nối sản phẩm với dữ liệu bán hàng.
    INNER JOIN order_details AS od ON p.product_id = od.product_id
    -- Gom toàn bộ doanh thu theo từng loại.
    GROUP BY c.category_id, c.category_name
    -- Loại có doanh thu cao nhất được xếp đầu tiên.
    ORDER BY total_revenue DESC, c.category_id ASC
    -- Lấy duy nhất loại đứng đầu.
    LIMIT 1
SQL;

runExercise(
    'Bài 11: Loại hàng có doanh thu cao nhất',
    'Tổng hợp doanh thu theo loại, xếp giảm dần và lấy kết quả đầu.',
    ['category_id' => 'Mã loại', 'category_name' => 'Loại hàng', 'total_revenue' => 'Doanh thu'],
    $sql
);
