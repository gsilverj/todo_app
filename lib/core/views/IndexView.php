<?php
/**
 * Created by PhpStorm.
 * User: Gabriell Juliana
 * Date: 3/13/14
 * Time: 1:23 PM
 */

class Core_IndexView {


    protected $_templateDir;
    ######you need to change this!!!!!!!!!!!!!!!!!!!
    protected $_defaultTemplate = 'index/index.php';
    protected $_errorTemplate = "four_oh_four/four_oh_four.php";
    protected $_targetTemplate;
    /* test array for use of the "fallback" structure....
     * private $validTemplateLocations = array(            //think namespace->foldername->filePurpose & fileName

        'task' => array(
            'index' => array(
                'index'      => 'index.php'           ,
                'taskAdd'    => 'taskAddIndex.php'    ,
                'taskDelete' => 'taskDeleteIndex.php' )
            ),

        'core' => array(
            'index' => array(
                'index'      => 'index.php'           ,
                'taskAdd'    => 'taskAddIndex.php'    ,
                'taskDelete' => 'taskDeleteIndex.php' )
            )

        );
*/


    public function __construct(){
        //change this to grab the registered_templates or something and use it like the autoloader to get the templates that are available
        $this->_templateDir = getcwd() . DS . 'templates' . DS;
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
    public function render(){
        die($this->getTemplate());
    }

    public function getTemplate(){
        //include_once $this->_templateDir . strtolower(Core_Bootstrap::getModuleNameFromClass(__CLASS__)) . DS .  'index' . DS . $this->_template;
        //set the _targetTemplate;

        $view = $this->_templateDir . strtolower(Core_Bootstrap::getModuleNameFromClass(get_class($this))) . DS;
        $template = $this->_targetTemplate;
        $viewTemplate = $view . $template;

        if(!file_exists($viewTemplate))
        {
            $view = $this->_templateDir . 'four_oh_four' . DS;
            $template = $this->_errorTemplate;
            $viewTemplate = $view . $template;
        }

        include_once $viewTemplate;


        //only needed if a "fallback" structure is desired for the view templates...
        //$viewTemplate = $viewTemplate . $this->getTemplateAndFolder();
    }

/*  this is only needed if "fallback" for the views are needed...
    //must change to allow inclusion of $_registeredTemplates and to include passing in a template name.
    private function getTemplateAndFolder($validTemplateLocations = null)
    {
        $foundTemplate = false;
        $folderList = '';
        //obviously need to change the above and directly below code for future implementations besides testing...
        if ($validTemplateLocations !== null)
        {
           $folderList = $validTemplateLocations;
        }
        else
        {
            $folderList = $this->validTemplateLocations;
        }


        foreach($folderList as $namespace => $folderName)
        {
            foreach($folderName as $filePurpose => $fileName)
            {
                foreach($fileName as $file => $fileLocation)
                if(strpos($file, 'index') !== false)
                {
                    if(file_exists($this->_templateDir . strtolower(Core_Bootstrap::getModuleNameFromClass(__CLASS__)) . DS . $this->_defaultTemplate))
                    {
                        var_dump($file);
                        var_dump($fileLocation);
                        $templateAndFolderLocation = $file . DS . $fileLocation;
                        var_dump($templateAndFolderLocation);
                        return $templateAndFolderLocation;
                    }

                }
            }
        }

        if ($foundTemplate === false)
        {
            $folderName = $this->_defaultTemplate;
        }
        return $folderName;
    }
*/



} 