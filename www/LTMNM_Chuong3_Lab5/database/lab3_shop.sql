DROP DATABASE IF EXISTS lab3_shop;
CREATE DATABASE lab3_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lab3_shop;

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL
) ENGINE=InnoDB;
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    category_id INT,
    CONSTRAINT fk_products_categories FOREIGN KEY (category_id) REFERENCES categories(category_id)
) ENGINE=InnoDB;
CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE
) ENGINE=InnoDB;
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    order_date DATE NOT NULL,
    customer_id INT,
    CONSTRAINT fk_orders_customers FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
) ENGINE=InnoDB;
CREATE TABLE order_details (
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (order_id, product_id),
    CONSTRAINT fk_details_orders FOREIGN KEY (order_id) REFERENCES orders(order_id),
    CONSTRAINT fk_details_products FOREIGN KEY (product_id) REFERENCES products(product_id)
) ENGINE=InnoDB;

INSERT INTO categories (category_name) VALUES ('Điện thoại'),('Laptop'),('Phụ kiện');
INSERT INTO products (name, price, category_id) VALUES
('iPhone 15 Pro Max',33990000,1),('Samsung Galaxy S24 Ultra',28990000,1),
('MacBook Air M2',28990000,2),('Dell XPS 13',26990000,2),
('Tai nghe AirPods Pro 2',5490000,3),('Chuột Logitech MX Master 3S',2490000,3),
('Cáp sạc USB-C',199000,3),('iPad Pro 12.9',30990000,1),
('Asus ZenBook',18990000,2),('Bàn phím cơ Keychron K2',2390000,3);
INSERT INTO customers (name, email) VALUES
('Nguyễn Văn A','a.nguyen@example.com'),('Trần Thị B','b.tran@example.com'),('Lê Văn C','c.le@example.com');
INSERT INTO orders (order_date, customer_id) VALUES
('2025-08-01',1),('2025-08-02',2),('2025-08-03',3),('2025-08-05',1);
INSERT INTO order_details (order_id, product_id, quantity, price) VALUES
(1,1,1,33990000),(1,5,2,5490000),(2,3,1,28990000),
(3,2,1,28990000),(3,6,1,2490000),(4,4,1,26990000),(4,7,3,199000);

-- =============================================================
-- BÀI 01: THỐNG KÊ SỐ LƯỢNG SẢN PHẨM TRONG TỪNG LOẠI HÀNG
-- =============================================================
-- LEFT JOIN giúp loại hàng chưa có sản phẩm vẫn xuất hiện.
-- COUNT(p.product_id) chỉ đếm product_id khác NULL.
-- GROUP BY gom các sản phẩm có cùng loại hàng thành một nhóm.
SELECT
    c.category_name,
    COUNT(p.product_id) AS total_products
FROM categories AS c
LEFT JOIN products AS p
    ON c.category_id = p.category_id
GROUP BY c.category_id, c.category_name
ORDER BY c.category_id;

-- =============================================================
-- BÀI 02: TÍNH TỔNG DOANH THU TỪNG NGÀY
-- =============================================================
-- Thành tiền của một dòng chi tiết = quantity * price.
-- SUM cộng thành tiền của tất cả đơn hàng trong cùng một ngày.
SELECT
    o.order_date,
    SUM(od.quantity * od.price) AS total_revenue
FROM orders AS o
INNER JOIN order_details AS od
    ON o.order_id = od.order_id
GROUP BY o.order_date
ORDER BY o.order_date;

-- =============================================================
-- BÀI 03: TÌM LOẠI HÀNG CÓ TRÊN 5 SẢN PHẨM
-- =============================================================
-- HAVING lọc dữ liệu sau khi GROUP BY và COUNT hoàn thành.
-- Không dùng WHERE cho COUNT vì WHERE được xử lý trước khi nhóm.
-- Với dữ liệu mẫu, truy vấn trả về rỗng vì không loại nào có trên 5 SP.
SELECT
    c.category_name,
    COUNT(p.product_id) AS total_products
FROM categories AS c
INNER JOIN products AS p
    ON c.category_id = p.category_id
GROUP BY c.category_id, c.category_name
HAVING COUNT(p.product_id) > 5
ORDER BY total_products DESC;

-- =============================================================
-- BÀI 04: DANH SÁCH KHÁCH HÀNG VÀ TỔNG TIỀN ĐÃ MUA
-- =============================================================
-- Nối customers -> orders -> order_details để lấy các sản phẩm khách đã mua.
-- HAVING chỉ giữ khách có tổng chi tiêu lớn hơn 1.000.000 đồng.
SELECT
    c.customer_id,
    c.name,
    SUM(od.quantity * od.price) AS total_spent
FROM customers AS c
INNER JOIN orders AS o
    ON c.customer_id = o.customer_id
INNER JOIN order_details AS od
    ON o.order_id = od.order_id
GROUP BY c.customer_id, c.name
HAVING SUM(od.quantity * od.price) > 1000000
ORDER BY total_spent DESC;

-- =============================================================
-- BÀI 05: TÌM SẢN PHẨM CÓ GIÁ CAO NHẤT TRONG TỪNG LOẠI
-- =============================================================
-- Subquery tìm giá MAX của loại hàng chứa sản phẩm đang xét.
-- Nếu nhiều sản phẩm cùng có giá cao nhất, tất cả đều được hiển thị.
SELECT
    c.category_name,
    p.name,
    p.price
FROM products AS p
INNER JOIN categories AS c
    ON p.category_id = c.category_id
WHERE p.price = (
    SELECT MAX(p2.price)
    FROM products AS p2
    WHERE p2.category_id = p.category_id
)
ORDER BY c.category_id, p.product_id;

-- =============================================================
-- BÀI 06: LIỆT KÊ SẢN PHẨM CHƯA TỪNG ĐƯỢC ĐẶT HÀNG
-- =============================================================
-- LEFT JOIN giữ lại toàn bộ sản phẩm.
-- od.product_id IS NULL xác định sản phẩm không có bản ghi tương ứng.
SELECT
    p.product_id,
    p.name
FROM products AS p
LEFT JOIN order_details AS od
    ON p.product_id = od.product_id
WHERE od.product_id IS NULL
ORDER BY p.product_id;

-- =============================================================
-- BÀI 07: KHÁCH HÀNG MUA NHIỀU SẢN PHẨM NHẤT
-- =============================================================
-- SUM(quantity) tính tổng số lượng sản phẩm mỗi khách đã mua.
-- ORDER BY DESC đưa khách mua nhiều nhất lên đầu; LIMIT 1 lấy người đầu.
SELECT
    c.customer_id,
    c.name,
    SUM(od.quantity) AS total_items
FROM customers AS c
INNER JOIN orders AS o
    ON c.customer_id = o.customer_id
INNER JOIN order_details AS od
    ON o.order_id = od.order_id
GROUP BY c.customer_id, c.name
ORDER BY total_items DESC, c.customer_id ASC
LIMIT 1;

-- =============================================================
-- BÀI 08: TỔNG SỐ LƯỢNG VÀ DOANH THU TỪNG LOẠI SẢN PHẨM
-- =============================================================
-- Hai LEFT JOIN giúp loại hàng chưa bán được vẫn xuất hiện.
-- COALESCE đổi giá trị NULL thành 0 đối với loại chưa có doanh thu.
SELECT
    c.category_id,
    c.category_name,
    COALESCE(SUM(od.quantity), 0) AS total_quantity,
    COALESCE(SUM(od.quantity * od.price), 0) AS total_revenue
FROM categories AS c
LEFT JOIN products AS p
    ON c.category_id = p.category_id
LEFT JOIN order_details AS od
    ON p.product_id = od.product_id
GROUP BY c.category_id, c.category_name
ORDER BY c.category_id;

-- =============================================================
-- BÀI 09: TÌM 3 SẢN PHẨM BÁN CHẠY NHẤT
-- =============================================================
-- Sản phẩm bán chạy được xác định bằng tổng quantity đã bán.
-- LIMIT 3 chỉ lấy ba sản phẩm đứng đầu sau khi sắp xếp giảm dần.
SELECT
    p.product_id,
    p.name,
    SUM(od.quantity) AS total_quantity
FROM products AS p
INNER JOIN order_details AS od
    ON p.product_id = od.product_id
GROUP BY p.product_id, p.name
ORDER BY total_quantity DESC, p.product_id ASC
LIMIT 3;

-- =============================================================
-- BÀI 10: LIỆT KÊ 5 KHÁCH HÀNG CHI TIÊU NHIỀU NHẤT
-- =============================================================
-- SUM(quantity * price) cộng chi tiêu từ mọi đơn của từng khách hàng.
-- LIMIT 5 lấy tối đa năm khách có tổng chi tiêu lớn nhất.
SELECT
    c.customer_id,
    c.name,
    c.email,
    SUM(od.quantity * od.price) AS total_spent
FROM customers AS c
INNER JOIN orders AS o
    ON c.customer_id = o.customer_id
INNER JOIN order_details AS od
    ON o.order_id = od.order_id
GROUP BY c.customer_id, c.name, c.email
ORDER BY total_spent DESC, c.customer_id ASC
LIMIT 5;

-- =============================================================
-- BÀI 11: TÌM LOẠI HÀNG CÓ DOANH THU CAO NHẤT
-- =============================================================
-- Doanh thu loại hàng là tổng doanh thu các sản phẩm thuộc loại đó.
-- Kết quả được xếp giảm dần và LIMIT 1 lấy loại có doanh thu cao nhất.
SELECT
    c.category_id,
    c.category_name,
    SUM(od.quantity * od.price) AS total_revenue
FROM categories AS c
INNER JOIN products AS p
    ON c.category_id = p.category_id
INNER JOIN order_details AS od
    ON p.product_id = od.product_id
GROUP BY c.category_id, c.category_name
ORDER BY total_revenue DESC, c.category_id ASC
LIMIT 1;

-- =============================================================
-- BÀI 12: LIỆT KÊ SẢN PHẨM VÀ SỐ LẦN ĐƯỢC ĐẶT HÀNG
-- =============================================================
-- LEFT JOIN giúp sản phẩm chưa được đặt vẫn xuất hiện.
-- COUNT(DISTINCT order_id) đếm số đơn khác nhau chứa sản phẩm.
-- COUNT bỏ qua NULL nên sản phẩm chưa được đặt có kết quả bằng 0.
SELECT
    p.product_id,
    p.name,
    COUNT(DISTINCT od.order_id) AS order_count
FROM products AS p
LEFT JOIN order_details AS od
    ON p.product_id = od.product_id
GROUP BY p.product_id, p.name
ORDER BY p.product_id;
