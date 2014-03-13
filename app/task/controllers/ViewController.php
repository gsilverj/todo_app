<?php
/**
 * Created by PhpStorm.
 * User:            Gabriell J.
 * Date:            3/5/14
 * Time:            2:15 PM
 * Project Name:    ViewController.php (tasks.dev/lib/core/controllers/ViewController.php   project)
 */

class Task_ViewController Extends Core_IndexController
{

    public function index(){
        die('Died in Task_ViewController::index()');
    }

    function _add()
    {
        die('Died in Task_ViewController::_add()');
    }

    function _delete()
    {
        die('Died in Task_ViewController::_delete()');
    }

    function _reload()
    {
        die('Died in Task_ViewController::_reload()');
    }


    function _displayView($intent = null)
    {
        $requestedView = parent::_validateIntent($intent);



    }
}