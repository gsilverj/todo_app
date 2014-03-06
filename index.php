<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


//includes, that could probably be put into bootstrap...

include_once 'lib/core/Functions.php';
include_once getcwd() . DS . 'lib' . DS . 'core' . DS . 'Bootstrap.php';
include_once getcwd() . DS . 'lib' . DS . 'core' . DS . 'Autoloader.php';


\lib\core\Core_Bootstrap::initialize();

$loaderObj = new Core_Autoloader();
$loaderObj -> registerAutoloader();

$obj1 = new Config();
