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
            $dbMapper = new Task_DbDataMapperModel();
            $dbMapper->reorderTableIndex('Todo_List');
            $dbMapper->addTaskToTable($param);
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
    public function delete($taskIDToDelete = null)
    {
        //reset the Registry's last_task value back to null
        Task_Registry::set('last_task', null);

        //check to see if a parameter is passed in, if so use it, otherwise search for 'id'.
        if($taskIDToDelete != null)
        {
            $paramPair = $this->getParam($taskIDToDelete, 'uri', $_SERVER['REQUEST_URI']);
        }
        else
        {
            $paramPair = $this->getParam('id', 'uri', $_SERVER['REQUEST_URI']);
        }


        if($paramPair != null)                                              //if: the paramaters obtained are not null
        {
            if(is_assoc($paramPair))                                        //  if: the paramPair obtained is an assoc. array
            {
                $dbMapper = new Task_DbDataMapperModel();                   //      create the db mapper model class

                foreach($paramPair as $key => $value)                       //      foreach(): get the value of key in the assoc. array (it would have to be the task id #)
                {
                    $dbMapper->reorderTableIndex('Todo_List');              //          reorder the table

                    if($value == '*')                                       //          if: the value is '*'
                    {
                        $dbMapper->deleteAllTasksFromTable();               //              delete all the tasks from the table
                        Task_Registry::set('last_task', 'deleteAll');       //              set the registry for the last task performed to 'deleteAll'
                    }
                    elseif(is_numeric($value))                              //          elseif: is the value numeric
                    {
                        $dbMapper->deleteTasksFromTable($value);            //              delete $value number task from the table
                        Task_Registry::set('last_task', __FUNCTION__);      //              set the registry to the function name(delete).
                    }                                                       //          end if what is $value
                }                                                           //      end foreach to get $value
            }
            else                                                            //  else: paramPair is not assoc. array, throw exception
            {
                //todo: throw exception that the paramaters being passed in are supposed to be an assoc. array.(key=>value pair) and the passed in params are not correct.
            }                                                               //  end if to see if paramPair is an Assoc. Array
        }
        else                                                                //else: the paramPair passed in is null, throw exception
        {
            //todo: throw exception because the task ID to delete is null, so it cant delete it...
        }                                                                   //end if  is paramPair null

        $this->render(__FUNCTION__);                                        //render the page(function name); (delete)
    }

    //todo: update query and this function...       (this function may break if a string of numbers and symbols is passed in, need to check for symbols?)
    public function update($taskIDToUpdate = null)
    {
        //reset the Registry's last_task value back to null
        Task_Registry::set('last_task', null);


        //check to see if a parameter is passed in, if so use it, otherwise search for 'id'.
        if($taskIDToUpdate != null)
        {
            $paramPair = $this->getParam($taskIDToUpdate, 'uri', $_SERVER['REQUEST_URI']);
        }
        else
        {
            $paramPair = $this->getParam('id', 'uri', $_SERVER['REQUEST_URI']);
        }


        if($paramPair != null)                                                          //if: Task to update has been passed in and not null
        {
            if(is_assoc($paramPair))                                                    //  if: if the $taskToUpdate is an associative array (ex. 'cat' => 2)
            {
                $dbObj = new Task_DbDataMapperModel();

                foreach($paramPair as $key => $value)
                {
                    $dbObj->reorderTableIndex('Todo_List');

                    if(is_numeric($value))
                    {
                        $dbObj->updateSetTaskCompletionStatus($value);
                        Task_Registry::set('last_task', __FUNCTION__);
                    }
                }
            }
            else
            {
                //todo: the array passed in is not associative array, throw paramater grabbed is incorrect error.
            }
        }
        else
        {
            //todo: throw error about the parameterPair being null, so it either doesnt exist or is invalid.
        }

        $this->render(__FUNCTION__);
    }
}