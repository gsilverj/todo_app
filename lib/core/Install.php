<?php
/**
 * Created by PhpStorm.
 * User: incubator
 * Date: 4/4/14
 * Time: 12:02 PM
 */

final class Core_Install
{
    //can use to keep track of times ran...
    private static $timesRun = 0;

    private function __construct()
    {}

    public static function runInstallScripts()
    {
        $didScriptRunFine = false;
        if(!static::$timesRun)
        {
            static::$timesRun ++;
            if(!static::checkIfTodoListTableExists())
            {
                try
                {
                    static::createTodoListTable();
                }
                catch(Exception $e)
                {
                    echo 'Either you need to connect to the database first, Or A MySQL Error Occured!';
                }

                //scripts ran with no exceptions thrown, so they all went well.(obviously I should test for errors)
                $didScriptRunFine = true;
            }
            else
            {
                $didScriptRunFine = false;
            }
        }

        //you have already ran once
        return $didScriptRunFine;
    }

    private static function createTodoListTable()
    {
        $query1 = "CREATE TABLE Todo_List(
                    Task_Number INT PRIMARY KEY NOT NULL,
                    Task_Description LONGTEXT NOT NULL,
                    Task_Is_Completed TINYINT);";

        $query2 = "CREATE UNIQUE INDEX unique_Task_Number ON Todo_List ( Task_Number );";


        if(mysqli_query(Core_DbConnectionModel::getInstance(), $query1))
        {
            mysqli_query(Core_DbConnectionModel::getInstance(), $query2);
        }
        else
        {
            echo(mysqli_error(Core_DbConnectionModel::getInstance()));

            throw new Exception();
        }
    }

    //todo: allow dynamic table names, by passing in the table name, right now it is hardcoded.
    private static function checkIfTodoListTableExists()
    {
        $query = "SELECT 1 FROM Todo_List";
        $result = mysqli_query(Core_DbConnectionModel::getInstance(), $query);

        //this part allows you to do something if the result is false or just return $result, however, you should check for MySQL error just in-case.
        $tableExistStatus = ($result !== false) ? true : false;

        return $tableExistStatus;
    }

} 