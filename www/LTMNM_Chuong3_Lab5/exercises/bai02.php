<?php
require_once __DIR__ . '/../includes/layout.php';

// Tổng doanh thu của một dòng chi tiết = quantity * price.
$sql = <<<SQL
    -- Cộng doanh thu của tất cả chi tiết đơn trong cùng ngày.
    SELECT o.order_date, SUM(od.quantity * od.price) AS total_revenue
    FROM orders AS o
    -- Chỉ lấy các đơn có dữ liệu chi tiết đơn hàng.
    INNER JOIN order_details AS od ON o.order_id = od.order_id
    -- Gom các đơn được lập trong cùng một ngày.
    GROUP BY o.order_date
    -- Sắp xếp kết quả theo ngày tăng dần.
    ORDER BY o.order_date
SQL;

// Gửi tiêu đề, mô tả, tên cột và SQL cho hàm dùng chung.
runExercise(
    'Bài 02: Tính tổng doanh thu từng ngày',
    'Doanh thu được tính bằng tổng số lượng nhân đơn giá.',
    ['order_date' => 'Ngày đặt hàng', 'total_revenue' => 'Tổng doanh thu'],
    $sql
);
