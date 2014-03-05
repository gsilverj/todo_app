<?php
/**
 * Created by PhpStorm.
 * User:            Gabriell J.
 * Date:            3/5/14
 * Time:            10:51 AM
 * Project Name:    Core_Bootstrap.php  (tasks.dev/lib/core/Core_Bootstrap.php  project)
 */

namespace lib\core;


final class Core_Bootstrap {

    public static function initialize(){
        //Initialize App
        //Match URI to Controller
        self::matchUri();
    }

    public static function matchUri(){
        var_dump($_SERVER['REQUEST_URI']);

    }

} 