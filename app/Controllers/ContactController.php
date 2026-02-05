<?php

namespace App\Controllers;

use App\Models\Contact;
use PHPFramework\Controller;

class ContactController extends Controller{

    public function index(){
        $data = ['title' => 'Contact Us'];
        return view('Contact/contact', $data);
    }

    public function send(){
        
        $model = new Contact();
        $model->loadData();
        dump('Model', $model->validate());
        return 'Contact page from POST';
    }

}