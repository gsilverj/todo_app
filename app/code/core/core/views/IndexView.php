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
        //set some of the inital variables up like the name of the current package and the current theme to use.
        $this->_designFilePath = getcwd() . DS . "app" . DS . "design";
        $this->_theme_to_use = Core_XMLConfig::getCurrentTheme();
        $this->_package_to_use = Core_XMLConfig::getPackageName();


        $this->parseLayouts($filename);

        // $this->compareAndOverwriteLayout();

        If ($this->_checkLayoutForCustomHandle())
        {
            $this->_handleCustomHandleContents();
        }





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
        $this->_targetLayout= simplexml_load_file( $this->_designFilePath . DS . "frontend" . DS . $this->_package_to_use . DS . $this->_theme_to_use . DS . "layout" . DS . "page.xml" );
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
                        $skeleton["skeletonFileName"] = $attributes["skeleton"];
                        $skeleton["isFound"] = true;
                    }
                }
            }
        }

        return $skeleton;
    }







//################################  New Stuff added Thursday June 5th, 2014



    //looks to see if there is a custom handle define, based on the current URI. (I set it to automatically look in the $_targetLayout that would be set before this function is called.
    //returns bool on existance.
    protected function _checkLayoutForCustomHandle($layout = null)
    {
        $customHandleExists = false;

        if($layout === null)
        {
            $layout = $this->_targetLayout;
        }

        //get the uri minus the first / and without the query. (it says replace the query string from the url that is found in the uri and then grab everything after the first character which is the '/')
        $targetCustomPageHandle = substr(str_replace($_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']), + 1);


        //if the target page handle is empty, chances are that they are trying to find the "core__index/index" page. (the reason its blank is because of the matchUri function in the bootstrap)
        if($targetCustomPageHandle == '')
        {
            $targetCustomPageHandle = 'core_index_index';
        }
        else
        {
            //get the target page handle and replace all '/' with underscores. todo: I think I might be able to 'trim()' the handle to make sure no whitespace or /'s are on the ends of the handle
            $targetCustomPageHandle = str_replace('/' , '_' , $targetCustomPageHandle);
        }

        //loop through the layout and look for the target page handle.
        foreach($layout as $pageHandle)
        {
            echo $pageHandle->getName();
            if((string)$pageHandle->getName() == $targetCustomPageHandle)
            {
                $customHandleExists = true;
                break;
            }
        }

        return $customHandleExists;
    }


    //check if the found custom handle has any contents, and if it does, handle it. (tell it what to do/method to use)
    //returns a layout in simpleXml format.
    protected function _handleCustomHandleContents()
    {

        /**
         * Just for future reference for me, I am just now in the process of adding code to handle what happens when a custom page handle is found
         *     and what to do based on the method found inside of that handle.
         */


        //the layout will be the layout that is being targeted by the user.
        $layout = $this->_targetLayout;

        //get the uri minus the first / and without the query. (it says replace the query string from the url that is found in the uri and then grab everything after the first character which is the '/')
        $targetCustomPageHandle = substr(str_replace($_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']), + 1);

        //if the target page handle is empty, chances are that they are trying to find the "core__index/index" page. (the reason its blank is because of the matchUri function in the bootstrap)
        if($targetCustomPageHandle == '')
        {
            $targetCustomPageHandle = 'core_index_index';
        }
        else
        {
            //get the target page handle and replace all '/' with underscores. todo: I think I might be able to 'trim()' the handle to make sure no whitespace or /'s are on the ends of the handle
            $targetCustomPageHandle = str_replace('/' , '_' , $targetCustomPageHandle);
        }

        foreach($layout as $pageHandle)
        {
            echo $pageHandle->getName();
            if((string)$pageHandle->getName() == $targetCustomPageHandle)
            {
                $customHandleExists = true;
                break;
            }
        }



    }


    //add a brand new block to the Default Layout (the one the will be used when rendering to the screen)
    protected function _addBlockToDefaultLayout()
    {}


    //this will add something (mainly an action) to a block that already exists in default.
    protected function _addActionToExistingBlock()
    {}


    //remove all of the contents of an existing block, and add new contents to it. (so like remove->add for an existing block)
    protected function _updateExistingBlock()
    {}


    //remove an existing block and all its contents from default layout.
    protected function _removeExistingBlock()
    {}


}