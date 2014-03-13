<?php
/**
 * Created by PhpStorm.
 * User:            Gabriell J.
 * Date:            3/5/14
 * Time:            10:51 AM
 * Project Name:    Bootstrap.php  (tasks.dev/lib/core/Bootstrap.php  project)
 */

namespace lib\core;


final class Core_Bootstrap
{

    protected static $_config;  //the loaded xml file
    protected static $_registered_modules = array(); //will hold a 2-dimensional associative array. (ex. registered_modules['lib(namespace)']['core(file_path)'];

    public static function initialize(){
        //Initialize App
        self::setIncludePaths();
        self::$_config = self::readInXmlConfigFile();
        self::setRegisteredModules();
        //self::getConfig();
        //Match URI to Controller
        self::matchUri($_SERVER['REQUEST_URI']);
    }



    //todo: this function automatically places 'controller' to the end, it shouldnt do that?
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
                $uri[0] = 'Core_Index';
            }

            $className = ucfirst($uri[0]) . 'Controller';
            $className = preg_replace_callback('/_[a-z]?/', function ($matches) {return strtoupper($matches[0]);} , $className);
            $function = ((count($uri) == 2) ? $uri[1] : 'index' );


            $className = self::getValidClassName($className);
            $inst = new $className;
            $inst->$function();

        }
        echo $className;
        return $className;
    }

    public static function setIncludePaths(){

        $_paths = array('lib', 'app');

        $includePath = '';

        foreach($_paths as $value){
            $includePath = $includePath . getcwd() . DS . $value . ':';
        }
        set_include_path($includePath);

    }

    public static function getConfig()
    {
        if (null === static::$_config) {
            //static::$_config = '';//read file
            static::$_config = self::readInXmlConfigFile();
        }

        return static::$_config;
    }

    public static function readInXmlConfigFile($source = null)
    {
        if($source === null)
        {
            $source = getcwd() . DS . 'lib' . DS . 'core' . DS . 'Config.xml';
        }


        $xml = false;

        if(file_exists($source))
        {
            //load xml file as a simple xml and into $xml
            $xml = simplexml_load_file($source);
        }
        else
        {
            echo 'failed to open file!!!!';
        }

        return $xml;
    }

    public static function setRegisteredModules()
    {
        //below will read stuff out of the xml file , can change to show the specific children of the <tag>. (so you can throw children into the include path.)

        $xml = self::$_config;

        //var_dump($xml);

        foreach ($xml->children() as $child)
        {
            if($child->getName() == 'registered_modules')
            {
                foreach($child->children() as $module)
                {
                    //var_dump($module);
                    foreach($module->children() as $key => $value)
                    {
                        //echo $key;
                        //echo '.' . $value . "...";
                        //echo $array[$key] . ".....";
                        self::$_registered_modules[$module->getName()][$key] = (string)$value;
                        //var_dump(self::$_registered_modules);
                        //echo self::$_registered_modules[$module][$array[$key]];
                        //TODO: Maybe use the self::addModuleToRegisteredModules() method here instead of hardcoding it...

                    }
                }
            }
        }

        //var_dump(self::$_registered_modules);
        //echo self::$_registered_modules['task']['namespace'];

    }

    public static function getRegisteredModules()
    {
        return self::$_registered_modules;
    }

    public static function addModuleToRegisteredModules($moduleName = null, $moduleNameSpace = null, $moduleFilePath = null)
    {

        if(
            self::validateName($moduleName) &&
            self::validateName($moduleNameSpace) &&
            self::validateName($moduleFilePath)
        ) {
            self::$_registered_modules[$moduleName]['namespace'] = $moduleNameSpace;
            self::$_registered_modules[$moduleName]['file_path'] = $moduleFilePath;
        } else {
            //ThrowException
            return;
        }

    }

    //validation for addModuleToRegisteredModules, to make sure the passed in values are valid. (maybe change name or something?)
    public static function validateName($name = null){
        return (!is_null($name) && is_string($name));
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



}