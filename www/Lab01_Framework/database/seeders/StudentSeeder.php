<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /** Tạo 20 sinh viên mẫu theo yêu cầu cuối cùng của Bài 09. */
    public function run(): void
    {
        // Factory bảo đảm email unique và dữ liệu đúng miền giá trị.
        Student::factory()->count(20)->create();
    }
}
