<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//includes, that could probably be put into bootstrap...

include_once 'lib/core/Functions.php';
include_once getcwd() . DS . 'lib' . DS . 'core' . DS . 'Bootstrap.php';
include_once getcwd() . DS . 'lib' . DS . 'core' . DS . 'Autoloader.php';


$loader = new Core_Autoloader();
$loader -> registerAutoloader();

Core_Bootstrap::initialize();
