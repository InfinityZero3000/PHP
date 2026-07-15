<?php
require_once __DIR__ . '/../includes/layout.php';

// Cộng quantity để tính tổng số lượng sản phẩm mỗi khách hàng đã mua.
$sql = <<<SQL
    -- Lấy khách hàng và tổng số lượng sản phẩm đã mua.
    SELECT c.customer_id, c.name, SUM(od.quantity) AS total_items
    FROM customers AS c
    -- Nối khách hàng với đơn hàng của họ.
    INNER JOIN orders AS o ON c.customer_id = o.customer_id
    -- Nối đơn hàng với các dòng chi tiết.
    INNER JOIN order_details AS od ON o.order_id = od.order_id
    -- Gom dữ liệu theo từng khách hàng.
    GROUP BY c.customer_id, c.name
    -- Xếp tổng số lượng giảm dần; mã khách tăng dần dùng khi bằng nhau.
    ORDER BY total_items DESC, c.customer_id ASC
    -- Chỉ lấy khách hàng đứng đầu.
    LIMIT 1
SQL;

runExercise(
    'Bài 07: Khách hàng mua nhiều sản phẩm nhất',
    'Xếp giảm dần theo tổng số lượng sản phẩm và lấy khách hàng đầu tiên.',
    ['customer_id' => 'Mã KH', 'name' => 'Khách hàng', 'total_items' => 'Tổng sản phẩm'],
    $sql
);
