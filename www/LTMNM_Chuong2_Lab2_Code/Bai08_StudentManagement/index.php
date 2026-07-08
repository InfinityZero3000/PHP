<?php
declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

use App\Students\Student;

$student = new Student("Nguyen Huu Thang", 21, "2001234567");
$student->displayInfo();
