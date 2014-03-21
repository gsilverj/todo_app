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



class Core_DbDataMapperModel
{

    protected $_dbObject;
    protected $_dbService;

    public function __construct()
    {
        //create new objects for the database object and database service models
        $this->_dbObject = new Core_DbObjectModel();
        //need to set this up before
        $this->_dbService = new Core_DbServicesModel();
    }

    public function handleRequest($request)
    {
        //handle request that was received from the user/view/controller...
    }

    public function getRowNumberFromDatabase()
    {
        $query = $this->_dbService->getNumberOfRowsQuery('test.Todo_List');          //get the query from services to find the number of rows...
        $this->_dbObject->performQuery($query);                       //tell db object to do the query and return the results

        $result = mysqli_store_result(Core_DbConnectionModel::getInstance());

        if($result === true || $result === false)                               //if the query failed or returned a non-object (mysqli object)
        {
            //todo: throw query failed exception here...                        // throw the exception
        }

        $rows = mysqli_num_rows($result);                                       //get the number of rows from the mysqli object result.
        return $rows;                                                           //and return it...
    }



} 