<?php

require 'Router.php';
require '../app/controllers/Controller.php';
require '../app/controllers/AboutController.php';
require '../app/controllers/MainController.php';
require '../app/controllers/ContactController.php';
require '../app/models/Model.php';
require '../app/models/Message.php';

if($_SERVER['SERVER_NAME'] == 'localhost') {
    $env = parse_ini_file('../.env');

    define('DBNAME', $env['DBNAME']);
    define('DBHOST', $env['DBHOST']);
    define('DBUSER', $env['DBUSER']);
    define('DBPASS', $env['DBPASS']);
    define('DBPORT', $env['DBPORT']);

} else {
    define('ROOT', 'https://hidden-sea-80825-c356f932b7bb.herokuapp.com/');
    define('DBNAME', getenv('DBNAME'));
    define('DBHOST', getenv('DBHOST'));
    define('DBUSER', getenv('DBUSER'));
    define('DBPASS', getenv('DBPASS'));
    define('DBPORT', getenv('DBPORT'));
}