<?php


namespace Core;


use Philo\Blade\Blade;

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
            throw new \Exception("file {$view_address} is not exist");
        }
    }

    public static function renderWithBlade(string $view, array $args = [])
    {
        //init address of View and cache folder
        $views_address = realpath(__DIR__ . '/../App/Views');
        $cache_address = realpath(__DIR__ . '/../storage/views');

        //create blade
        $blade = new Blade($views_address, $cache_address);

        return $blade->view()->make($view, $args)->render();

    }
}