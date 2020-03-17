<?php


namespace Core;
class Router
{

    private static $instance = null;
    //Array of Route objects
    private static array $routes;

    //set constructor private for singleton
    private function __construct()
    {

    }

    //return instance of Router class
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Router();
        }

        return self::$instance;
    }

    //Add new route for application
    public function add(string $route_string, string $action)
    {
        //create new Route
        $route = new Route();

        //set route route
        $route_string = $this->prepareRouteString($route_string);
        $route->setRoute($route_string);

        //set route controller and method
        list($controller, $method) = $this->prepareMethodAndController($action);
        $route->setController($controller);
        $route->setMethod($method);

        //add route to routes array
        $this->addToRoutes($route);
    }

    public static function executeUrl(string $url)
    {
        //prepare url
        $url = self::prepareUrl($url);

        //prepare value of controller and method
        $action = self::getUrlAction($url);
        $controller = $action[0];
        $method = $action[1];

        //check router is register or not
        if ($controller == "") die("This Route: {$url} is not set"); //TODO: Should show 404 page
        if ($method == "") die("This Route: {$url} is not set"); //TODO: Should show 404 page

        //prepare params
        $params = self::getUrlParams($url);

        //check class is exist or not
        if (class_exists($controller)) {
            $controller = new $controller();

            //check method is exist or not
            if (is_callable([$controller, $method])) {

                //run method
                echo call_user_func_array([$controller, $method], $params);

            }//method is not exist
            else {
                die("Method {$method} is not exist"); //TODO: Should show 404 page
            }
        } //class is not exist:
        else {
            die("Class {$controller} is not exist."); //TODO: Should show 404 page
        }

    }

    //Prepare RegEx route string and make it to lower case
    private function prepareRouteString(string $route): string
    {
        $route = strtolower($route);

        //create RegEx
        $route = preg_replace('/^\//', '', $route);
        $route = preg_replace('/\//', '\/', $route);
        $route = preg_replace('/{([a-zA-Z0-9-]+)}/', '(?<\1>[a-zA-Z0-9-]+)', $route);

        //remove '\/' at the end.
        $route = rtrim($route, '\/');

        return $route;
    }

    //prepare url, remove index.php and GET parameters and make it to lower case
    private static function prepareUrl(string $url): string
    {
        $url = strtolower($url);
        //remove index.php and GET parameters
        $url = preg_replace('/\/index\.php/', '', $url);
        $url = preg_replace('/\.php/', '', $url);
        $url = explode('&', $url)[0];

        //remove '/' at the end.
        $url = rtrim($url, '/');

        return $url;
    }

    //return controller & method of route as list ($controller , $method).
    private function prepareMethodAndController(string $action)
    {
        return explode('@', $action);
    }

    //add route to routes array
    private function addToRoutes(Route $route)
    {
        //get index of $route
        $index = $this->getIndexOfRoute($route);

        //check this route is exist or not, if exist update method and controller
        if ($index > 0 | $index === 0) {
            //update the route
            self::$routes[$index]->setController($route->getController());
            self::$routes[$index]->setMethod($route->getMethod());
        } //if is not exist just add to array
        else
            self::$routes[] = $route;
    }

    //return key of $route element or false if is not exist
    private function getIndexOfRoute(Route $route)
    {
        if (empty($this->routes)) return false;
        foreach ($this->routes as $item) {
            if ($item->getRoute() == $route->getRoute()) return array_search($item, $this->routes);
        }
        return false;
    }

    private static function getUrlParams(string $url)
    {
        $params = [];
        foreach (self::$routes as $route) {
            if (preg_match("/^" . $route->getRoute() . "$/", $url, $arr)) {
                foreach ($arr as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }
                break;
            }
        }

        return $params;
    }

    //return controller & method of url as list ($controller , $method).
    private static function getUrlAction(string $url)
    {
        //if we have no routes
        if (empty(self::$routes)) return ["",""];

        foreach (self::$routes as $route) {
            $pattern = "/^" . $route->getRoute() . "$/";
            if (preg_match($pattern, $url, $arr)) {
                return ["App\Controllers\\" . $route->getController(), $route->getMethod()];
            }

        }
        return ["", ""];
    }
}

class Route
{

    private string $route; //should be set as RegEx
    private string $method;
    private string $controller;

    /**
     * @return string value of route.
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param string $route
     */
    public function setRoute(string $route): void
    {
        $this->route = $route;
    }

    /**
     * @return string value of method.
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @return string value of controller
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     */
    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }


}