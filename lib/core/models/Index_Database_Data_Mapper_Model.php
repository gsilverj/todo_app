<?php
/**
 * Created by PhpStorm.
 * User: Gabriell J.
 * Date: 3/19/14
 * Time: 3:13 PM
 */

/*
 *This file & class will:
 *
 *  - Be the middle man between the object model which holds the information and the services which perform the action.
 *  - Accepts information from the services model(query or instructions?)
 *  - Tells the object model that a change has/will occur(something added/updated/deleted)
 *  - Accepts information from the object model about db information.(table names/data/stuff?)
 *  - Passes the information to the services model which does the action requested by user/dev...?
 */



class Core_Index_Database_Data_Mapper_Model
{

    private $_dbObject;
    private $_dbService;

    public function __construct()
    {
        //create new objects for the database object and database service models
        $this->_dbObject = new Core_Index_Database_Object_Model('localhost', '', '', 'test');
        $this->_dbObject->connectToDb();
        $this->_dbService = new Core_Index_Database_Services_Model();
    }

    public function handleRequest($request)
    {
        //handle request that was received from the user/view/controller...
    }

    public function getRowNumberFromDatabase()
    {
        $query = $this->_dbService->getNumberOfRows('test.Todo_List');          //get the query from services to find the number of rows...
        $result = $this->_dbObject->performQuery($query);                       //tell db object to do the query and return the results

        if($result === true || $result === false)                               //if the query failed or returned a non-object (mysqli object)
        {
            //todo: throw query failed exception here...                        // throw the exception
        }

        $rows = mysqli_num_rows($result);                                       //get the number of rows from the mysqli object result.
        return $rows;                                                           //and return it...
    }

    public function addTaskToDatabase($taskDescription)
    {
        //get number of rows from function/db and then pass that into the addNewTask service function which then returns the desired query.
        $query = $this->_dbService->addNewTask($taskDescription, $this->getRowNumberFromDatabase());

        //tell db to perform query
        $this->_dbObject->performQuery($query);
    }

    public function deleteTasksFromDatabase($taskNumbersToDeleteArray)
    {
        $queryList = $this->_dbService->deleteMultipleTasks($taskNumbersToDeleteArray);

        for($i = 0; $i < count($queryList); $i ++)
        {
            $this->_dbObject->performQuery($queryList[$i]);
        }
    }

    public function displayTableFromDatabase($tableName)
    {
        $query = $this->_dbService->displayTableQuery($tableName);
        $result = $this->_dbObject->performQuery($query);

        if($result !== true || $result !== false)               //if the query failed or returned a non-object
        {
            //todo: throw query failed exception here...        //throw the exception
        }

        print_r($result);
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