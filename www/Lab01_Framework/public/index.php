<?php

use Illuminate\Http\Request;

// Ghi nhận thời điểm bắt đầu để Laravel đo thời gian xử lý request.
define('LARAVEL_START', microtime(true));

// Nếu ứng dụng ở chế độ bảo trì, nạp tệp phản hồi bảo trì.
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Nạp các class đã được Composer cài đặt.
require __DIR__.'/../vendor/autoload.php';

// Khởi tạo ứng dụng và xử lý HTTP request hiện tại.
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
