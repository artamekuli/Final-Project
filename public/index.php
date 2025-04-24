<?php

require '../app/core/setup.php';

use app\core\Router;
use app\controllers\MainController;
use app\controllers\AboutController;
use app\controllers\ContactController;

$router = new Router();

$router->get('/', function() {
    $controller = new MainController();
    $controller->homepage();
});

$router->get('/about', function() {
    $controller = new AboutController();
    $controller->aboutpage();
});

$router->get('/contact', function() {
    $controller = new ContactController();
    $controller->contactpage();
});

$router->post('/contact/submit', function() {
    $controller = new ContactController();
    $controller->submit();
});

$router->get('/contact/count', function() {
    $controller = new ContactController();
    $controller->getMessageCount();
});

$router->dispatch();
