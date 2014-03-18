<?php
/**
 * Created by PhpStorm.
 * User:            Gabriell J.
 * Date:            3/5/14
 * Time:            2:11 PM
 *
 * @catagory    IndexController
 * @package     Core_IndexController
 */

//Todo: Maybe include validation for the  _setCurrentRequest() & public getTaskRequest() functions.


class Task_IndexController extends Core_IndexController
{
    /**
     * Task_IndexView
     * Task_AddView
     */
    public function index()
    {
        $this->render(__FUNCTION__);
    }
    public function add()
    {
        $this->render(__FUNCTION__);
    }
    public function delete()
    {
        $this->render(__FUNCTION__);
    }
    public function reload()
    {
        $this->render(__FUNCTION__);
    }


}