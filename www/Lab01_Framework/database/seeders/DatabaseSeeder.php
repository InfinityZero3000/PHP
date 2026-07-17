<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** Gọi mọi seeder cần thiết của ứng dụng. */
    public function run(): void
    {
        // Tách StudentSeeder giúp mã dễ mở rộng và chạy riêng.
        $this->call([
            StudentSeeder::class,
        ]);
    }
}
