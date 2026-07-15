<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Bài 9 yêu cầu seed lại 20 sinh viên mẫu.
        Student::factory()->count(20)->create();
    }
}
