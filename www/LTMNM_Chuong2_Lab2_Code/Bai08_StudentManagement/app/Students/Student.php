<?php
declare(strict_types=1);

namespace App\Students;

class Student extends Person
{
    private string $studentID;

    public function __construct(string $name, int $age, string $studentID)
    {
        parent::__construct($name, $age);
        $this->studentID = $studentID;
    }

    public function displayInfo(): void
    {
        parent::displayInfo();
        echo "Mã sinh viên: {$this->studentID}" . PHP_EOL;
    }
}
