<?php

namespace App\Controllers;

use PHPFramework\Controller;

class MainController extends Controller{

    public function index(){
        return view('contact');
    }

    public function send(){
        return 'Contact page from POST';
    }

}