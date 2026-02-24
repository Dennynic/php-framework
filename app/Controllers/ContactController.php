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
        if(!$model->isValid()){
            return view('Contact/contact', ['title' => 'Contact form', 'errors' => $model->getErrors()]);
        }else{
            dump('No errors');
        }
        response()->redirect('/');
        return 'Contact page from POST';
    }
}