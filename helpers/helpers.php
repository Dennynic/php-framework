<?php

function app(): \PHPFramework\Application{
    return \PHPFramework\Application::$app;
}

function view(string $view ='', array $data = [], string $layout = ''): string |\PHPFramework\View{
    if($view){
        return app()->view->render($view, $data, $layout);
    }
        
    return app()->view;
}

function request(): \PHPFramework\Request{
    return app()->request;
}

function baseUrl($path = ''): string{
    return PATH . $path;
}