<?php
require_once __DIR__ . '/../includes/layout.php';

// LEFT JOIN giữ lại cả loại hàng chưa có sản phẩm.
$sql = <<<SQL
    -- Lấy tên loại và đếm số mã sản phẩm khác NULL của loại đó.
    SELECT c.category_name, COUNT(p.product_id) AS total_products
    FROM categories AS c
    -- Ghép sản phẩm vào loại hàng dựa trên category_id.
    LEFT JOIN products AS p ON c.category_id = p.category_id
    -- Gom các sản phẩm thuộc cùng một loại thành một nhóm.
    GROUP BY c.category_id, c.category_name
    -- Hiển thị theo thứ tự mã loại tăng dần.
    ORDER BY c.category_id
SQL;

// Thực thi truy vấn và hiển thị hai cột kết quả.
runExercise(
    'Bài 01: Thống kê số lượng sản phẩm trong từng loại hàng',
    'Hiển thị mọi loại hàng, kể cả loại chưa có sản phẩm.',
    ['category_name' => 'Tên loại hàng', 'total_products' => 'Số sản phẩm'],
    $sql
);
