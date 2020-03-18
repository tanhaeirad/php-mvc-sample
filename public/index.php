<?php

use Core\Router;

//load bootstrap
require __DIR__ . "/../bootstrap/autoload.php";

//To register new route go to /Extra/routes.php

//execute url
Router::executeUrl($_SERVER["QUERY_STRING"]);