<?php

use app\controllers\AuthController;
use app\controllers\ContactController;
use app\core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(dirname(__DIR__));


// Define Application Routes
$app->router->get('/', "home");
$app->router->post('/blog', "create");

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->get('/signup', [AuthController::class, 'register']);
$app->router->get('/contact', [ContactController::class, 'contact']);
$app->router->post('/contact', [ContactController::class, 'submitContact']);


// Run Application
$app->run();


