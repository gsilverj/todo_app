<?php
/**
 * Created by PhpStorm.
 * User:            Gabriell J.
 * Date:            3/5/14
 * Time:            11:09 AM
 * Project Name:    Exception_Handler.php (tasks.dev/lib/core/Exception_Handler.php   project)
 */

class Exception_Handler
{
    private $exception = null;

    private $errMessage_config_file = 'Error C1: The Config File Was Not Found.';
    private $errMessage_database_issue = 'Error DB1: The Last Database Function Could Not Complete. Please Try Again.';
    private $errMessage_couldnt_find_php_file = 'Error P1: The PHP File Could Not Be Found.';
    private $errMessage_couldnt_make_class = 'Error C2: The Class Could Not Be Created.';
    private $errMessage_text_not_valid = '';
    private $errMessage_view_not_found = '';




    public function getException($exIn)
    {
        $exception = (string)$exIn;
    }

    public function getErrorMessage()
    {


    }




}