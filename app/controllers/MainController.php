<?php

namespace app\controllers;

class MainController extends Controller {

    public function homepage() {
        $this->returnView('../public/views/homepage.html');
    }

    public function notFound() {
    }

}