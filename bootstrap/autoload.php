<?php

require "../vendor/autoload.php";

$dotEnv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotEnv->load();

require "../Core/Database.php";
