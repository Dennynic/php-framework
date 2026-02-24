<?php

namespace App\Models;

use PHPFramework\Model;

class Contact extends Model{
    
    public array $fillable = ['email', 'content', 'name', 'user_name'];
    public array $attributes = [];
    public array $rules = [
        'email' => ['email' => true, 'min' => 5, 'max' => 50],
        'content' => ['max' => 500],
        'name' => ['required' => true, 'min' => 5, 'max' => 30],
        'user_name' => ['required' => true, 'min' => 5, 'max' => 20],
    ];

}