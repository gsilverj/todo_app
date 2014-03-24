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
        $dbMapper = new Task_DbDataMapperModel();
//        $dbMapper->reorderTableIndex('Todo_List');
//        $dbMapper->addTaskToTable('tester for the deletion thing');
//        $dbMapper->displayTableFromDatabase('Todo_List');
//        $dbMapper->deleteTasksFromTable('17');
//        $dbMapper->displayTableFromDatabase('Todo_List');
//        $dbMapper->reorderTableIndex('Todo_List');
        $dbMapper->displayTableFromDatabase('Todo_List');

        $this->render();
    }
    public function add()
    {
        $this->render(__FUNCTION__);
    }
    public function delete()
    {
        $this->render(__FUNCTION__);
    }
    public function reload()
    {
        $this->render(__FUNCTION__);
    }


}