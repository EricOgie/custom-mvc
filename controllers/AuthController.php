<?php

namespace app\controllers;
use app\core\Request;

class AuthController extends BaseController
{
    public function register()
    {
        return $this->renderView('register');
    }

    public function login()
    {
        return $this->renderView('login');
    }
}
