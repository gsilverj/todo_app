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
        self::matchUri();
    }

    public static function matchUri()
    {
        var_dump(explode('/', $_SERVER['REQUEST_URI']));

        //Convert: task/add/ => TaskController::add()
        //Convert: task/ => TaskController::index()
        //Convert: '' => IndexController::index()

        $uri = '/cat/duck/';
        $toConvert = array();
        $finishedLocation = '';

        $toConvert = explode(' ' , trim(str_replace('/' , ' ' ,$uri) , " "));
        var_dump($toConvert);

       //This may be usefull, so I left it here, obviously need to be changed.
       /* if(!empty($toConvert[0]))
        {
            foreach($toConvert as $val)
            {
                if ($val == $toConvert[count($toConvert) - 1 ] )
                {

                }

            }
        }
        else
        {
            $finishedLocation = 'IndexController::index()';
        }*/

        /*
        if(!empty($toConvert[0]))
        {
            switch (count($toConvert))
            {
                case 1:
                {
                    $finishedLocation = ucfirst($toConvert[0]) . 'Controller::index()';
                    break;
                }
                case 2:
                {
                    $finishedLocation = ucfirst($toConvert[0]) . 'Controller::' . $toConvert[1] . '()';
                    break;
                }
                default:
                    {

                    break;
                    }
            }
        }
        else
        {
            $finishedLocation = 'IndexController::index()';
        }*/

        var_dump(substr_count($uri, '/'));
        var_dump($finishedLocation);









    }

} 