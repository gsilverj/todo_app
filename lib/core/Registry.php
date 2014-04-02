<?php
/**
 * Created by PhpStorm.
 * User: Gabriell J.
 * Date: 3/28/14
 * Time: 4:07 PM
 */

//I intend to use this registry specifically to hold info about what query was just ran for the view...
//An abstract class that allows me to extend it just like a regular class, the only exception being that an abstract class can define abstract methods, methods with no body or code, that MUST be defined in the child class.
//It seems to work on the same principle as the singleton, where you cant actually 'create it', you have to make a child, but it has methods that will get & set information for you.


/**
 * The below class was not only my work, it is heavily based on a design pattern that was found. (gabriell j.)
 *
 * source   : https://github.com/domnikl/DesignPatternsPHP/blob/master/Registry/Registry.php    (hosted by 'domniki')
 * purpose  : To create a registry that will serve as a storage place for the application.
 *
 */
abstract class Core_Registry
{
    //variables
    const LOGGER = 'logger';
    protected static $storedValues  = array();


    //empty methods
    private function index()
    {}
    private function __construct()
    {}
    private function __clone()
    {}


    //important methods

    //this method will return 'NULL' if the key is not found in the registry.
    public static function get($key)
    {
        $found = false;

        foreach(self::$storedValues as $id => $value)
        {
            //echo $id;
            //echo $value;
            if($id == $key)
            {
                $found = true;
            }
        }

        if($found == false)
        {
            //todo: throw exception here about not being able to find the requested value;
            return null;
        }
        return self::$storedValues[$key];
    }

    public static function set($key, $value)
    {
        self::$storedValues[$key] = $value;
    }
}

