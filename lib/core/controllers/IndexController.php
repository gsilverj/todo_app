<?php
/**
 * Created by PhpStorm.
 * User: incubator
 * Date: 3/10/14
 * Time: 12:49 PM
 */




/*  Todo's:
 *
 *
 */


class Core_IndexController
{
    public function index()
    {
        if($class = $this->getViewClass(__CLASS__, __FUNCTION__)){
            $class = new $class;
            $class->render();
        }
    }


    protected function getViewClass($class = false, $function = false){
        $viewClass = false;
        if($class && $function){
            $viewClass = Core_Bootstrap::getModuleNameFromClass($class) . '_' . ucwords($function) . 'View' ;
        }
        return $viewClass;
    }

    protected function render($function = null)
    {
        if($function !== null)
        {
            if($class = $this->getViewClass(get_class($this), $function))
            {
                $class = new $class;
                $class->render();
            }
        }
        else
        {
            //maybe throw exception?...
            $class = $this->getViewClass(get_class($this), 'index');
            $class = new $class;
            $class->render();
        }
    }

    protected function getParam($paramNameToGet, $paramLocation, $url = null)
    {
        $param = null;

        if($paramLocation == 'post')
        {
            if(isset($_POST[$paramNameToGet]))
            {
                $param = $_POST[$paramNameToGet];
            }
        }
        elseif($paramLocation == 'get')
        {
            if(isset($_GET[$paramNameToGet]))
            {
                $param = $_GET[$paramNameToGet];
            }
        }
        elseif($paramLocation == 'url')
        {
            if($url == null)
            {
                $query = parse_url($url, PHP_URL_QUERY);            //get the query from the inputted url
                if($query !== null)                                 //if there is a query
                {

                    $paramArray = explode(' ', $query);             // explode the query by spaces.


                }
            }
            else
            {

            }
        }
        else
        {
            //todo: throw exception about an invalid location passed in. (needs to be get/post/url)
        }

        return $param;
    }










}