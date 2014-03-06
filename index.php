<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


//includes, that could probably be put into bootstrap...
include_once 'lib/core/functions.php';
include_once getcwd() . DS . 'lib' . DS . 'core' . DS . 'Core_Bootstrap.php';
include_once getcwd() . DS . 'lib' . DS . 'core' . DS . 'Autoloader.php';


\lib\core\Core_Bootstrap::initialize();

$autoloaderObject = new Core_Autoloader();
$autoloaderObject -> registerAutoloader();

$obj1 = new Config();
