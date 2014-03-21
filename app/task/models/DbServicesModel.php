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
        $query = "INSERT INTO test.Todo_List VALUES (" . ($rowNumber + 1) .  ", " . $taskDescription . ", 0)";   //*(0 = false, it needs to be a number for some reason?)


        return $query;
    }

    //TODO: you need to find a way to make the table renumber itself after deleting a task row?...
    public function deleteOneTaskQuery($taskNumberToDelete = null)
    {
        if($taskNumberToDelete === null)
        {
            //todo: throw a "you need to have a task description" exception
        }
        $query = "DELETE FROM test.Todo_List WHERE Task_Number = " . $taskNumberToDelete;
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
                $queryList[$i] = "DELETE FROM test.Todo_List WHERE Task_Number = " . $taskNumbersToDeleteArray[$i];
            }
        }
        else
        {
            $queryList = $this->deleteOneTaskQuery($taskNumbersToDeleteArray);
        }

        return $queryList;
    }

} 