<?php
declare(strict_types=1);

class Car
{
    public string $brand;
    public string $color;

    public function showInfo(): void
    {
        echo "Brand: {$this->brand}, Color: {$this->color}" . PHP_EOL;
    }
}

$car1 = new Car();
$car1->brand = "Toyota";
$car1->color = "Red";

$car2 = new Car();
$car2->brand = "Honda";
$car2->color = "Blue";

$car1->showInfo();
$car2->showInfo();
