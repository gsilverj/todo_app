<?php
/**
 * Created by PhpStorm.
 * User: incubator
 * Date: 3/13/14
 * Time: 1:20 PM
 */

class Task_AddView extends Task_IndexView
{
    public function __construct()
    {
        //leave parents template as the target template
        parent::__construct();
        //$this->setTargetTemplate(__CLASS__);
        $this->addTask();

    }

    public function addTask()
    {
        $dbObj = new Task_DbDataMapperModel();
        $dbObj->reorderTableIndex('Todo_List');
        $dbObj->addTaskToTable($_POST['taskDescriptionTbox']);
    }


}
