<?php
declare(strict_types=1);

namespace App\Students;

class Person
{
    protected string $name;
    protected int $age;

    public function __construct(string $name, int $age)
    {
        if ($age < 0) {
            throw new \InvalidArgumentException("Tuổi không được âm.");
        }

        $this->name = $name;
        $this->age = $age;
    }

    public function displayInfo(): void
    {
        echo "Họ tên: {$this->name}" . PHP_EOL;
        echo "Tuổi: {$this->age}" . PHP_EOL;
    }
}
