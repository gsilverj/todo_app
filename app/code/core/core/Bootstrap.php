<?php
/**
 * Created by PhpStorm.
 * User:            Gabriell J.
 * Date:            3/5/14
 * Time:            10:51 AM
 * Project Name:    Bootstrap.php  (tasks.dev/lib/core/Bootstrap.php  project)
 */


// *** I made a quick change to MatchURI to change the current theme to core_theme if the url isnt url/task

final class Core_Bootstrap
{
    public static function initialize()
    {
        //Initialize App
        self::quickHandleConfig();

        self::runInstallScripts();

        //Match URI to Controller
        self::matchUri($_SERVER['REQUEST_URI']);
    }

    public static function quickHandleConfig($configFile = null)
    {
            $xmlConfigObj = new Core_XMLConfig($configFile);
            $xmlConfigObj->setBaseUrlFromConfig();
            $xmlConfigObj->setCurrentTheme();
            $xmlConfigObj->setDatabaseInfo();
            $xmlConfigObj->setRegisteredModules();
            $xmlConfigObj->setRegisteredThemes();
    }

    public static function matchUri($uri = null)
    {
        if($uri)
        {
            //This methods intended use:
            //  Convert: task/add?query => TaskController::add()   pretty much get rid of the '?query' part.
            //  Convert: task/add/ => TaskController::add()
            //  Convert: task/ => TaskController::index()
            //  Convert: '' => IndexController::index()


            $uri = str_replace('?' . $_SERVER['QUERY_STRING'], ' ', $uri);                //replace the query with a space.
            $uri = explode(' ' , trim(str_replace('/' , ' ' , $uri) , ' '));        //replace the '/' with a space, then trim off whitespace, finally explode the contents by whitespace.


            if(array_key_exists(0, $uri) && empty($uri[0]))                         //if the uri is empty, replace it with 'Core_Index'.
            {
                $uri[0] = 'Core_Index';
                //just for testing if this will switch the current theme or not.
                Core_XMLConfig::setCurrentTheme('core_theme');
            }
            elseif($uri[0] == 'core')
            {
                //another just for testing
                Core_XMLConfig::setCurrentTheme('core_theme');
            }


            //upper case the first letter of the first element in uri,
            //then replace the first letter of any other word after an underscore with the uppercase one.
            //if there is not function in the uri, replace it with 'index'.
            $className = ucfirst($uri[0]) . 'Controller';
            $className = preg_replace_callback('/_[a-z]?/', function ($matches) {return strtoupper($matches[0]);} , $className);
            $function = ((count($uri) == 2) ? $uri[1] : 'index' );

            //check if the className is only one word and append _IndexController if it is.
            //create a 'className object.
            //Todo: do this in a try catch, if it doesnt exist, throw up 404 page.
            try
            {
                $className = self::getValidClassName($className);
                $inst = new $className;
            }
            catch(Exception $e)
            {
                echo 'Non-flashy 404 page';
                echo "<br />";
                die('This Program Died Because The Class Name ' . $className . 'Does Not Exist Or Was Not Found.');
            }

            if(method_exists($inst, $function))             //if:   the function(method) that is grabbed from uri exists
            {
                    $inst->$function();
            }
            else                                            //else: throw exception and 404 page
            {
                $inst->index(true);

                die('This Program Died Because The function(Method) ' . $function . ' Does Not Exist In Class ' . $className);
            }

        }
        else
        {
            //todo: throw exception about no uri being passed in...
        }
    }

    //this function checks if the uri is only one word, no '_controller' and if it is, append '_IndexController'.
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

    public static function getModuleNameFromClass($class = false)
    {
        $moduleName = false;
        if($class)
        {
            $classArr = explode('_', $class);
            $classArr = array_reverse($classArr);
            $moduleName = array_pop($classArr);
        }
        return $moduleName;
    }

    public static function runInstallScripts()
    {
        return Core_Install::runInstallScripts();
    }

}