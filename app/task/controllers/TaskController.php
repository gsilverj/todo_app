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

    public function index(){
        die('Died in Task_TaskController::index()');
    }


    function __construct()
    {}





    function add()
    {}

    function delete()
    {}

    function updateTask()
    {}

}