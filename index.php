<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//includes, that could probably be put into bootstrap...




include_once 'lib/core/Functions.php';
include_once getcwd() . DS . 'lib' . DS . 'core' . DS . 'Bootstrap.php';
include_once getcwd() . DS . 'lib' . DS . 'core' . DS . 'Autoloader.php';
include_once getcwd() . DS . 'lib' . DS . 'core' . DS . 'XMLConfig.php';
include_once getcwd() . DS . 'lib' . DS . 'core' . DS . 'Registry.php';
include_once getcwd() . DS . 'app' . DS . 'task' . DS . 'Registry.php';

include_once getcwd() . DS . 'lib' . DS . 'core' . DS . 'models' . DS . 'DbDataMapperModel.php';
include_once getcwd() . DS . 'lib' . DS . 'core' . DS . 'models' . DS . 'DbObjectModel.php';
include_once getcwd() . DS . 'lib' . DS . 'core' . DS . 'models' . DS . 'DbServicesModel.php';


$loader = new Core_Autoloader();
$loader -> registerAutoloader();

Core_Bootstrap::initialize();



