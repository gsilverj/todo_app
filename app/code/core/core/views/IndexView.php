<?php
/**
 * Created by PhpStorm.
 * User: Gabriell Juliana
 * Date: 3/13/14
 * Time: 1:23 PM
 */


class Core_IndexView
{

    protected $_designFilePath;

    protected $_defaultLayout;  //the default pages xml
    protected $_targetLayout;   //the target pages xml
    protected $_targetTemplateLocation;
    protected $_targetTemplate; //the template to load when asked requested.

    protected $_theme_to_use;
    protected $_package_to_use;


    //do this in a try catch incase of an error happening when loading custom page...
    public function loadLayout($filename = null)
    {
        $this->_designFilePath = getcwd() . DS . "app" . DS . "design";
        $this->parseLayouts($filename);


        $this->_theme_to_use = Core_XMLConfig::getCurrentTheme();

        //force package name to lowercase
        $package = explode('_', (get_called_class()));
        $package[0] = strtolower($package[0]);
        $this->_package_to_use =  $package[0];

        $this->compareAndOverwriteLayout();

        //skeleton[isFound=>bool, skeletonFileName=>"filename"]
        $skeleton = $this->getPageSkeleton();
        if($skeleton["isFound"] == true)
        {
            $this->_targetTemplateLocation = $this->_designFilePath . DS . "frontend" . DS . $this->_package_to_use . DS . $this->_theme_to_use . DS . "template" . DS . $skeleton["skeletonFileName"];
        }
        else
        {                                                           // destination  / package name / Theme OR Exception (device name) / template/  module name / template file
            //force page to be core's...
            $this->_targetTemplateLocation = $this->_designFilePath . DS . "frontend" . DS . "core" . DS . "default" . DS . "template" . DS . "page" . DS . "1column.phtml";
        }

    }

    protected function parseLayouts($modname = null)
    {
        $this->_defaultLayout = simplexml_load_file( $this->_designFilePath . DS . "frontend" . DS . "core" . DS . "default" . DS . "layout" . DS . "page.xml");
        //$this->_targetLayout= simplexml_load_file( $this->_designFilePath . DS . "frontend" . DS . $modname . DS . "layout" . DS . "page.xml" );
    }

    //todo: im not really sure how to handle this :(
    protected function compareAndOverwriteLayout()
    {
        $this->_targetLayout = $this->_defaultLayout;
    }

    public function renderLayout()
    {
        include_once $this->_targetTemplateLocation;
    }


    //todo: you can probably set up an array of "methods" that this function will run too and define the action to take. also define methods for each of the "methods" that would be in this array to make it more modular.
    protected function getTemplate($blockName)
    {
        //This will probably only go 2 layers in before checking for handle attributes...
        //This will break if more then one paramater is passed into a block...

        foreach($this->_targetLayout->children() as $page_layout)
        {
            foreach($page_layout as $handle)
            {
                if($handle->getName() == 'block')
                {
                    $attributes = $handle->attributes();

                    if($attributes["name"] == $blockName)
                    {
                        foreach($handle as $action => $param)
                        {
                            $method = $param->attributes();

                            if($method == "addTemplate")
                            {

                                include_once $this->getFileLocation($param, "template");
                            }

                            elseif($method == "addBootstrap")
                            {
                                //assets file
                                echo "<link href='" . Core_XMLConfig::getBaseUrl() . "assets/css/bootstrap.min.css' rel='stylesheet'>";
                            }

                            elseif($method == "addCss")
                            {
                                //skin file CSS
                                echo "<link href='" . $this->getFileLocation($param, "css") . "' >";
                            }

                            elseif($method == "addJs")
                            {
                                //skin file JS
                                echo "<link href='" . $this->getFileLocation($param, "js") . "' >";
                            }

                            elseif($method == "item")
                            {
                                echo "<link href='" . $this->getFileLocation($param, "item") . "' >";
                            }
                        }
                    }
                }
            }
        }
    }

    //file type refers to css = skin, js = assets folder, item = *mystery*, template = template folder...
    protected function getFileLocation($param, $fileType = null)
    {
                                                                  //module_to_use
        $fileLocation = $this->_designFilePath . DS . "frontend" . DS . $this->_package_to_use . DS . $this->_theme_to_use;

        if($fileType == "template")
        {
            //will go to design directory
            $fileLocation = $fileLocation . DS . $fileType . DS . $param;
            $fileLocation = $this->decideWhichThemeIsNeeded($param, $fileType ,$fileLocation);
        }
        elseif($fileType == "css")
        {
            //will go to skin directory
            $fileLocation = getcwd() . DS . "skin" . DS . "frontend" . DS . $this->_package_to_use . DS . $this->_theme_to_use . DS . $fileType . DS . $param;
            $fileLocation = $this->decideWhichThemeIsNeeded($param, $fileType, $fileLocation);
        }
        elseif($fileType == "js")
        {
            //will go to assets directory
            $fileLocation = getcwd() . DS . "assets" . DS . $fileType . DS . $param;
            $fileLocation = $fileLocation . DS . $fileType . DS . $param;
        }
        elseif($fileType == "item" || $fileType == null)
        {
            //will go where you tell it to go...
            $fileLocation = getcwd() . DS . $param;
        }

        return $fileLocation;
    }

    //expected for use when looking for css and templates...
    protected function decideWhichThemeIsNeeded($param, $fileType,  $fileLocation)
    {
        $finalFileLocationByTheme = $fileLocation;

        if($fileType == "template")
        {
            if(!file_exists($fileLocation))
            {
                $rollbackFileLocation = $this->_designFilePath . DS . "frontend" . DS . $this->_package_to_use . DS . Core_XMLConfig::getRollbackTheme() . DS . $fileType . DS . $param;
                if(file_exists($rollbackFileLocation))
                {
                    $finalFileLocationByTheme = $rollbackFileLocation;
                }
                else
                {
                    $defaultFileLocation = $this->_designFilePath . DS . "frontend" . DS . "core" . DS . Core_XMLConfig::getDefaultTheme() . DS . $fileType . DS . $param;
                    if(file_exists($defaultFileLocation))
                    {
                        $finalFileLocationByTheme = $defaultFileLocation;
                    }
                }
            }
        }
        else //must mean its css that we are looking for...
        {
            if(!file_exists($fileLocation))
            {
                $rollbackFileLocation = getcwd() . DS . "skin" . DS . "frontend" . DS . $this->_package_to_use . DS . Core_XMLConfig::getRollbackTheme() . DS . $fileType . DS . $param;
                if(file_exists($rollbackFileLocation))
                {
                    $finalFileLocationByTheme = $rollbackFileLocation;
                }
                else
                {
                    $defaultFileLocation = getcwd() . DS . "skin" . DS . "frontend" . DS . "core" . DS . Core_XMLConfig::getDefaultTheme() . DS . $fileType . DS . $param;
                    if(file_exists($defaultFileLocation))
                    {
                        $finalFileLocationByTheme = $defaultFileLocation;
                    }
                }
            }
        }

        return $finalFileLocationByTheme;
    }


    protected function getPageSkeleton()
    {
        $skeleton = array("isFound"=>"false","skeletonFileName"=>"");

        foreach($this->_targetLayout->children() as $page_layout)
        {
            foreach($page_layout as $handle)
            {
                if($handle->getName() == 'page')
                {
                    $attributes = $handle->attributes();

                    if(isset($attributes["skeleton"]))
                    {
                        $skeleton = $attributes["skeleton"];
                        $foundSkeleton = true;
                        $skeleton["isFound"] = true;
                    }
                }
            }
        }

        return $skeleton;
    }
}