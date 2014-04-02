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
        //reset the Registry's last_task value back to null
        Task_Registry::set('last_task', null);
        $this->render();
    }

    public function add()
    {
        //reset the Registry's last_task value back to null
        Task_Registry::set('last_task', null);

        //it is expected to get only the value of the $_Post['taskDescriptionTbox'].
        $param = $this->getParam('taskDescriptionTbox', 'post');

        if($param != null)
        {
            $dbObj = new Task_DbDataMapperModel();
            $dbObj->reorderTableIndex('Todo_List');
            $dbObj->addTaskToTable($param);
            //tell the registry what the last task was if the task worked
            Task_Registry::set('last_task', __FUNCTION__);
        }
        else
        {
            //todo: throw, you must put something into the textbox, exception.
        }

        $this->render(__FUNCTION__);
    }

    //todo: Be aware that this method doesnt check to see if that TaskId actually exists or not, its just a happy accident that it does not break. You can probably just check if the task id exists in the table with a query (prob. select * where taskid = blah) and if it returns a result set it means it exists, otherwise it doesnt and either throw exception or do nothing to the database.
    public function delete($taskToDelete = null)
    {
        //reset the Registry's last_task value back to null
        Task_Registry::set('last_task', null);

        if($taskToDelete !== null)
        {
            if(count($taskToDelete) == 1)
            {
                if(is_assoc($taskToDelete))
                {
                    foreach($taskToDelete as $key => $value)
                    {
                        $taskToDelete = $value;
                    }

                    if($taskToDelete == '*')
                    {
                        $dbObj = new Task_DbDataMapperModel();
                        $dbObj->reorderTableIndex('Todo_List');
                        $dbObj->deleteAllTasksFromTable();
                        Task_Registry::set('last_task', 'deleteAll');
                    }
                    else
                    {
                        $dbObj = new Task_DbDataMapperModel();
                        $dbObj->reorderTableIndex('Todo_List');
                        $dbObj->deleteTasksFromTable($taskToDelete);
                        Task_Registry::set('last_task', __FUNCTION__);
                    }

                }
                elseif($taskToDelete == '*' || is_numeric($taskToDelete))       //if the array is not associative but is a '*' symbol or numeric, use that instead.
                {
                    if($taskToDelete == '*')
                    {
                        $dbObj = new Task_DbDataMapperModel();
                        $dbObj->reorderTableIndex('Todo_List');
                        $dbObj->deleteAllTasksFromTable();
                        Task_Registry::set('last_task', 'deleteAll');
                    }
                    else
                    {
                        $dbObj = new Task_DbDataMapperModel();
                        $dbObj->reorderTableIndex('Todo_List');
                        $dbObj->deleteTasksFromTable($taskToDelete);
                        Task_Registry::set('last_task', __FUNCTION__);
                    }
                }
                else
                {
                    //todo: the array passed in is not associative or a number, throw passed in thing is incorrect error.
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

    //todo: update query and this function...       (this function may break if a string of numbers and symbols is passed in, need to check for symbols?)
    public function update($taskToUpdate = null)
    {
        //reset the Registry's last_task value back to null
        Task_Registry::set('last_task', null);

        if($taskToUpdate !== null)                                                          //if: Task to update has been passed in and not null
        {
            if(count($taskToUpdate) == 1)                                                   //  if: # of elements in $taskToUpdate is = 1
            {
                if(is_assoc($taskToUpdate))                                                 //      if: if the $taskToUpdate is an associative array (ex. 'cat' => 2)
                {
                    foreach($taskToUpdate as $key => $value)
                    {
                        $taskToUpdate = $value;
                    }
                    $dbObj = new Task_DbDataMapperModel();
                    $dbObj->reorderTableIndex('Todo_List');
                    $dbObj->updateSetTaskCompletionStatus($taskToUpdate);
                    Task_Registry::set('last_task', __FUNCTION__);
                }
                elseif(is_numeric($taskToUpdate))                                           //  elseif: is the inputted value numeric?
                {
                    $dbObj = new Task_DbDataMapperModel();
                    $dbObj->reorderTableIndex('Todo_List');
                    $dbObj->updateSetTaskCompletionStatus($taskToUpdate);
                    Task_Registry::set('last_task', __FUNCTION__);
                }
                else
                {
                    //todo: the array passed in is not associative or a number, throw passed in thing is incorrect error.
                }
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