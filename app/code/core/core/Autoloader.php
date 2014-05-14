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
 *
 * autoload function was heavily based on:   http://www.devshed.com/c/a/PHP/The-Data-Mapper-Design-Pattern-A-Final-Example/2/
 *
 *
 *
 * TODO: ALL
 *      - Make this more modular. (ex. add spl_extensions so .php isnt hardcoded.)
 *      - Clean up the look of the code and trim the comments.
 *      - Maybe add the fileTypes into the config so it doesnt have to be hardcoded.
 *      - $_filetypes[] should maybe include a '' so it can check in the directory itself instead of just in specific folders...(ex. lib/core/*file like functions.php* instead of just  "lib/core/controller/filename.php")
 *
 * TODO: __construct()
 *      - Possibly change to protected and add $value - null as paramater to allow users to override the constructor so dev can change
 *          dir immideatly after calling constructor even when extended.
 *
 * TODO: autoload()
 *      before change(see commented section)
 *      -  add an exception handler.
 *      -  pop an exception when an exception could occur.
 *
 *      after change
 *      -  I need to adjust this function, it only accounts for 2 layer directories and nothing bigger.
 *      -  I can probably adjust this function to use the namespace as opposed to hardcoding it in the relative path.(ex. "core"/File.php -> "modName['namespace']"/File.php)
 *      -  Can probably break if the Dev. is looking for a file like Functions.php since it doesnt have a file type like controllers or models...(fix might be to loop 3 times and if not found just check for file in the folder itself. See notepad for possible solution.)
 *      -  Maybe check what
 *
 * TODO: registerAutoloader()
 *      - For some reason i cant get spl_ to work unless I do it in the class currently?
 */




class Core_Autoloader
{

    private $_fileTypes = array(
        '' => '',
        'Controller' => 'controllers',
        'Model' => 'models',
        'View' => 'views'
    );

    public function autoload($class = null)
    {
        $relativePath = $this->buildRelativePath($class);
        //no class was passed in...
        if($relativePath === null)
        {
            //should throw an exception here...
            return;
        }

        $classFound = false;

        foreach(Core_XMLConfig::getRegisteredModules() as $modName)                       //go through each module as a namespace and its file path.
        {
            foreach($this->_fileTypes as $fileType => $folderName)                                  //loop through each fileType as the type and its folderName.
            {
                if(empty($fileType))
                {
                    $newPath = getcwd() . DS . 'app' . DS . 'code' . DS . $modName['file_path'] . $relativePath;          //  make the new path
                    $newPath = explode(DS,  $newPath);                                              //  explode it so you can grab the "filename.php"
                    $fileName = array_pop($newPath);                                                //  grab filename
                    $fileLocation = implode(DS, $newPath) . DS . $folderName . DS . $fileName;      //  implode it, and make the correct new path.

                    if(file_exists($fileLocation))                                                  //  if: that file exists, require it once.
                    {
                        $classFound = true;
                        require_once $fileLocation;
                        //return $obj1 = new Task_IndexController;
                        break;
                    }
                }
                else
                {
                    if(strpos($relativePath, $fileType) !== false)                                      //if: the relative path contains the fileType string
                    {
                        $newPath = getcwd() . DS . 'app'. DS . 'code' . DS . $modName['file_path'] . DS . $relativePath;          //  make the new path
                        $newPath = explode(DS,  $newPath);                                              //  explode it so you can grab the "filename.php"
                        $fileName = array_pop($newPath);                                                //  grab filename
                        $fileLocation = implode(DS, $newPath) . DS . $folderName . DS . $fileName;      //  implode it, and make the correct new path.

                        if(file_exists($fileLocation))                                                  //  if: that file exists, require it once.
                        {
                            $classFound = true;
                            require_once $fileLocation;
                            //return $obj1 = new Task_IndexController;
                            break;
                        }                                                                               //  end if: file exists
                    }
                }                                                                                   //end if: relative path has filetype
            }                                                                                       //end inner foreach
        }                                                                                           //end outer foreach

        //class not found...
        if($classFound === false)
        {
            //todo: throw exception here
            echo'class not found exception here...';
            //just a quick exception test...
            throw new Exception();
        }

    }

    public function buildRelativePath($class = null){
        $relativePath = null;
        if($class){

            $folders = explode('_', $class);
            $fileName = array_pop($folders);

            if(count($folders) == 0)
            {
                $folders = explode('Controller', $fileName);
                $fileName = 'IndexController';

                //$relativePath = strtolower($folders[0]) . DS . ucfirst($fileName) . '.php';
                return $relativePath;
            }
            $relativePath = strtolower(implode(DS, $folders)) . (count($folders) >= 1 ? DS : '') . ucfirst($fileName) . '.php';

        }
        return $relativePath;

    }


    //will set autoload() as the ONLY __autoloader to use for the current project.
    public function registerAutoloader()
    {
        spl_autoload_register(null, false);
        spl_autoload_register(array($this, 'autoload'));
    }


}