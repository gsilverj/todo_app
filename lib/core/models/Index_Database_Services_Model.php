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

    protected function index()
    {

    }

    protected function __construct()
    {

    }

    protected function addNewTask($taskDescription = null, $customQuery = null)
    {
        if($taskDescription === null)
        {
            //todo: throw a "you need to have a task description" exception
        }


        //todo: you need to find a way to quickly get the highest row number from the table and increment by one when adding a row...
        $query = ($customQuery !== null) ? $customQuery : "INSERT INTO test.Todo_List VALUES (" . rowNumberHere .  ", " . $taskDescription . ", 0)";   //*(false, it needs to be a number for some reason?)


        return $query;
    }

    //TODO: you need to find a way to make the table renumber itself after deleting a task row...
    protected function deleteTask($customQuery = null)
    {

    }

    protected function updateTaskList($customQuery = null)
    {

    }

    protected function setTaskToCompleted($customQuery = null)
    {

    }

    protected function getTaskList($customQuery = null)
    {

    }


} 