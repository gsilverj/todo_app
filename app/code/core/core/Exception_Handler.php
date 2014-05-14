<?php
/**
 * Created by PhpStorm.
 * User:            Gabriell J.
 * Date:            3/5/14
 * Time:            11:09 AM
 * Project Name:    Exception_Handler.php (tasks.dev/lib/core/Exception_Handler.php   project)
 */

class Core_Exception_Handler extends Exception
{
    //It was mentioned to me that it would be smarter to use '1' (most likely string) variable and make set that to the message I want to send. Then return that variable. (less returns in a method is better than a lot of them.)







    private $exception = null;

    const ERROR_MESSAGE_config_file = 'Error C1: The Config File Was Not Found.';
    const ERROR_MESSAGE_database_issue = 'Error DB1: The Last Database Function Could Not Complete. Please Try Again.';
    const ERROR_MESSAGE_couldnt_find_php_file = 'Error P1: The PHP File Could Not Be Found.';
    const ERROR_MESSAGE_couldnt_make_class = 'Error C2: The Class Could Not Be Created.';
    const ERROR_MESSAGE_text_not_valid = 'Error T1: The Text Entered Was Not Valid. Please Try Again.';
    const ERROR_MESSAGE_view_not_found = 'Error V1: The View Was Not Found.';
    const ERROR_MESSAGE_DEFAULT = 'Error D1: An Unknown Error Has Occured.';




    public function getException($exIn)
    {
        $exception = (string)$exIn;
    }

    public function getErrorMessage($exception)
    {
        switch ($exception)
        {
            case 'C1':
            {
                return self::ERROR_MESSAGE_config_file;
            }

            case 'DB1':
            {
                return self::ERROR_MESSAGE_database_issue;
            }

            case 'P1':
            {
                return self::ERROR_MESSAGE_couldnt_find_php_file;
            }

            case 'C2':
            {
                return self::ERROR_MESSAGE_couldnt_make_class;
            }

            case 'T1':
            {
                return self::ERROR_MESSAGE_text_not_valid;
            }

            case 'V1':
            {
                return self::ERROR_MESSAGE_view_not_found;
            }

            case 'D1':
            {
                return $this->$ERROR_MESSAGE_DEFAULT;
            }

            default:
            {
                return self::ERROR_MESSAGE_DEFAULT;
            }
        }
    }




}