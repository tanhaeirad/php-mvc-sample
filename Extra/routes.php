<?php
use Core\Router;


//add routes here like [route => action]
$routers = [
//    "/series/{slug}/episode/{id}" => "SeriesController@episode",
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