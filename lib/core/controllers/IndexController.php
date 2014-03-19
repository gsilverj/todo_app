<?php
/**
 * Created by PhpStorm.
 * User: incubator
 * Date: 3/10/14
 * Time: 12:49 PM
 */




/*  Todo's:
 *
 *
 */


class Core_IndexController
{

    //this may not be needed...
    protected $_view = 'DefaultView';

    public function index(){

        if($class = $this->getViewClass(__CLASS__, __FUNCTION__)){
            $class = new $class;
            $class->render();
        }
        die('Died in Core_IndexController::index()');
    }


    protected function getViewClass($class = false, $function = false){
        $viewClass = false;
        if($class && $function){
            $viewClass = Core_Bootstrap::getModuleNameFromClass($class) . '_' . ucwords($function) . 'View' ;
        }
        return $viewClass;
    }

    protected function render($function = null)
    {
        if($function !== null)
        {
            if($class = $this->getViewClass(get_class($this), $function))
            {
                $class = new $class;
                $class->render();
            }
        }
        else
        {
            //maybe throw exception?...
            $class = $this->getViewClass(get_class($this), 'index');
            $class = new $class;
            $class->render();
        }
    }













}