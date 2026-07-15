<?php
// File dùng chung để chạy truy vấn và hiển thị kết quả của tất cả bài tập.
declare(strict_types=1);

// Chuyển ký tự đặc biệt thành HTML entity để tránh chèn mã HTML ngoài ý muốn.
function h(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

// Định dạng số tiền theo kiểu Việt Nam, ví dụ: 33990000 thành 33.990.000 đ.
function money(mixed $value): string
{
    return number_format((float) $value, 0, ',', '.') . ' đ';
}

// Tạo một trang HTML và hiển thị dữ liệu dưới dạng bảng.
function renderExercise(string $title, string $description, array $columns, array $rows): void
{
    ?><!doctype html>
    <html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= h($title) ?> - Lab 5</title>
    </head>
    <body>
    <main>
        <p><a href="../index.php">Quay lại danh sách bài tập</a></p>
        <section>
            <p>LẬP TRÌNH MÃ NGUỒN MỞ - LAB 5</p>
            <h1><?= h($title) ?></h1>
            <p><?= h($description) ?></p>
            <div>
                <table border="1" cellpadding="8" cellspacing="0">
                    <thead><tr>
                    <?php // Duyệt danh sách tiêu đề cột để tạo phần đầu bảng. ?>
                    <?php foreach ($columns as $label): ?>
                        <th><?= h($label) ?></th>
                    <?php endforeach; ?>
                    </tr></thead>
                    <tbody>
                    <?php if ($rows === []): ?>
                        <tr><td colspan="<?= count($columns) ?>">Không có dữ liệu phù hợp.</td></tr>
                    <?php else: ?>
                        <?php // Mỗi phần tử $row tương ứng với một bản ghi do MySQL trả về. ?>
                        <?php foreach ($rows as $row): ?><tr>
                            <?php foreach (array_keys($columns) as $key): ?>
                                <?php // Những cột là giá hoặc doanh thu sẽ được định dạng thành tiền. ?>
                                <td><?= h(str_contains($key, 'revenue') || str_contains($key, 'spent') || $key === 'price' ? money($row[$key]) : $row[$key]) ?></td>
                            <?php endforeach; ?>
                        </tr><?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <p>Tổng số dòng: <?= count($rows) ?></p>
        </section>
    </main>
    </body>
    </html><?php
}

// Kết nối CSDL, thực thi câu SQL rồi chuyển kết quả sang hàm hiển thị.
function runExercise(string $title, string $description, array $columns, string $sql): void
{
    // Nạp file kết nối đúng một lần.
    require_once __DIR__ . '/../config/database.php';
    try {
        // query() thực thi SQL; fetchAll() lấy toàn bộ các dòng kết quả.
        $rows = getPDO()->query($sql)->fetchAll();
        renderExercise($title, $description, $columns, $rows);
    } catch (PDOException $exception) {
        // Trả mã HTTP 500 và hiển thị hướng dẫn nếu kết nối/truy vấn thất bại.
        http_response_code(500);
        $message = 'Không thể kết nối hoặc truy vấn MySQL. Hãy import file database/lab3_shop.sql và kiểm tra tài khoản trong config/database.php. Chi tiết: '
            . $exception->getMessage();
        renderExercise($title, $message, $columns, []);
    }
}
