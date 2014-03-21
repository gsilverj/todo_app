<?php
/**
 * Created by PhpStorm.
 * User: incubator
 * Date: 3/19/14
 * Time: 3:11 PM
 */


//maybe set up a directory just for this MySQL type logic just like Magento is starting to do...


/*
 *This file & class will:
 *
 *  - Hold the information about the database. (ex. db name, user name, if db is connected right now or not etc...)
 *  - Validate the database information.
 *  - Will pass information to the data mapper.
 *  - Will accept information from mapper (coming from the services model)
 *  - Preform the query if applicable.(this class will not hold the actual MySQL code)
 *  - Compare information received to the information already held.
 *  - If changes to information have been made, make the changes to the database. (delete specific things/add specific things)
 *
 */

class Core_DbObjectModel
{

    public function index()
    {

    }
    public function __construct()
    {

    }

    public function performQuery($connection = null, $queryReceived = null)
    {
        //if user puts something that is not null in as connection = use it.
        if($connection === null || $queryReceived === null)
        {
           //todo: throw a no connection/query were given to perform exception
        }
        else
        {
           mysqli_query(Core_DbConnectionModel::getInstance(), $queryReceived);
        }
    }



    //these would take care of validating data from changes that were submitted to the database object...
    //public function validateDataFromChanges($column,$row,$newValue){}

    //These would check for any differences between the result of a query and the database object and update it?...
    //public function checkForChanges($dbQueryResult){}

}