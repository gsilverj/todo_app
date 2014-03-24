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

    public function addTaskToDatabase($taskDescription)
    {
        //get number of rows from function/db and then pass that into the addNewTask service function which then returns the desired query.
        $query = $this->_dbService->addNewTaskQuery($taskDescription, $this->getRowNumberFromTable());

        //tell db to perform query
        $this->_dbObject->performQuery($query);
    }

    public function deleteTasksFromDatabase($taskNumbersToDeleteArray)
    {
        $queryList = $this->_dbService->deleteMultipleTasksQuery($taskNumbersToDeleteArray);

        for($i = 0; $i < count($queryList); $i ++)
        {
            $this->_dbObject->performQuery($queryList[$i]);
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




} 