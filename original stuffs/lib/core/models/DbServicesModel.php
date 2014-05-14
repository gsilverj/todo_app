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



class Core_DbServicesModel
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

        $query = "SELECT * FROM " . $tableName;
        //$query = "SELECT * FROM " . $tableName;
        return $query;
    }

    public function getNumberOfRowsQuery($tableName = null)
    {
         if($tableName === null)
         {
             //todo: throw exception here...
         }

        $query = "SELECT * FROM " . $tableName;

        return $query;
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