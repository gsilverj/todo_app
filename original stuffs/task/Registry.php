<?php
/**
 * Created by PhpStorm.
 * User: incubator
 * Date: 3/28/14
 * Time: 4:14 PM
 */

//It just now occurred to me that you can use a registry to keep a log of what has happened in the program in an array inside of the task registry's values.
//  You could just set(LOGGER, 'log stuffs') any thing you want to keep track of, like step by step what some value is, and then print it when an exception happens.

class Task_Registry extends Core_Registry
{
    public function listRegistryContents()
    {
        var_dump(self::$storedValues);
    }
} 