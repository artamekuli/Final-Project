<?php

namespace app\controllers;

class AboutController extends Controller {

    public function aboutpage() {
        $this->returnView('../public/views/about.html');
    }

    public function notFound() {
    }

}