<?php

use Illuminate\Http\Request;

// Front controller: mọi request web đều đi qua tệp này.
define('LARAVEL_START', microtime(true));
require __DIR__.'/../vendor/autoload.php';
(require_once __DIR__.'/../bootstrap/app.php')->handleRequest(Request::capture());
