<?php
require_once __DIR__ . '/../includes/layout.php';

// Cần nối ba bảng để đi từ khách hàng đến đơn hàng và chi tiết đơn hàng.
$sql = <<<SQL
    -- Tính tổng số tiền mỗi khách hàng đã mua.
    SELECT c.customer_id, c.name,
           SUM(od.quantity * od.price) AS total_spent
    FROM customers AS c
    -- Tìm các đơn hàng thuộc về khách hàng.
    INNER JOIN orders AS o ON c.customer_id = o.customer_id
    -- Tìm các sản phẩm và số lượng trong từng đơn hàng.
    INNER JOIN order_details AS od ON o.order_id = od.order_id
    -- Gom toàn bộ giao dịch của cùng một khách hàng.
    GROUP BY c.customer_id, c.name
    -- Chỉ lấy khách hàng chi tiêu trên 1.000.000 đồng.
    HAVING SUM(od.quantity * od.price) > 1000000
    -- Khách chi tiêu nhiều nhất được hiển thị trước.
    ORDER BY total_spent DESC
SQL;

runExercise(
    'Bài 04: Danh sách khách hàng và tổng tiền đã mua',
    'Chỉ hiển thị khách hàng có tổng chi tiêu trên 1.000.000 đồng.',
    ['customer_id' => 'Mã KH', 'name' => 'Khách hàng', 'total_spent' => 'Tổng chi tiêu'],
    $sql
);
