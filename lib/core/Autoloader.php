<?php
/**
 * Created by PhpStorm.
 * User: Gabriell J.
 * Date: 3/6/14
 * Time: 10:25 AM
 *
 * @category    Autoloader
 * @package     Core_Autoloader
 */

/*
 * I expect the file to create all of the classes the program will need at start, as well as handle creating any
 *      other classes that may need to be used while in program. This file might keep track of all of the classes
 *      that were initialized in an array and check against or maybe create a new class based on a name or something....
 *
 *
 * ***I need to learn more about the importance/uses of an autoloader***
 *
 *
 * ^^^Seems that the a Autoloaders purpose is:
 *      "An autoloader should just be used to find a class file and include it. It shouldn't (and can't) do any logic
 *          such as instantiating an object or making decisions about which object to load. ... it doesn't create the object." - joonty (http://stackoverflow.com/questions/9671109/singleton-factory-autoloader)
 *s
 * autoload function was heavily based on:   http://www.devshed.com/c/a/PHP/The-Data-Mapper-Design-Pattern-A-Final-Example/2/
 *
 *
 *
 * TODO:
 *      - Make this more modular. (ex. add spl_extensions so .php isnt hardcoded.)
 *      - Clean up the look of the code and trim the comments.
 *
 */




class Core_Autoloader
{
    private $dir;   //this will be the beginning of the directory desired,defined in __construct() (in this case "lib/core/" for ease of testing purposes)


    public function __construct()
    {
        $this->dir = 'lib' . DS . 'core' . DS;
    }

    //will attempt to load the class passed in, if the class already exists it will return true, otherwise it will try to find the file/require it,
    //      otherwise it will return false because file was not found so it cant require it. (ex if bootstrap taskcontroller isnt required, check for taskcontroller.php and require it)
    //      (true = already required OR is now required'd, false = file is not found)
    public function autoload($class)
    {
        if(class_exists($class, false)) //check if $class exists and dont default __autoload if it doesnt.
        {
            return true;
        }

        $file = $this->dir . $class . '.php';  //prepend the $dir and append .php to end of the class string that is passed in.
        //echo $file; // this is what is coming out of $file after 'pends.

        if(!file_exists($file))                                                                         //TODO:need to change this
        {
            return false;
        }

        require_once $file;

        //echo ' yeah it actually worked <br />';   //just a check to see if it is working.
        return true;
    }







    //TODO: for some reason i cant get spl_ to work unless I do it in the class currently?
    //will set autoload() as the only __autoloader to use for the current project.
    public function registerAutoloader()
    {
        spl_autoload_register(null, false);
        spl_autoload_register(array($this, 'autoload'));
    }


}