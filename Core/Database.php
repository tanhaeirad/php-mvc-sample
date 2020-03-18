<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

//init database parameters
$capsule->addConnection([
    'driver' => env('DB_CONNECTION','mysql'),
    'host' => env('DB_HOST','localhost'),
    'port' => env('DB_PORT','3306'),
    'database' => env('DB_DATABASE'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD',''),
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci'
]);

//boot eloquent
$capsule->bootEloquent();