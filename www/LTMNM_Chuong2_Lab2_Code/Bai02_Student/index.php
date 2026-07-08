<?php
declare(strict_types=1);

class Student
{
    private string $name;
    private int $age;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function display(): void
    {
        echo "Name: {$this->name}, Age: {$this->age}" . PHP_EOL;
    }

    public function __destruct()
    {
        echo "Đối tượng Student đã bị hủy." . PHP_EOL;
    }
}

$student1 = new Student("Nguyen Van A", 20);
$student1->display();
