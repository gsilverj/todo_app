<?php
/**
 * Created by PhpStorm.
 * User: Gabriell J.
 * Date: 3/21/14
 * Time: 11:44 AM
 */


//This is based of the singleton pattern to prevent multiple connections to the database...
//depends on Core_XMLConfig, but ultimately it depends on the config file containing database info and
//  being saved into the program from bootstrap.

class Core_DbConnectionModel
{
    private static $_dbConnection;

    private function __construct()
    {
        //prevents devs from using 'new blah()' here...
    }

    public static function getInstance()
    {
        // if the connection hasn't been set, create it if possible, finally return the dbConnection...


        if(!isset(static::$_dbConnection))
        {
            static::$_dbConnection = mysqli_connect(
                Core_XMLConfig::getDatabaseInfoHost(),
                Core_XMLConfig::getDatabaseInfoUser(),
                Core_XMLConfig::getDatabaseInfoPass(),
                Core_XMLConfig::getDatabaseInfoDbName());  //set up connection


            if(mysqli_connect_errno())
            {
                //todo: throw exception about error connecting to MySQL database ?
                echo "Couldn't connect to the MySQL database: " . mysqli_connect_error();

            }
        }

        return self::$_dbConnection;
    }

    private function __clone()
    {
        //prevent the user from trying to "clone" the current instance...
    }

} 