<?php

return [
    // Lấy tên ứng dụng từ .env và dùng giá trị dự phòng khi chưa khai báo.
    'name' => env('APP_NAME', 'Lab01 Framework'),
    // Local là môi trường phù hợp khi thực hành trên máy cá nhân.
    'env' => env('APP_ENV', 'production'),
    // Debug chỉ nên bật trong lúc phát triển.
    'debug' => (bool) env('APP_DEBUG', false),
    // URL gốc được dùng khi Laravel sinh liên kết từ command line.
    'url' => env('APP_URL', 'http://localhost'),
    // Múi giờ Việt Nam bảo đảm route /time trả thời gian chính xác.
    'timezone' => env('APP_TIMEZONE', 'Asia/Ho_Chi_Minh'),
    // Ngôn ngữ mặc định của giao diện.
    'locale' => env('APP_LOCALE', 'vi'),
    // Ngôn ngữ dự phòng nếu chưa có bản dịch tiếng Việt.
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
    // Faker sinh tên và dữ liệu phù hợp Việt Nam.
    'faker_locale' => env('APP_FAKER_LOCALE', 'vi_VN'),
    // Thuật toán mã hóa mặc định của Laravel.
    'cipher' => 'AES-256-CBC',
    // Khóa ứng dụng được sinh bằng php artisan key:generate.
    'key' => env('APP_KEY'),
    // Danh sách khóa cũ phục vụ xoay khóa an toàn.
    'previous_keys' => array_filter(explode(',', env('APP_PREVIOUS_KEYS', ''))),
];
