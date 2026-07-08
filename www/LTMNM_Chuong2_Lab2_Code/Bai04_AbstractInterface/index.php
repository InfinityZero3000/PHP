<?php
declare(strict_types=1);

interface CanRun
{
    public function run(): void;
}

abstract class Animal
{
    abstract public function makeSound(): void;
}

class Dog extends Animal implements CanRun
{
    public function makeSound(): void
    {
        echo "Woof! Woof!" . PHP_EOL;
    }

    public function run(): void
    {
        echo "Dog is running..." . PHP_EOL;
    }
}

class Cat extends Animal
{
    public function makeSound(): void
    {
        echo "Meow! Meow!" . PHP_EOL;
    }
}

$dog = new Dog();
$dog->makeSound();
$dog->run();

$cat = new Cat();
$cat->makeSound();
