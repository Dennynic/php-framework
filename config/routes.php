<?php
    /** @var \PHPFramework\Application $app */
    
    $app->router->get('/', function(){
        return view('Main/main', ['title' => 'Welcome to My Framework']);
    });

    $app->router->get('/about', function(){
        return view('About/about');
    });

    $app->router->get('/contact', [\App\Controllers\ContactController::class, 'index']
    );

    $app->router->post('/contact', [\App\Controllers\ContactController::class, 'send']
    );

    

