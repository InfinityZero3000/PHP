<?php
require_once __DIR__ . '/../includes/layout.php';

// Truy vấn con được chạy tương ứng với category_id của sản phẩm đang xét.
$sql = <<<SQL
    -- Lấy loại hàng, tên sản phẩm và giá sản phẩm.
    SELECT c.category_name, p.name, p.price
    FROM products AS p
    -- Nối bảng categories để lấy tên loại hàng.
    INNER JOIN categories AS c ON p.category_id = c.category_id
    -- Chỉ giữ sản phẩm có giá bằng giá lớn nhất trong loại của nó.
    WHERE p.price = (
        -- Tìm giá lớn nhất trong cùng category_id.
        SELECT MAX(p2.price)
        FROM products AS p2
        WHERE p2.category_id = p.category_id
    )
    -- Sắp xếp theo mã loại rồi đến mã sản phẩm.
    ORDER BY c.category_id, p.product_id
SQL;

runExercise(
    'Bài 05: Sản phẩm có giá cao nhất trong từng loại hàng',
    'Subquery tương quan tìm giá cao nhất của từng loại.',
    ['category_name' => 'Loại hàng', 'name' => 'Sản phẩm', 'price' => 'Giá'],
    $sql
);
