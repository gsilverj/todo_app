<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once getcwd() . '/lib/core/functions.php';

include_once getcwd() . DS . 'lib' . DS . 'core' . DS . 'Core_Bootstrap.php';

\lib\core\Core_Bootstrap::initialize();