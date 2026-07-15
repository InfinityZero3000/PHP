<?php

use Illuminate\Support\Facades\Artisan;

// Lệnh ví dụ có sẵn để kiểm tra Artisan hoạt động.
Artisan::command('inspire', function (): void {
    $this->comment(Illuminate\Foundation\Inspiring::quote());
})->purpose('Display an inspiring quote');
