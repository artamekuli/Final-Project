<?php

require '../app/core/setup.php';

use app\core\Router;
use app\controllers\ContactController;

$router = new Router();

$router->get('/contact', function() {
    $controller = new ContactController();
    $controller->contactpage();
});

$router->post('/contact/submit', function() {
    $controller = new ContactController();
    $controller->submit();
});
