<?php
/**
 * Created by PhpStorm.
 * User: incubator
 * Date: 3/13/14
 * Time: 1:20 PM
 */

class Task_ReloadView extends Core_IndexView {


    public function render(){
        die($this->getTemplate());
    }

    public function getTemplate(){
        //include_once $this->_templateDir . strtolower(Core_Bootstrap::getModuleNameFromClass(__CLASS__)) . DS .  'index' . DS . $this->_template;

        $view = $this->_templateDir . strtolower(Core_Bootstrap::getModuleNameFromClass(__CLASS__)) . DS;
        $template = $this->_defaultTemplate;
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


} 