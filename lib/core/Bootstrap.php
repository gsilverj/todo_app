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

    protected static $_config;



    public static function initialize(){
        //Initialize App
        self::setIncludePaths();
        //self::getConfig();
        self::readXmlConfigFile();

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
                $uri[0] = 'Core_Index';
            }

            $className = ucfirst($uri[0]) . 'Controller';
            $className = preg_replace_callback('/_[a-z]?/', function ($matches) {return strtoupper($matches[0]);} , $className);
            $function = ((count($uri) == 2) ? $uri[1] : 'index' );

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
            static::$_config = '';//read file
        }

        return static::$_config;
    }

    public static function readXmlConfigFile($source = null)
    {
        if($source === null)
        {
            $source = getcwd() . DS . 'lib' . DS . 'core' . DS . 'Config.xml';
        }


        $xml = false;

        if(file_exists($source))
        {
            $xml = simplexml_load_file($source);
            var_dump($xml);
        }
        else
        {
            echo 'failed to open file!!!!';
        }

        return $xml;
    }




}