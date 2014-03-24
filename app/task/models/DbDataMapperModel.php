<?php
/**
 * Created by PhpStorm.
 * User: Gabriell J.
 * Date: 3/21/14
 * Time: 11:39 AM
 */

class Task_DbDataMapperModel extends Core_DbDataMapperModel
{


    public function __construct()
    {
        //create new objects for the database object and database service models
        $this->_dbObject = new Task_DbObjectModel();
        //select which database to use
        mysqli_select_db(Core_DbConnectionModel::getInstance(), 'test');

        //need to set this up before
        $this->_dbService = new Task_DbServicesModel();
    }

    public function addTaskToTable($taskDescription)
    {
        //get number of rows from function/db and then pass that into the addNewTask service function which then returns the desired query.
        $query = $this->_dbService->addNewTaskQuery($taskDescription, ($this->getRowNumberFromTable() + 1));

        //tell db to perform query
        $result = $this->_dbObject->performQuery($query);

        if($result === false)
        {
            //todo: throw a , you passed in an already used task_number & task_numbers must be unique, exception.
        }
    }

    public function deleteTasksFromTable($taskNumbersToDeleteArray)
    {
        $queryList = $this->_dbService->deleteMultipleTasksQuery($taskNumbersToDeleteArray);

        //If I dont check if there is only one element here, the for loop will only pass in the $i'th letter in the query...
        if(count($queryList) == 1)
        {
            $this->_dbObject->performQuery($queryList);
        }
        else
        {
            for($i = 0; $i < count($queryList); $i ++)
            {
                $this->_dbObject->performQuery($queryList[$i]);
            }
        }

    }

    public function displayTableFromDatabase($tableName)
    {
        $query = $this->_dbService->displayTableQuery($tableName);
        //var_dump($query);
        $result = $this->_dbObject->performQuery($query);

        if($result === true || $result === false)               //if the query failed or returned a non-object
        {
            //todo: throw query failed exception here...        //throw the exception
        }

        echo("<br \>");

        echo "<table border='1'><tr><th>Task_Number</th><th>Task_Discription</th><th>is_finished?</th></tr>";


        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['Task_Number'] . "</td>";
            echo "<td>" . $row['Task_Description'] . "</td>";
            echo "<td>" . $row['Task_Is_Completed'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";


        echo("<br \>");
    }

    public function reorderTableIndex($tableName)
    {
        $selectQuery = 'SELECT * FROM ' . $tableName;
        $result = $this->_dbObject->performQuery($selectQuery);

        $index = 1;

        while($row = mysqli_fetch_array($result))
        {
            $query = $this->_dbService->updateRowQuery($row['Task_Number'], $index, $row['Task_Description'], $row['Task_Is_Completed']);
            $this->_dbObject->performQuery($query);
            $index ++;
        }
    }

    public function getTableAsArray($tableName)
    {
        $query = $this->_dbService->displayTableQuery($tableName);
        //var_dump($query);
        $result = $this->_dbObject->performQuery($query);

        if($result === true || $result === false)               //if the query failed or returned a non-object
        {
            //todo: throw query failed exception here...        //throw the exception
        }


        return $result;
    }

} 