<?php
    //TODO: Убрать в проде
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    use PHPFramework\Application;
    
    if(PHP_MAJOR_VERSION < 8){
        die("PHP 8.0 or higher is required.");
    }

    require_once __DIR__ . '/../config/init.php';
    require_once ROOT . '/vendor/autoload.php';
   
    $app = new Application();
 
    require_once CONFIG . '/routes.php';
    require_once HELPERS . '/helpers.php';
    
    $app->run();
    
        
    
