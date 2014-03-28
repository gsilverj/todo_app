<?php
/**
 * Created by PhpStorm.
 * User: incubator
 * Date: 3/28/14
 * Time: 4:14 PM
 */


class Task_Registry extends Core_Registry
{
    public function listRegistryContents()
    {
        var_dump(self::$storedValues);
    }
} 