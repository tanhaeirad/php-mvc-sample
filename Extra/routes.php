<?php
use Core\Router;


//add routes here like [route => action]
$routers = [
    "/" => "HomeController@index",
];

//create new Router
$router = Router::getInstance();

//reverse array for observe priority
//$routers = array_reverse($routers);

//add each route to routers
foreach ($routers as $route=>$action)
    $router->add($route,$action);

//return value of $router from Router class
return $router;