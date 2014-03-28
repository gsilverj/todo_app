<?php
/**
 * Created by PhpStorm.
 * User:            Gabriell J.
 * Date:            3/5/14
 * Time:            10:51 AM
 * Project Name:    Bootstrap.php  (tasks.dev/lib/core/Bootstrap.php  project)
 */


final class Core_Bootstrap
{

    public static function initialize(){
        //Initialize App
        self::quickHandleConfig();

        //Match URI to Controller
        self::matchUri($_SERVER['REQUEST_URI']);
    }

    public static function quickHandleConfig($configFile = null)
    {
        if($configFile !== null)
        {
            //maybe throw an exception here...
            $xmlConfigObj = new Core_XMLConfig($configFile);
            $xmlConfigObj->setBaseUrlFromConfig();
            $xmlConfigObj->setCurrentTheme();
            $xmlConfigObj->setRegisteredModules();
            $xmlConfigObj->setRegisteredThemes();
        }
        else
        {
            //may want to do a try-catch here, just in-case of somehow getting an error?
            $xmlConfigObj = new Core_XMLConfig();
            $xmlConfigObj->setBaseUrlFromConfig();
            $xmlConfigObj->setCurrentTheme();
            $xmlConfigObj->setDatabaseInfo();
            $xmlConfigObj->setRegisteredModules();
            $xmlConfigObj->setRegisteredThemes();
        }
    }

    public static function matchUri($uri = null)
    {
        if($uri)
        {
            //            var_dump($_SERVER);
//            echo ($_SERVER['HTTP_HOST']);
//            echo ($_SERVER['REQUEST_URI']);
//            echo "<br />";
//            echo "<br />";
//            echo ($_SERVER['REQUEST_URI']);
//            echo "<br />";
//            echo "<br />";
//            echo ($_SERVER['QUERY_STRING']);
//            echo "<br />";
//            echo "<br />";
//            $noSymbols = str_replace(array('?', '&'), ' ', $uri);
//            echo $uri;
//            echo "<br />";
//            echo "<br />";
//            echo $noSymbols;
//            echo "<br />";
//            echo "<br />";
//            $urlPieces = explode(' ', $noSymbols);
//
//            var_dump($urlPieces);
//
//            $uri = $urlPieces[0];
//            echo $uri;
//            echo "<br />";
//            echo "<br />";
//
//            for($i = 0; $i < count($urlPieces); $i++)
//            {
//                if($i == 0)
//                {
//                    $uri = $urlPieces[$i];
//                }
//                else
//                {
//                    $query[$i] = $urlPieces[$i];
//                }
//            }
//
//            var_dump($query);

            $params = null;
            //ex.       uri = /tasks/add?quote=15&hamburger=1
            $noSymbols = str_replace(array('?', '&'), ' ', $uri);       //    noSymbols = /tasks/add quote=15 hamburger=1
            $urlPieces = explode(' ', $noSymbols);                      //    urlPieces = array(/tasks/add, quote=15, hamburger=1)
            $urlPieces = array_filter($urlPieces);


            if(count($urlPieces) <= 2)
            {
                if(count($urlPieces) == 1)
                {
                    $uri = $urlPieces[0];
                }
                else
                {
                    $uri = $urlPieces[0];
                    $params = $urlPieces[1];
                }
            }
            else
            {
                for($i = 0; $i < count($urlPieces); $i++)
                {
                    if($i == 0)
                    {
                        $uri = $urlPieces[$i];
                    }
                    else
                    {
                        $params[$i-1] = $urlPieces[$i];
                    }
                }
            }

            if($params !== null)
            {
                if(count($params) == 1)
                {
                    $paramsParts = explode('=', $params);
                    if(count($paramsParts) == 1)                    //***** if the user tried to pass in a url instead of a button and the key=>value pair is not there, make the param what ever is there and pass it in as the value for the function.
                    {
                        $params = $paramsParts;
                    }
                    else
                    {
                        $paramID = $paramsParts[0];
                        $paramValue = $paramsParts[1];
                        $params = array($paramID => $paramValue);
                    }
                }
                else
                {
                    for($i = 0; $i < count($params); $i ++)
                    {
                        $paramsParts = explode('=', $params[$i]);
                        $paramID = $paramsParts[0];
                        $paramValue = $paramsParts[1];
                        $params[$i] = array($paramID => $paramValue);
                    }
                }
            }


            //Convert: task/add/ => TaskController::add()
            //Convert: task/ => TaskController::index()
            //Convert: '' => IndexController::index()

            $uri = explode(' ' , trim(str_replace('/' , ' ' ,$uri) , ' '));
            // possible to do this instead and bump up by one for checks
            // $uri = explode('/' , trim($uri , ' '));


            if(array_key_exists(0, $uri) && empty($uri[0]))
            {
                $uri[0] = 'Core_Index';
            }

            $className = ucfirst($uri[0]) . 'Controller';
            $className = preg_replace_callback('/_[a-z]?/', function ($matches) {return strtoupper($matches[0]);} , $className);
            $function = ((count($uri) == 2) ? $uri[1] : 'index' );


            $className = self::getValidClassName($className);
            $inst = new $className;
            if($params !== null)
                $inst->$function($params);
            else
                $inst->$function();
        }
        else
        {
            //todo: throw error about no uri being passed in...
        }
    }

    //can change this to completely set up the class, location_class::function, kind of thing in the future.
    public static function getValidClassName($className = null)
    {
        $folders = explode('_', $className);
        $fileName = array_pop($folders);

        if(count($folders) == 0)
        {
            $folders = explode('Controller', $fileName);
            $fileName = 'IndexController';

            $className = $folders[0] . '_' . ucfirst($fileName);
            return $className;
        }

        return $className;

    }

    public static function getModuleNameFromClass($class = false){
        $moduleName = false;
        if($class){
            $classArr = explode('_', $class);
            $classArr = array_reverse($classArr);
            $moduleName = array_pop($classArr);
        }
        return $moduleName;
    }




}