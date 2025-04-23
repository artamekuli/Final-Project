<?php

require 'Router.php';
require '../app/controllers/Controller.php';
require '../app/controllers/AboutController.php';
require '../app/controllers/MainController.php';
require '../app/controllers/ContactController.php';
require '../app/models/Model.php';
require '../app/models/Message.php';

$env = parse_ini_file('../.env');

define('DBNAME', $env['DBNAME']);
define('DBHOST', $env['DBHOST']);
define('DBUSER', $env['DBUSER']);
define('DBPASS', $env['DBPASS']);