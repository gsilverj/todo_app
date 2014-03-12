<?php
/**
 * Created by PhpStorm.
 * User:            Gabriell J.
 * Date:            3/5/14
 * Time:            2:11 PM
 * Project Name:    TaskController.php (tasks.dev/lib/core/controllers/TaskController.php   project)
 *
 *
 * @catagory    TaskController
 * @package     Core_TaskController
 */

//Todo: Maybe include validation for the  _setCurrentRequest() & public getTaskRequest() functions.


class Core_TaskController
{

    private $_currentRequest = '';

    //gets
    private function _getCurrentRequest()    { return $this->_currentRequest;}
    //sets
    private function _setCurrentRequest($newRequest)    {$this->_currentRequest = $newRequest;}



    function index()
    {
        die('Died in Core_TaskController::index()');
    }


    function __construct()
    {}

    //others


    //TODO: Make validation (or use a class) to make sure a valid request string literal has been made.
    //@Description:     This function will get the task request from a URI when a user action happens and set it to _currentRequest.
    //                      It will then return _currentRequest.(ex. button click)
    //
    //@depends  : n/a
    //@input    : n/a
    //@return   : $_currentRequest
    public function getTaskRequest($newRequest = null)
    {
        $this->_currentRequest = (($this->_setCurrentRequest($newRequest) === null) ? false  : $newRequest);
        return  $this->_currentRequest;
    }

    //TODO: This functions WILL BREAK if the URI needs paramaters, need to fix.(ex. method/func() <- will work, method/func()/param1/param2 <- will not.)
    //@Description:     This function will take the request and look for it's route in the program. Essentially checking for its existance
    //                      as a class and method. It will then return a route based on the URI. If the input is blank , it will use the
    //                      $_currentRequest's value. If empty
    //
    //                  Ex. valid uri      = URI route
    //                      wrong class    = IndexController::index()  <- or index.php
    //                      wrong func     = MethodClass::index()
    //                      invalid uri    = IndexController::index()
    //                      null input     = IndexController::index()
    //
    //@depends  : Autoloader.php (core_autoloader::autoload has been set as __autoload)
    //@input    : n/a
    //@return   : $route (tasks route)
    public function getTaskRoute($newRequest = null)
    {
        //set a default $route, just incase
        $route = 'IndexController::index()';


        //if newRequest is null or starts with a number do this
        if($newRequest === null || is_numeric($newRequest) == true)
        {
            self::_getCurrentRequest($newRequest);
        }
        else
        {
            return $route;
        }





        return  $route;
    }

    //todo: find a better name for this function.
    //@Description:
    //
    //
    //
    public function dispatchRequest()
    {

    }

    //@Description:
    //
    //
    //
    public function getResponse()
    {

    }






    function add()
    {}

    function delete()
    {}

    function updateTask()
    {}

}