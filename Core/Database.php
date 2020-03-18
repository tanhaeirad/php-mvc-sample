<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

//init database parameters
$capsule->addConnection([
    'driver' => _env('DB_CONNECTION','mysql'),
    'host' => _env('DB_HOST','localhost'),
    'port' => _env('DB_PORT','3306'),
    'database' => _env('DB_DATABASE'),
    'username' => _env('DB_USERNAME' , 'root'),
    'password' => _env('DB_PASSWORD',''),
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci'
]);

//boot eloquent
$capsule->bootEloquent();