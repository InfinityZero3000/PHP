<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Student> */
class StudentFactory extends Factory
{
    /** Liên kết factory này với model Student. */
    protected $model = Student::class;

    /** Sinh đầy đủ dữ liệu giả hợp lệ theo Bài 04 và Bài 09. */
    public function definition(): array
    {
        // Faker tự tạo dữ liệu khác nhau cho mỗi bản ghi.
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'age' => fake()->numberBetween(16, 25),
            'gender' => fake()->randomElement(['male', 'female']),
            'class_name' => fake()->randomElement(['13DHTH01', '13DHTH02', '13DHTH03']),
        ];
    }
}
