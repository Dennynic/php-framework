<?php
namespace PHPFramework;

abstract class Controller{

    public function render($view, $data = [], $layout = ''): string{
        return view($view, $data, $layout);
    }
}