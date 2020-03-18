<?php


namespace App\Controllers;


use App\Models\User;
use Core\Views;

class HomeController
{
    public function index(){
        Views::renderWithBlade("index");
    }
}