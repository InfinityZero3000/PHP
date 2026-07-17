<?php

use Illuminate\Support\Facades\Artisan;

// Cung cấp câu trích dẫn ngẫu nhiên khi chạy lệnh php artisan inspire.
Artisan::command('inspire', function (): void {
    $this->comment(Illuminate\Foundation\Inspiring::quote());
})->purpose('Display an inspiring quote');
