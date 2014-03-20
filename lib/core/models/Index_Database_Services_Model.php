<?php
/**
 * Created by PhpStorm.
 * User: Gabriell J.
 * Date: 3/19/14
 * Time: 3:12 PM
 */


/*
 *This file & class will:
 *
 *  - Will NOT hold any database information, it is completely dependant on the data mapper and database object for information.
 *  - Will hold the MySQL code queries to make alterations to database information. (displaying/adding/deleting/updating etc.)
 *  - Accepts information from the data mapper model which this class will use to conduct alterations. (table names/row names/ values of stuff)
 *  - Will also accept params from the controller being used at that time. (ex. add task (15, 'i be them thur awesome', 0)
 *  - Will perform the queries and return the resulting information to the data mapper model if necessary. (things like results/errors)
 *
 */



//**********  ALSO NOTE THAT BECAUSE OF TIME CONSTRAINTS, THE TABLE_NAMES ETC. ARE HARDCODED INTO THE QUERY STRING FOR SAKE OF QUICK TESTING THEIR EFFECTIVENESS...



class Core_Index_Database_Services_Model
{

    //maybe hardcode default MySQL statements for functions to default to...
    public function __construct()
    {

    }

    public function displayTableQuery($tableName = null)
    {
        if($tableName === null)
        {
            //todo: throw the no table name put in exception here...
        }

        $query = "SELECT * FROM test.Todo_List";
        return $query;
    }

    public function getNumberOfRows($tableName = null)
    {
         if($tableName === null)
         {
             //todo: throw exception here...
         }

        $query = "SELECT * FROM test.Todo_List";

        return $query;
    }

    public function addNewTask($taskDescription = null, $rowNumber)
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

    //TODO: you need to find a way to make the table renumber itself after deleting a task row...
    public function deleteOneTask($taskNumberToDelete = null)
    {
        if($taskNumberToDelete === null)
        {
             //todo: throw a "you need to have a task description" exception
        }
        $query = "DELETE FROM test.Todo_List WHERE Task_Number = " . $taskNumberToDelete;
        return $query;
    }

    public function deleteMultipleTasks($taskNumbersToDeleteArray)
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
            $queryList = $this->deleteOneTask($taskNumbersToDeleteArray);
        }

        return $queryList;
    }




/*possibly usefull functions...
 *
    public function updateTaskToCompleted($customQuery = null)
    {

    }

    public function getTaskList($customQuery = null)
    {

    }
*/

} 