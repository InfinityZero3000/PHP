<?php
declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

use App\Models\User;

$user = new User();
$user->sayHello();
