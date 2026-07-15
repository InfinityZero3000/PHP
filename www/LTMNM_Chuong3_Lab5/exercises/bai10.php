<?php
require_once __DIR__ . '/../includes/layout.php';

// Tổng chi tiêu được tính từ tất cả đơn hàng của mỗi khách hàng.
$sql = <<<SQL
    -- Lấy thông tin khách hàng và tính tổng tiền đã mua.
    SELECT c.customer_id, c.name, c.email,
           SUM(od.quantity * od.price) AS total_spent
    FROM customers AS c
    -- Nối khách hàng với đơn hàng.
    INNER JOIN orders AS o ON c.customer_id = o.customer_id
    -- Nối đơn hàng với chi tiết để tính thành tiền.
    INNER JOIN order_details AS od ON o.order_id = od.order_id
    -- Gom dữ liệu theo từng khách hàng.
    GROUP BY c.customer_id, c.name, c.email
    -- Khách có tổng chi tiêu cao hơn được xếp trước.
    ORDER BY total_spent DESC, c.customer_id ASC
    -- Chỉ lấy tối đa năm khách hàng.
    LIMIT 5
SQL;

runExercise(
    'Bài 10: Top 5 khách hàng chi tiêu nhiều nhất',
    'Tổng hợp chi tiêu của khách hàng rồi xếp giảm dần.',
    ['customer_id' => 'Mã KH', 'name' => 'Khách hàng', 'email' => 'Email', 'total_spent' => 'Tổng chi tiêu'],
    $sql
);
