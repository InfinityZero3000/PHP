<?php
// Bật chế độ khai báo kiểu dữ liệu nghiêm ngặt của PHP.
declare(strict_types=1);

// Thông tin kết nối đến MySQL. Thay đổi các giá trị này nếu máy dùng cấu hình khác.
const DB_HOST = '127.0.0.1';
const DB_PORT = '3306';
const DB_NAME = 'lab3_shop';
const DB_USER = 'root';
const DB_PASS = '';

// Hàm tạo và trả về đối tượng PDO dùng để truy vấn cơ sở dữ liệu.
function getPDO(): PDO
{
    // Biến static giữ lại kết nối để không phải kết nối lại nhiều lần trong một request.
    static $pdo = null;

    // Nếu kết nối đã được tạo thì trả về kết nối hiện có.
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    // DSN cho biết loại CSDL, địa chỉ máy chủ, cổng, tên CSDL và bảng mã.
    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', DB_HOST, DB_PORT, DB_NAME);

    // Khởi tạo PDO với các tùy chọn giúp bắt lỗi và lấy dữ liệu dạng mảng kết hợp.
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        // Ném PDOException khi kết nối hoặc truy vấn xảy ra lỗi.
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Mỗi dòng dữ liệu có tên cột làm khóa của mảng.
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Dùng prepared statement thật của MySQL.
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    // Trả kết nối cho nơi gọi hàm.
    return $pdo;
}
