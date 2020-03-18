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