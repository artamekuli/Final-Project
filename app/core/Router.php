<?php

namespace app\core;

use app\controllers\MainController;
use app\controllers\AboutController;
use app\controllers\ContactController;

class Router {
    public $uriArray;

    function __construct() {
        $this->uriArray = $this->routeSplit();
        $this->handleMainRoutes();
        $this->handleAboutRoutes();
        $this->handleContactRoutes();
        $this->handleNotFound();
    }

    protected function routeSplit() {
        $removeQueryParams = strtok($_SERVER["REQUEST_URI"], '?');
        return explode("/", trim($removeQueryParams, '/'));
    }

    protected function handleMainRoutes() {
        if (
            (!isset($this->uriArray[0]) || $this->uriArray[0] === '') &&
            $_SERVER['REQUEST_METHOD'] === 'GET'
        ) {
            $mainController = new MainController();
            $mainController->homepage();
            exit;
        }

        if ($this->uriArray[0] === 'homepage' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->homepage();
            exit;
        }
    }

    protected function handleAboutRoutes() {
        if ($this->uriArray[0] === 'about' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $aboutController = new AboutController();
            $aboutController->aboutpage();
            exit;
        }
    }

    protected function handleContactRoutes() {
        if ($this->uriArray[0] === 'contact' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            // Handle /contact or /contact/count
            if (isset($this->uriArray[1]) && $this->uriArray[1] === 'count') {
                $contactController = new ContactController();
                $contactController->getMessageCount();
                exit;
            }

            $contactController = new ContactController();
            $contactController->contactpage();
            exit;
        }

        if ($this->uriArray[0] === 'contact' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactController = new ContactController();
            $contactController->submit();
            exit;
        }
    }

    protected function handleNotFound() {
        http_response_code(404);
        echo "404 Not Found";
        exit;
    }
}
