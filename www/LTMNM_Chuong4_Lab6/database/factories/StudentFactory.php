<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    // Bài 4 và 9: Faker sinh dữ liệu hợp lệ cho mọi cột của students.
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'age' => fake()->numberBetween(16, 25),
            'gender' => fake()->randomElement(['male', 'female']),
            'class_name' => fake()->randomElement(['12DHTH01', '12DHTH02', '12DHTH03']),
        ];
    }
}
