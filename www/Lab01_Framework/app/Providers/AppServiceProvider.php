<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /** Đăng ký các dịch vụ của ứng dụng vào service container. */
    public function register(): void
    {
        // Bài lab chưa có dịch vụ tùy chỉnh cần đăng ký.
    }

    /** Thực hiện cấu hình sau khi mọi service provider đã được đăng ký. */
    public function boot(): void
    {
        // Bài lab chưa cần bổ sung logic khởi động.
    }
}
