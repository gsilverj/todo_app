<?php
/**
 * Created by PhpStorm.
 * User: Gabriell J.
 * Date: 3/18/14
 * Time: 12:59 PM
 */

class Core_XMLConfig {

    protected static $_current_theme ='';
    protected static $_base_url = '';
    protected static $_config;  //the loaded xml file
    protected static $_registered_modules = array(); //will hold a 2-dimensional associative array. (ex. registered_modules['lib(namespace)']['core(file_path)'];
    protected static $_registered_themes = array(); //will hold a multi-dim. array of all the themes placed in the config file.


    public function __construct($configFile = null)
    {
            self::readInXmlConfigFile($configFile);
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
        $xml = false;

        if($source === null)
        {
            $source = getcwd() . DS . 'lib' . DS . 'core' . DS . 'Config.xml';
            $xml = simplexml_load_file($source);
        }
        elseif(file_exists($source))
        {
            //load xml file as a simple xml and into $xml
            $xml = simplexml_load_file($source);
        }


        self::$_config = $xml;
    }

    public static function setBaseUrlFromConfig($baseUrl = null)
    {
        if($baseUrl === null)
        {
            $xml = self::$_config;
            foreach ($xml->children() as $child)
            {
                //var_dump($child);
                if($child->getName() == 'url')
                {
                    self::$_base_url = $child;
                }
            }
        }
        else
        {
            self::$_base_url = $baseUrl;
        }
    }

    public static function getBaseUrl()
    {
        return self::$_base_url;
    }

    public static function setRegisteredModules()
    {
        $xml = self::getConfig();

        foreach ($xml->children() as $child)
        {
            if($child->getName() == 'registered_modules')
            {
                foreach($child->children() as $module)
                {
                    foreach($module->children() as $key => $value)
                    {
                        self::$_registered_modules[$module->getName()][$key] = (string)$value;
                        //TODO: Maybe use the self::addModuleToRegisteredModules() method here instead of hardcoding it...
                    }
                }
            }
        }
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

    //NOTE that this method sets the registered_themes in the order found in the xml.
    public static function setRegisteredThemes()
    {
        $xml = self::getConfig();
        /*      For gabriell to see that you can go right into the xml with no problems without going child by child...
        foreach($xml->registered_themes->children() as $themeName)
        {
            foreach($themeName->folderList->children() as $folder => $name)
            {
                echo $folder;
                echo $name;
                self::$_registered_themes[$themeName->getName()][$folder] = (string)$name;
            }
        }*/
        // This piece is only needed if planning to do dynamic searching through the xml...
        foreach ($xml->children() as $child)
        {
            if($child->getName() == 'registered_themes')
            {
                foreach($child->children() as $themeName)
                {
                    foreach($themeName->children() as $folderList)
                    {
                        $stringValues = array();                                    //This and below is because the xmltag = 'name' for all three, so have to put into an array and then put that into the $_registered_themes[].
                        $ct = 0;
                        foreach($folderList->children() as $folderNames => $value)
                        {
                            $stringValues[$ct] = (string)$value;
                            $ct++;
                        }
                        self::$_registered_themes[$themeName->getName()][$folderList->getName()] = $stringValues;
                    }
                }
            }
        }
    }

    public static function getRegisteredThemes()
    {
        return self::$_registered_themes;
    }

    public static function setCurrentTheme($themeName = null)
    {
        if($themeName === null)
        {
            $xml = self::getConfig();
            //loop through the config to find what the 'current_theme' is... (so it can dynamically locate it)
            foreach($xml->children() as $child)
            {
                if($child->getName() == 'current_theme')
                {
                    self::$_current_theme = $child;
                }
            }
        }
        else
        {
            self::$_current_theme = $themeName;
        }
    }

    public static function getCurrentTheme()
    {
        return self::$_current_theme;
    }









} 