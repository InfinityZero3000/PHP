<?php

declare(strict_types=1);

$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '3306';
$dbName = getenv('DB_NAME') ?: 'labdb';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS');
$password = $password === false ? '' : $password;

$dsn = sprintf(
    'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
    $host,
    $port,
    $dbName
);

try {
    $conn = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $exception) {
    http_response_code(500);
    exit('Kết nối CSDL thất bại. Hãy kiểm tra cấu hình MySQL. Chi tiết: ' . htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8'));
}
