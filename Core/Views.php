<?php


namespace Core;


abstract class Views
{
    //function to render a view to show
    public static function render(string $view, array $args = [])
    {
        extract($args);
        $view_address = __DIR__ . '/../App/Views/' . $view . '.php';

        //check if is file available or not
        if (is_readable($view_address)) {
            //load view
            require_once $view_address;
            require_once $view_address;
        } else {
            //show error view is not exist
            die("file {$view_address} is not exist"); //TODO: manage error handling
        }
    }
}