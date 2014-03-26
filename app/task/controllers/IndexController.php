<?php
/**
 * Created by PhpStorm.
 * User:            Gabriell J.
 * Date:            3/5/14
 * Time:            2:11 PM
 *
 * @catagory    IndexController
 * @package     Core_IndexController
 */

//Todo: Maybe include validation for the  _setCurrentRequest() & public getTaskRequest() functions.


class Task_IndexController extends Core_IndexController
{
    /**
     * Task_IndexView
     * Task_AddView
     */
    public function index()
    {
        $this->render();
    }
    public function add()
    {
        $dbObj = new Task_DbDataMapperModel();
        $dbObj->reorderTableIndex('Todo_List');
        $dbObj->addTaskToTable($_POST['taskDescriptionTbox']);
        $this->render(__FUNCTION__);
    }
    public function delete()
    {
        $dbObj = new Task_DbDataMapperModel();
        $dbObj->reorderTableIndex('Todo_List');
        //you need to put the $_POST stuff here into an array...
        $dbObj->deleteTasksFromTable(array());
        $this->render(__FUNCTION__);
    }
    public function reload()
    {
        $this->render(__FUNCTION__);
    }


}