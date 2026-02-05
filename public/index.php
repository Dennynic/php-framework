<?php
    use PHPFramework\Application;
    
    if(PHP_MAJOR_VERSION < 8){
        die("PHP 8.0 or higher is required.");
    }

    require_once __DIR__ . '/../config/init.php';
    require_once ROOT . '/vendor/autoload.php';
    $app = new Application();
    require_once CONFIG . '/routes.php';
    require_once HELPERS . '/helpers.php';


    //dump($app->router->getRoutes());
    $app->run();
   
        
    
