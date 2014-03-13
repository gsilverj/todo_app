<?php
/**
 * Created by PhpStorm.
 * User: incubator
 * Date: 3/13/14
 * Time: 1:23 PM
 */

class Core_IndexView {


    protected $_templateDir;
    protected $_defaultTemplate = 'index/index.php';
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
    }

    public function render(){
        die($this->getTemplate());
    }

    public function getTemplate(){
        //include_once $this->_templateDir . strtolower(Core_Bootstrap::getModuleNameFromClass(__CLASS__)) . DS .  'index' . DS . $this->_template;

        $view = $this->_templateDir . strtolower(Core_Bootstrap::getModuleNameFromClass(__CLASS__)) . DS;
        $template = $this->_defaultTemplate;
        $viewTemplate = $view . $template;


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