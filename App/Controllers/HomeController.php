<?php


namespace App\Controllers;


use Core\Views;

class HomeController
{
    public function index(){
        return Views::renderWithBlade('index');
    }
}