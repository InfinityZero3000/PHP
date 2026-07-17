<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Cấu hình đường dẫn gốc và các tệp route của ứng dụng Laravel 12.
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Chưa cần đăng ký middleware tùy chỉnh trong bài lab này.
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Laravel sử dụng cơ chế xử lý ngoại lệ mặc định.
    })->create();
