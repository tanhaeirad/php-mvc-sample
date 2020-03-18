<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

//init database parameters
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'port' => '3309',
    'database' => 'mvcproject',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci'
]);

//boot eloquent
$capsule->bootEloquent();