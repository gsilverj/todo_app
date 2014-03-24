<?php
/**
 * Created by PhpStorm.
 * User: incubator
 * Date: 3/13/14
 * Time: 1:20 PM
 */

class Task_IndexView extends Core_IndexView {




    public function __construct()
    {
        parent::__construct();
        $this->setTargetTemplate(__CLASS__);
    }

    public function returnTodoListArray()
    {
        $_dbMapper = new Task_DbDataMapperModel();

        $results = $_dbMapper->getTableAsArray('Todo_List');

        return $results;
    }

}
