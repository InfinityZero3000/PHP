<?php
require_once __DIR__ . '/../includes/layout.php';

// HAVING được dùng vì điều kiện lọc áp dụng sau khi GROUP BY.
$sql = <<<SQL
    -- Đếm số sản phẩm thuộc từng loại hàng.
    SELECT c.category_name, COUNT(p.product_id) AS total_products
    FROM categories AS c
    -- INNER JOIN chỉ lấy loại hàng có sản phẩm tương ứng.
    INNER JOIN products AS p ON c.category_id = p.category_id
    -- Gom dữ liệu theo từng loại hàng.
    GROUP BY c.category_id, c.category_name
    -- Chỉ giữ các nhóm có số sản phẩm lớn hơn 5.
    HAVING COUNT(p.product_id) > 5
    -- Loại có nhiều sản phẩm hơn được hiển thị trước.
    ORDER BY total_products DESC
SQL;

// Với dữ liệu mẫu, bài này không có kết quả vì không loại nào có hơn 5 sản phẩm.
runExercise(
    'Bài 03: Tìm loại hàng có trên 5 sản phẩm',
    'Lọc kết quả sau khi nhóm bằng HAVING.',
    ['category_name' => 'Tên loại hàng', 'total_products' => 'Số sản phẩm'],
    $sql
);
