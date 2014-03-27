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
        if(isset($_POST['taskDescriptionTbox']))
        {
            $dbObj = new Task_DbDataMapperModel();
            $dbObj->reorderTableIndex('Todo_List');
            $dbObj->addTaskToTable($_POST['taskDescriptionTbox']);
        }
        else
        {
            //todo: throw error about the user not adding anything into the textbox.
        }
        $this->render(__FUNCTION__);
    }

    public function delete($taskToDelete = null)
    {
        if($taskToDelete !== null)
        {
            if(count($taskToDelete) == 1)
            {
                foreach($taskToDelete as $key => $value)
                {
                    $taskToDelete = $value;
                }

                if($taskToDelete == '*')
                {
                    $dbObj = new Task_DbDataMapperModel();
                    $dbObj->reorderTableIndex('Todo_List');
                    $dbObj->deleteAllasksFromTable($taskToDelete);
                }
                else
                {
                    $dbObj = new Task_DbDataMapperModel();
                    $dbObj->reorderTableIndex('Todo_List');
                    $dbObj->deleteTasksFromTable($taskToDelete);
                }
            }
            else
            {
                //todo: throw error about the user passing to many paramaters to this function...
            }
        }
        else
        {
            //todo: throw error about the user not passing any information in to the method.
        }
        $this->render(__FUNCTION__);
    }

    //todo: update query and this function...
    public function update($taskToUpdate = null)
    {
        if($taskToUpdate !== null)
        {
            if(count($taskToUpdate) == 1)
            {
                foreach($taskToUpdate as $key => $value)
                {
                    $taskToDelete = $value;
                }
                $dbObj = new Task_DbDataMapperModel();
                $dbObj->reorderTableIndex('Todo_List');
                //you need to put the $_POST stuff here into an array...
                $dbObj->updateTasksFromTable($taskToUpdate);

            }
            else
            {
                //todo: throw error about the user passing to many parameters to this method...
            }
        }
        else
        {
            //todo: throw an error about user not passing anything into the method.
        }
        $this->render(__FUNCTION__);
    }


}