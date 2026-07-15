<?php
require_once __DIR__ . '/../includes/layout.php';

// LEFT JOIN tạo giá trị NULL ở phía order_details nếu sản phẩm chưa được đặt.
$sql = <<<SQL
    -- Lấy mã và tên của sản phẩm.
    SELECT p.product_id, p.name
    FROM products AS p
    -- Ghép sản phẩm với các dòng chi tiết đơn hàng nếu có.
    LEFT JOIN order_details AS od ON p.product_id = od.product_id
    -- NULL nghĩa là không tìm được sản phẩm tương ứng trong order_details.
    WHERE od.product_id IS NULL
    -- Sắp xếp theo mã sản phẩm.
    ORDER BY p.product_id
SQL;

runExercise(
    'Bài 06: Sản phẩm chưa từng được đặt hàng',
    'LEFT JOIN kết hợp IS NULL để tìm sản phẩm không xuất hiện trong chi tiết đơn.',
    ['product_id' => 'Mã SP', 'name' => 'Sản phẩm'],
    $sql
);
