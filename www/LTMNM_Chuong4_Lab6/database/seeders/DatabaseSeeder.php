<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Gọi seeder con để dữ liệu mẫu được tạo bằng php artisan db:seed.
        $this->call([StudentSeeder::class]);
    }
}
