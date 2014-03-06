<?php
/**
 * Created by PhpStorm.
 * User:            Gabriell J.
 * Date:            3/5/14
 * Time:            10:51 AM
 * Project Name:    Core_Bootstrap.php  (tasks.dev/lib/core/Core_Bootstrap.php  project)
 */

namespace lib\core;


final class Core_Bootstrap
{

    public static function initialize(){
        //Initialize App
        //Match URI to Controller
        self::matchUri($_SERVER['REQUEST_URI']);
    }


    public static function matchUri($uri = null)
    {
        $className = false;
        if($uri){

            //Convert: task/add/ => TaskController::add()
            //Convert: task/ => TaskController::index()
            //Convert: '' => IndexController::index()

            $uri = explode(' ' , trim(str_replace('/' , ' ' ,$uri) , ' '));

            if(array_key_exists(0, $uri) && empty($uri[0]))
            {
                $uri[0] = 'Index';
            }

            $className = ucfirst($uri[0]) . 'Controller::' . ((count($uri) == 2) ? $uri[1] : 'index' ) . '()';

        }
        return $className;
    }

} 