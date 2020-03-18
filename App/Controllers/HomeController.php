<?php


namespace App\Controllers;


use Core\Views;

class HomeController
{
    public function index(){
        Views::render('index');
    }
}