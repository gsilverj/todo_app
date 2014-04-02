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
        $this->passToRender();
    }

    public function add()
    {
        //reset the Registry's last_task value back to null
        Task_Registry::set('last_task', null);

        //This is an example of the getParam(function) to show its use, it is now deprecated and the getParamValue() should be used.
        //it is expected to get only the value of the $_Post['taskDescriptionTbox'].
        $paramValue = $this->getParam('taskDescriptionTbox', 'post');

        //check if paramValue is null or a white space character.
        if($paramValue != ' ' && $paramValue != null)
        {
            $dbMapper = new Task_DbDataMapperModel();
            $dbMapper->reorderTableIndex('Todo_List');
            $dbMapper->addTaskToTable($paramValue);
            //tell the registry what the last task was if the task worked
            Task_Registry::set('last_task', __FUNCTION__);
        }
        else
        {
            //todo: throw, you must put something into the textbox, exception.
        }

        $this->passToRender(__FUNCTION__);
    }

    //todo: Be aware that this method doesnt check to see if that TaskId actually exists or not, its just a happy accident that it does not break. You can probably just check if the task id exists in the table with a query (prob. select * where taskid = blah) and if it returns a result set it means it exists, otherwise it doesnt and either throw exception or do nothing to the database.
    public function delete($taskIDToDelete = null)
    {
        Task_Registry::set('last_task', null);

        $paramValue = $this->getParamValue( ($taskIDToDelete != null) ? $taskIDToDelete : 'id' );   //if a taskId is passed in, use it, otherwise search for id

        if($paramValue != null)
        {
            $dbMapper = new Task_DbDataMapperModel();
            $dbMapper->reorderTableIndex('Todo_List');

            if($paramValue == '*')
            {
                $dbMapper->deleteAllTasksFromTable();
                Task_Registry::set('last_task', 'deleteAll');
            }
            elseif(is_numeric($paramValue))
            {
                $dbMapper->deleteTasksFromTable($paramValue);
                Task_Registry::set('last_task', __FUNCTION__);
            }
            else
            {
                //todo: throw exception about incorrect param value grabbed
            }
        }
        else
        {
            //todo: throw exception because the task ID to delete is null, so it cant delete it...
        }

        $this->passToRender(__FUNCTION__);                                        //render the page(function name); (delete)
    }

    //todo: (this function may break if a string of numbers and symbols is passed in, need to check for symbols?)
    public function update($taskIDToUpdate = null)
    {
        //reset the Registry's last_task value back to null
        Task_Registry::set('last_task', null);

        $paramValue = $this->getParamValue( ($taskIDToUpdate != null) ? $taskIDToUpdate : 'id' ); //if a taskID is passed in, use it, otherwise use 'id'

        if($paramValue != null)
        {
            if(is_numeric($paramValue))
            {
                $dbMapper = new Task_DbDataMapperModel();
                $dbMapper->reorderTableIndex('Todo_List');
                $dbMapper->updateSetTaskCompletionStatus($paramValue);
                Task_Registry::set('last_task', __FUNCTION__);
            }
            else
            {
                //todo: throw exception about an incorrect paramValue being passed in, it must be a number.
            }
        }
        else
        {
            //todo: throw exception about the paramValue passed in being null, so I cant update it.
        }


        $this->passToRender(__FUNCTION__);
    }
}