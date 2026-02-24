<?php

namespace PHPFramework;

class View
{

    public string $layout;
    public string $content = '';

    public function __construct($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $data = [], $layout = ''): string
    {
        extract($data);
        $view_file = VIEWS . "/{$view}.php";

        if (is_file($view_file)) {
            ob_start();
            require $view_file;
            $this->content = ob_get_clean();
        } else {
            app()->response->setResponseCode(500);
            return view('Errors/500', ['error' => "Not found view {$view_file}"], false);
        }
        //TODO: Не совсем корректно делать layout = false, т.к. во view ожидается string, но пока так
        if ($layout === false) {
            return $this->content;
        }

        $layout_file_name = $layout ?: $this->layout;
        $layout_file = VIEWS . "/Layouts/{$layout_file_name}.php";

        if (is_file($layout_file)) {
            ob_start();
            require_once $layout_file;
            return ob_get_clean();
        } else {
            app()->response->setResponseCode(500);
            return view('Errors/500', ['error' => "Not found layout {$layout_file}"], false);
        }
    }

}