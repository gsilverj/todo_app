<?php
/**
 * Created by PhpStorm.
 * User: incubator
 * Date: 3/13/14
 * Time: 1:20 PM
 */

class Task_IndexView extends Core_IndexView {

    public function loadLayout($fileName = null)
    {
        parent::loadLayout();

    }

    public function renderLayout()
    {
        parent::renderLayout();
    }

    public function returnTodoListArray()
    {
        $_dbMapper = new Task_DbDataMapperModel();

        $results = $_dbMapper->getTableAsArray('Todo_List');

        return $results;
    }

}
