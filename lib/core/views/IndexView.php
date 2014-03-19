<?php
/**
 * Created by PhpStorm.
 * User: Gabriell Juliana
 * Date: 3/13/14
 * Time: 1:23 PM
 */

class Core_IndexView {

    protected $_pagePieces; //is an array...
    protected $_templateDir;
    protected $_themeDir;
    ######you need to change this!!!!!!!!!!!!!!!!!!!   (can probably set to ~ core_theme/index/index.php or 404_theme/404/404.php etc...)
    protected $_defaultTemplate = 'index/index.php';
    protected $_errorTemplate = "four_oh_four/four_oh_four.php";
    protected $_targetTemplate;


    public function __construct(){
        //change this to grab the registered_templates or something and use it like the autoloader to get the templates that are available
        $this->_templateDir = getcwd() . DS . 'templates' . DS;
        $this->_themeDir = getcwd() . DS . 'themes' . DS;
        $this->_targetTemplate = $this->_defaultTemplate;
    }


    //gets & sets

    protected  function getTemplateDir()        {return $this->_templateDir;}
    protected  function getErrorTemplate()      {return $this->_errorTemplate;}
    protected  function getTargetTemplate()    {return $this->_targetTemplate;}

    protected  function setTemplateDir($newTemplateDir)         {$this->_templateDir = $newTemplateDir;}
    protected  function setErrorTemplate($newErrorTemplate)     {$this->_errorTemplate = $newErrorTemplate;}

    //allow user to change the default template. (can now change the _defaultTemplate to the desired view template or folder layout for view)
    protected  function setTargetTemplate($newTargetTemplate = null)
    {
        if($newTargetTemplate === null || is_numeric(substr($newTargetTemplate, 0 , 1)))
        {
            //throw Exception for it being null, or its not a valid string because it starts with a number and no classes/modules are allowed to start with a #.
            return;
        }
        else
        {
            if($newTargetTemplate == '')
            {
                $this->_targetTemplate = $newTargetTemplate;
            }
            elseif(strpos($newTargetTemplate, '_') !== false)
            {
                //  ex ( the template will now be add/add.php, since the input wasnt a vaild file directory so it must be a class Name
                $className = explode('_' ,$newTargetTemplate);

                //the below line may not be being used at all?!?!?!
                // move to the last element in the array,
                // if the className[lastElement] is not false, reset to the 1st element and then use the last elements value,
                //  otherwise use 'indexview', and then lowercase it all
                $className = strtolower((end($className) !== false ? current($className) : 'indexview'));
                //cut off 'view'
                $className = str_replace('view', '', $className);

                $this->_targetTemplate = $className . DS . $className . '.php';
            }
            else
            {
                $this->_targetTemplate = $newTargetTemplate;
            }
        }
    }



    //other functions
    public function render()
    {
        //todo: SUPER IMPORTANT, THIS SHOULD NOT BE HARDCODED, IT DOESNT MAKE ANY SENSE, JUST MAKE ANOTHER METHOD FOR IT...
        $this->getTemplate(false, 'index.php');
    }


    //possibly change to getTemplate(template = false, module = false) so I wont have to always include a module when I call function...
    public function getTemplate($module = false, $template = false){
        //include_once $this->_templateDir . strtolower(Core_Bootstrap::getModuleNameFromClass(__CLASS__)) . DS .  'index' . DS . $this->_template;
        //set the _targetTemplate;


        /*  old version to pull up the templates when they were in a templates folder instead...
        $view = $this->_templateDir . (($module) ? $module : strtolower(Core_Bootstrap::getModuleNameFromClass(get_class($this)))) . DS;
        $template = ($template) ? $template : $this->_targetTemplate;
        $viewTemplate = $view . $template;
        */
        self::getThemeTemplatePiece($template);
//        if(!file_exists($viewTemplate))
//        {
//            $view = $this->_templateDir . 'four_oh_four' . DS;
//            $template = $this->_errorTemplate;
//            $viewTemplate = $view . $template;
//
//            //if even the 404 cant be found throw exception and default back to index?
//        }
//
//        include_once $viewTemplate;

      }

    public function getHeader()
    {
        $this->getTemplate(false, 'header.php');
    }

    public function getHead()
    {
        $this->getTemplate(false, 'head.php');
    }

    public function getBaseUrl($url = null)
    {
        echo ($url === null) ? 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] : $url;
    }

    public function getThemeTemplatePiece($piece = false)
    {
        //var_dump($piece);
        //todo:need to check if piece also starts with a number...
        if($piece === false)
        {
            //throw exception or maybe throw 404?...
        }
        else
        {
            //can probably set this up in the config to tell me which XMLConfig.php file to use, so others can change/override...(results in not hardcoded 'Core_XMLConfig::function()'
            $currentTheme = Core_XMLConfig::getCurrentTheme();
            $themeList = Core_XMLConfig::getRegisteredThemes();

            //search through the themes for the piece requested, starting only in the currentTheme's folders.
            foreach($themeList as $themeName => $folderList)
            {
                if((string)$themeName == $currentTheme)
                {
                    foreach($folderList as $folder => $folderName)
                    {
                        foreach($folderName as $name)
                        {
                            $pieceFileLocation = $this->_themeDir . $currentTheme . DS . (string)$name . DS . $piece;
                            if(file_exists($pieceFileLocation))
                            {
                                include_once $pieceFileLocation;
                                return;
                            }
                        }
                    }
                }
            }

            //file wasnt found in current theme so now search through all of the themes in order of the config.xml file...
            foreach($themeList as $themeName => $folderList)
            {
                foreach($folderList as $folder => $folderName)
                {
                    foreach($folderName as $name)
                    {
                        $pieceFileLocation = $this->_themeDir . (string)$themeName . DS . (string)$name . DS . $piece;
                        if(file_exists($pieceFileLocation))
                        {
                            include_once $pieceFileLocation;
                            return;
                        }
                    }
                }
            }


            //if even the 404 cant be found throw exception and default back to index?

            //piece wasnt found in any of the themes so now look for a 404 page...
            $four_oh_four_piece = 'four_oh_four.php';
            foreach($themeList as $themeName => $folderList)
            {
                foreach($folderList as $folder => $folderName)
                {
                    foreach($folderName as $name)
                    {
                        $pieceFileLocation = $this->_themeDir . (string)$themeName . DS . (string)$name . DS . $four_oh_four_piece;
                        if(file_exists($pieceFileLocation))
                        {
                            include_once $pieceFileLocation;
                            echo '404 page thrown for the ' . $piece;
                            return;
                        }
                    }
                }
            }

            //Throw exception here because that means that the not only the piece, but even the 404 page wasnt found...
            echo 'EXCEPTION THROWN HERE AT CORE/.../IndexView.php, because the piece ' . $piece . ' AND the 404 page weren\'t found...';
        }

    }






    // v-- below hasn't been tested but it should work theoretically.
    public function setUpPage($pieceDirToAdd = false)
    {
        if($pieceDirToAdd !== false)
        {
            if(count($this->_pagePieces))
            {
                $this->_pagePieces[count($this->_pagePieces)] = $pieceDirToAdd;
            }
            else
            {
                $this->_pagePieces[0] = $pieceDirToAdd;
            }
        }
    }

    public function loadPagePieces($pagePieceList = null)
    {
        if($pagePieceList === null)
        {
            foreach($this->_pagePieces as $piece)
            {
                $this->getTemplate(false, $piece);
            }
        }
        else
        {
            foreach($pagePieceList as $piece)
            {
                $this->getTemplate(false, $piece);
            }
        }
    }





} 