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
 *
 *
 *
 * TODO's:
 *
 *      ALL:
 *          -Maybe include validation for the  _setCurrentRequest() & public getTaskRequest() functions.
 *
 *      getTaskRequest():
 *          - Make validation (or use a class) to make sure a valid request string literal has been made.
 *
 *      getTaskRoute():
 *          - This functions WILL BREAK if the URI needs paramaters, need to fix.(ex. method/func() <- will work, method/func()/param1/param2 <- will not.)
 *          - May not work correctly if there is a " " before the $newRequest passed in, might fix by trimming white space before checking.
 *
 *
 *
 *
 */



class Task_TaskController
{

    private $_currentRequest = '';
    private $_currentRoute= '';

    //gets
    private function _getCurrentRequest()    { return $this->_currentRequest;}
    //sets
    private function _setCurrentRequest($newRequest)    {$this->_currentRequest = $newRequest;}


    public function index(){
        die('Died in Task_TaskController::index()');
    }


    function __construct()
    {}

    //others


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

        //if newRequest is null or starts with a number :  return the index route.
        if($newRequest === null || is_numeric(substr($newRequest, 0, 1 ))== true)
        {
            return $route;
        }
        else
        {
            self::_setCurrentRequest($newRequest);
        }

        //load uri?
        //$obj = new object();

        \lib\core\Core_Bootstrap::matchUri();



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