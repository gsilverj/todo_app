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



    //do this in a try catch incase of an error happening when loading custom page...
    public function loadLayout($filename = null)
    {
        $this->_designFilePath = getcwd() . DS . "app" . DS . "design";
        $this->parseLayouts($filename);
                                                                    // destination  / package name / Exception (device name) / template/  module name / template file
        $this->_targetTemplateLocation = $this->_designFilePath . DS . "frontend" . DS . "core" . DS . "default" . DS . "template" . DS . "page" . DS . "1column.phtml";
    }

    protected function parseLayouts($modname = null)
    {
        $this->_defaultLayout = simplexml_load_file( $this->_designFilePath . DS . "frontend" . DS . "core" . DS . "default" . DS . "layout" . DS . "page.xml");
        //$this->_targetLayout= simplexml_load_file( $this->_designFilePath . DS . "frontend" . DS . $modname . DS . "layout" . DS . "page.xml" );
    }

    protected function compareAndOverwriteLayout()
    {
        //foreach($this->_defaultLayout as )

    }

    public function renderLayout()
    {
        include_once $this->_targetTemplateLocation;
    }

    protected function getTemplate($blockName)
    {
        //This will probably only go 2 layers in before checking for handle attributes...
        //This will break if more then one paramater is passed into a block...

        foreach($this->_defaultLayout->children() as $page_layout)
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
                                include_once $this->_designFilePath . DS . "frontend" . DS . "core" . DS . "default" . DS . "template" . DS . $param;
                            }

                            elseif($method == "addBootstrap")
                            {
                                //assets file
                                echo "<link href='" . Core_XMLConfig::getBaseUrl() . "assets/css/bootstrap.min.css' rel='stylesheet'>";
                            }

                            elseif($method == "addCss")
                            {
                                echo "<link href='" . getcwd() . DS . "skin" . DS . "frontend" . DS . "core" . DS . "default" . DS . "css" . DS . $param;
                            }

                            elseif($method == "addJs")
                            {
                                echo "<link href='" . getcwd() . DS . "skin" . DS . "frontend" . DS . "core" . DS . "default" . DS . "js" . DS . $param;
                            }
                        }
                    }
                }
            }
        }
    }

}