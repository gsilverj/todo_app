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


class Core_IndexController {

    protected $_view = 'DefaultView';

    public function index(){

        if($class = $this->getViewClass(__CLASS__, __FUNCTION__)){
            $class = new $class;
            return $class->render();
        }
        die('Died in Core_IndexController::index()');
    }


    /**
     * @param null $intent
     */
    protected function _add($intent = null)
    {

    }


    /**
     * @param null $intent
     */
    protected function _delete($intent = null)
    {

    }


    /**
     * @param null $intent
     */
    protected function _reload($intent = null)
    {

    }



    protected function getViewClass($class = false, $function = false){
        $viewClass = false;
        if($class && $function){
            $viewClass = Core_Bootstrap::getModuleNameFromClass($class) . '_' . ucwords($function) . 'View' ;
        }
        return $viewClass;
    }













    //Other stuff if needed?

    /**
     * @description : This function will check if the $intent passed in is a valid non-null/non-numeric string.
     *                  If true, return 'index', otherwise return $intent.
     *
     * @param null $intent
     * @return string
     */
    protected function _validateIntent($intent = null)
    {
//        if(is_null($intent) || is_numeric(substr($intent, 0, 1)))
//        {
//            //pop exception
//            $intent = 'index';
//        }


        return (is_null($intent) || is_numeric((substr($intent, 0 , 1)))) ? 'index' : $intent;
    }



}