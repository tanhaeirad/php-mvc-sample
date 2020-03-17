<?php

use Core\Router;

//require autoload to have access to files
require __DIR__ . "/../vendor/autoload.php";

//To register new route go to /Extra/routes.php
//load routes from Extra/routes.php
require_once __DIR__ . "/../Extra/routes.php";

//execute url
Router::executeUrl($_SERVER["QUERY_STRING"]);

