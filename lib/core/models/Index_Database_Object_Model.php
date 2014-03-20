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

class Core_Index_Database_Object_Model
{
    protected $_host;
    protected $_user;
    protected $_pass;
    protected $_dbName;

    //this will store the connection with the database...
    protected $_connection;

    //test if true just incase database was never closed?
    protected $_isConnected = false;



    public function index()
    {

    }
    public function __construct($host = null, $user = null, $pass = null, $dbName = null)
    {
        if($host === null || $user === null || $pass === null || $dbName === null)
        {
            //todo: throw need more db info to make database Exception here
        }
        else
        {
            $this->setHost($host);
            $this->setUser($user);
            $this->setPass($pass);
            $this->setDbName($dbName);
        }
    }

    public function connectToDb($host = null, $user = null, $pass = null, $dbName = null)
    {
        //if they ALL are null = do connection,
        //if SOME are null, throw exception,
        //otherwise, open connection with inputted info...

        if($host === null && $user === null && $pass === null && $dbName === null)
        {
            $this->_connection = mysqli_connect($this->getHost(), $this->getUser(), $this->getPass(), $this->getDbName());  //set up connection
        }
        elseif($host === null || $user === null || $pass === null || $dbName === null)
        {
            //todo: throw need more db info to connect to database Exception here
        }
        else
        {
            $this->_connection = mysqli_connect($host, $user, $pass, $dbName);  //set up connection
        }

        //test for error...
        if(mysqli_connect_errno())
        {
            //todo: throw exception about error connecting to MySQL database ?
            echo "Couldn't connect to the MySQL database: " . mysqli_connect_error();
        }
    }
    public function disconnectFromDb($connection = null)
    {
        if($connection !== null || $connection != $this->_connection)
        {
            mysqli_close($connection);
            //todo: throw exception here if closing the connection fails?... (would return false if it fails...)
        }
        else
        {
            mysqli_close($this->_connection);
            //todo: throw exception here also if closing the connection fails?
        }
    }




    public function performQuery($queryReceived, $connection = null)
    {
        //if user puts something that is not null in as connection = use it.
        if($connection !== null)
        {
           $result = mysqli_query($connection, $queryReceived);
        }
        else
        {
           $result = mysqli_query($this->_connection, $queryReceived);
        }

        return $result;

    }


    public function returnResults()
    {


    }


    public function validateDataFromChanges($column,$row,$newValue){}
    public function checkForChanges($dbQueryResult){}






























    //Protected variable getters and setters...


    /**
     * @param mixed $dbName
     */
    public function setDbName($dbName)
    {
        $this->_dbName = $dbName;
    }

    /**
     * @return mixed
     */
    public function getDbName()
    {
        return $this->_dbName;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->_host = $host;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->_host;
    }

    /**
     * @param mixed $isConnected
     */
    public function setIsConnected($isConnected)
    {
        $this->_isConnected = $isConnected;
    }

    /**
     * @return mixed
     */
    public function getIsConnected()
    {
        return $this->_isConnected;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->_pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->_pass;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->_user;
    }














} 