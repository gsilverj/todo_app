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
    private $_currentRoute= '';

    //gets
    private function _getCurrentRequest()    { return $this->_currentRequest;}
    //sets
    private function _setCurrentRequest($newRequest)    {$this->_currentRequest = $newRequest;}





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


        //todo: this may not work correctly if there is a " " before the $newRequest passed in, might fix by trimming white space before checking.
        //if newRequest is null or starts with a number return the index route.
        if($newRequest === null || is_numeric(substr($newRequest, 0, 1 ))== true)
        {
            return $route;
        }
        else
        {
            self::_setCurrentRequest($newRequest);
        }


        //split up the currentRequest by "::" after trimming off the "()" at the end of the string.
        $routeArray = explode('::', rtrim($this->_currentRequest, "()"));

        //***get the dir of the .php file to look for;
        $routeFunctionName = $routeArray[1];        //set the function part of the array as this variable.
        /*$routeDir = explode('_', $routeArray[0]);   //explode the first element of the array into this array. (they are now seperated by '_')




        $routeFolderName = '';
        //find the last occurance of a cap letter, and that first part is the  "filename".php, the second part is part of the
        //essentially get the length of the string of the #th element of the routeDir array....
        // todo: -1 so that length of char array == the correct letter... eh? come back to this
        for($i = (mb_strlen($routeDir[count($routeDir)])); $i >= 0; $i--)
        {
            if(ctype_upper($routeDir[$i]))
            {
                $routeFolderName = (substr(routeDire[$i])));
                break;
            }

        }





        $routeFilename = '';
*/


        //create the object to see if it exists and then unset to destroy the object used.







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