<?php

use Illuminate\Support\Str;

return [
    // MySQL là kết nối mặc định của bài lab.
    'default' => env('DB_CONNECTION', 'mysql'),

    // Khai báo MySQL cho ứng dụng thật và SQLite cho PHPUnit.
    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DB_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
            'busy_timeout' => null,
            'journal_mode' => null,
            'synchronous' => null,
        ],
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            // Giá trị dự phòng cũng là lab01framework để tránh kết nối nhầm DB.
            'database' => env('DB_DATABASE', 'lab01framework'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::ATTR_EMULATE_PREPARES => false,
            ]) : [],
        ],
    ],

    // Laravel lưu lịch sử migration trong bảng migrations.
    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    // Cấu hình Redis mặc định được giữ để framework có thể mở rộng sau này.
    'redis' => [
        'client' => env('REDIS_CLIENT', 'phpredis'),
        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],
    ],
];
