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
        $className = false;
        if($uri){

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
            $inst->$function();

        }
        return $className;
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