<?php
/**
 * Created by PhpStorm.
 * User: incubator
 * Date: 3/10/14
 * Time: 12:49 PM
 */




/*  Todo's:
 *
 *      _validateIntent
 *          -   Need to pop an exception on false...
 *
 */


class Core_IndexController {

    public function index(){
        die('Died in Core_IndexController::index()');
    }


    /**
     * @param null $intent
     */
    protected function _add($intent = null)
    {
        $view = new Task_ViewController();

        $intent = self::_validateIntent($intent);

        $view->displayView($intent);
    }


    /**
     * @param null $intent
     */
    protected function _delete($intent = null)
    {
        $view = new Task_ViewController();

        $intent = self::_validateIntent($intent);

        $view->displayView($intent);
    }


    /**
     * @param null $intent
     */
    protected function _reload($intent = null)
    {
        $view = new Task_ViewController();

        $intent = self::_validateIntent($intent);

        $view->displayView($intent);
    }


    /**
     * @description : This function will check if the $intent passed in is a valid non-null/non-numeric string.
     *                  If true, return 'index', otherwise return $intent.
     *
     * @param null $intent
     * @return string
     */
    private function _validateIntent($intent = null)
    {
//        if(is_null($intent) || is_numeric(substr($intent, 0, 1)))
//        {
//            //pop exception
//            $intent = 'index';
//        }


        return (is_null($intent) || is_numeric((substr($intent, 0 , 1)))) ? 'index' : $intent;
    }
} 