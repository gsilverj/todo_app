<?php
/**
 * Created by PhpStorm.
 * User: Gabriell J.
 * Date: 3/21/14
 * Time: 11:34 AM
 */

//this .php is to abstract the task query info away from the core version, since the core really doesn't need nor use it.

class Task_DbServicesModel extends Core_DbServicesModel
{


    public function addNewTaskQuery($taskDescription = null, $rowNumber)
    {
        if($taskDescription === null)
        {
            //todo: throw a "you need to have a task description" exception
        }

        //ask for table information from the mapper, mapper gets and gives requested information, perform getRowNumbers() query to get $rowNumbers
        /*
          or maybe get rowNumber after running the query seperately and then pass it into this function...
        */

        //todo: you need to find a way to quickly get the highest row number from the table and increment by one when adding a row...
        //you need to use ' right before the ending " directly before putting the description so that it is read as a string into the db.
        $query = "INSERT INTO Todo_List VALUES (" . ($rowNumber) .  ", '" . $taskDescription . "', 0)";   //*(0 = false, it needs to be a number for some reason?)


        return $query;
    }

    //TODO: you need to find a way to make the table renumber itself after deleting a task row?...
    public function deleteOneTaskQuery($taskNumberToDelete = null)
    {
        if($taskNumberToDelete === null)
        {
            //todo: throw a "you need to have a task description" exception
        }
        $query = "DELETE FROM Todo_List WHERE Task_Number = " . $taskNumberToDelete;
        return $query;
    }

    public function deleteMultipleTasksQuery($taskNumbersToDeleteArray)
    {
        //just incase?...
        $queryList = null;


        if(is_array($taskNumbersToDeleteArray))
        {
            for($i = 0; $i < count($taskNumbersToDeleteArray); $i++)
            {
                $queryList[$i] = "DELETE FROM Todo_List WHERE Task_Number = " . $taskNumbersToDeleteArray[$i];
            }
        }
        else
        {
            $queryList = $this->deleteOneTaskQuery($taskNumbersToDeleteArray);
        }

        return $queryList;
    }

    public function updateRowQuery($rowNumberToUpdate, $task_number = null, $task_description = null, $task_is_completed = 0)
    {
        if($rowNumberToUpdate < 0)
        {
            //todo: throw a, you put an negative number row to update, exception.
        }
        elseif($task_number == null)
        {
            //todo: throw a, you need to put in a task_number for the row to update to change to.
        }
        elseif($task_is_completed > -1 && $task_is_completed < 2)
        {
            //todo: throw a, you need to pass either a one(1) or zero(0) for the task_is_completed Bool Value, exception.
        }

        $query = "UPDATE Todo_List
                  SET Task_Number = " . $task_number . ",
                      Task_Description = '" . $task_description . "',
                      Task_Is_Completed = " . $task_is_completed . "
                  WHERE Task_Number = " . $rowNumberToUpdate;

        return $query;

    }

    //query returns a table row for the passed in taskNumber.
    public function getSpecificTaskNumberRow($taskNumber)
    {
        $query = "SELECT *
                  FROM Todo_List
                  WHERE Task_Number = " . $taskNumber;

        return $query;
    }

    //A loose bool is needed so either a one/zero (1/0), a true/false might work, for the $taskCompletedStatus.
    // method sets the task as whatever the completion status passed in is.
    public function updateTaskIsCompletedQuery($taskNumber, $taskCompletedStatus)
    {
        $query = "UPDATE Todo_List
                  SET Task_Is_Completed = " . $taskCompletedStatus . "
                  WHERE Task_Number = " . $taskNumber;

        return $query;
    }
} 