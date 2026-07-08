<?php
declare(strict_types=1);

class MathHelper
{
    public static function add(float $a, float $b): float
    {
        return $a + $b;
    }
}

class AdvancedMath extends MathHelper
{
    public static function power(float $a, float $b): float
    {
        return $a ** $b;
    }
}

echo "3 + 5 = " . MathHelper::add(3, 5) . PHP_EOL;
echo "2 ^ 3 = " . AdvancedMath::power(2, 3) . PHP_EOL;

// Phương thức add() được kế thừa từ MathHelper.
echo "10 + 20 = " . AdvancedMath::add(10, 20) . PHP_EOL;
