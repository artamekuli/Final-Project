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
    }

    protected function routeSplit() {
        $removeQueryParams = strtok($_SERVER["REQUEST_URI"], '?');
        return explode("/", $removeQueryParams);
    }

    protected function handleMainRoutes() {
        if ($this->uriArray[1] === '' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->homepage();
        } else {
            if ($this->uriArray[1] === 'homepage' && $_SERVER['REQUEST_METHOD'] === 'GET') {
                $mainController = new MainController();
                $mainController->homepage();
        }
    }}

    protected function handleAboutRoutes() {
        if ($this->uriArray[1] === 'about' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $aboutController = new AboutController();
            $aboutController->aboutpage();
        }
    }

    protected function handleContactRoutes() {
        if ($this->uriArray[1] === 'contact' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $contactController = new ContactController();
            $contactController->contactpage();
        }
    }
}