<?php
namespace app\controllers;
use app\core\Application;

class BaseController
{
    public function renderView(string $view, array $data = []) 
    {
        return Application::$app->router->renderView($view, $data);
    }
}