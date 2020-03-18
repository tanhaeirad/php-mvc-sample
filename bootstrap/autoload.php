<?php

//load autoload
require "../vendor/autoload.php";

//load routes from Extra/routes.php
require_once __DIR__ . "/../Extra/routes.php";

//init .env
$dotenv = new \Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();

//init database
require "../Core/Database.php";

//init error reporting
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');
