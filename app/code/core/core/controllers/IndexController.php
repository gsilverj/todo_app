<?php
/**
 * Created by PhpStorm.
 * User: Gabriell J.
 * Date: 3/10/14
 * Time: 12:49 PM
 */




/*  Todo's:
 *
 *
 */


class Core_IndexController
{
    public function index($isFOF = null)
    {
        if($class = $this->getViewClass(__CLASS__, __FUNCTION__))
        {
            $class = new $class;

            $class->loadLayout();
            $class->renderLayout();
        }
    }


    protected function getViewClass($class = false, $function = false){
        $viewClass = false;
        if($class && $function){
            $viewClass = Core_Bootstrap::getModuleNameFromClass($class) . '_' . ucwords($function) . 'View' ;
        }
        return $viewClass;
    }

    protected function passToRender($function = null)
    {
        if($function !== null)
        {
            if($class = $this->getViewClass(get_class($this), $function))
            {
                $class = new $class;
                $class->renderLayout();
            }
        }
        else
        {
            //maybe throw exception?...
            $class = $this->getViewClass(get_class($this), 'index');
            $class = new $class;
            $class->renderLayout();
        }
    }

    //quick check to see if this would produce a 404 page.
    protected function passToRenderFOF()
    {
        $class = $this->getViewClass(get_class($this), 'index');
        $class = new $class;
        $class->setTargetTemplate('four_oh_four.php');
        $class->renderLayout();
    }






    //Newer function to grab param Values from $_REQUEST, which holds all $_GET AND $_POST (as well as $_COOKIES)
    //  **BUT** it only holds the information of that page load, meaning if you change GET or POST on this page AFTER loading the page,
    //              $_REQUEST will not have that changed information.(or so the manual says: http://www.php.net/manual/en/reserved.variables.request.php)
    //  On a side note, I rejected the option to look for the param 'code' because it seems to hold the actual php code of everything after it?
    protected function getParamValue($paramNameToGet)
    {
        $paramValue = null;

        if($paramNameToGet != 'code')
        {
            if(array_key_exists($paramNameToGet, $_REQUEST))
            {
                $paramValue = $_REQUEST[$paramNameToGet];
            }
            else
            {
                //todo: throw exception that the paramNameToGet was not found.
            }
        }
        else
        {
            //todo: throw exception about the user not being aloud to request the 'code' param.
        }

        return $paramValue;
    }


    //****THESE TWO FUNCTIONS ARE THE OLD FUNCTIONS, IT WAS BEFORE I FOUND OUT THAT YOU CAN GET URL QUERY VALUES IN THE $_GET ARRAY.

    //Super important, this function will get the the PARAM ***OR*** PARAMS!!! depending on where you get the param from.
    //(ex. post/get will return just the param value while uri will return the param KEY=>VALUE pair.
    //Expected to return NULL on false, although it is possible to get a param of null, should test after using this function if the value is what your looking for.
    //***Also note that this function will only return ***1(one)*** key=>value pair and not all/more and will only grab the first instance of that paramNameToGet.
    //todo: I think this function will break if somehow an array gets searched through in the uri area.(idk how that would happen but should probably make sure it cant happen)
    protected function getParam($paramNameToGet, $paramLocation, $uri = null)
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
        elseif($paramLocation == 'uri')
        {
            if($uri != null)
            {
              $param = $this ->getParamPairFromUrl($uri, $paramNameToGet);
            }
            else
            {
                //todo: throw exception b/c you need a url to use get the params from.
            }
        }
        else
        {
            //todo: throw exception about an invalid location passed in. (needs to be get/post/url)
        }

        return $param;
    }

    //****THIS IS THE OLD FUNCTION, IT WAS BEFORE I FOUND OUT THAT YOU CAN GET URL QUERY VALUES IN THE $_GET ARRAY.
    //this function will break if the user passes in a key=>value pair like this 'key=*blank*' or vice versa... (can probably check after exploding the '=' by filtering the arrays and check if both paramId and paramKey have the same number of elements.)
    protected function getParamPairFromUrl($url, $paramNameToGet)
    {


        $paramPair = null;
        $query = parse_url($url, PHP_URL_QUERY);            //get the query from the inputted url
        if($query != null)                                  //if: there is a query
        {
            $query = str_replace(array('?', '&'), ' ', $query);       //query now looks like -> quote=15 hamburger=1
            $queryPieces = explode(' ', $query);                      //explode the query by spaces.
            array_filter($queryPieces);                               //remove any blank array elements

            if(count($queryPieces) <= 2)                              //if: there is only one element in the queryPieces array
            {
                $param = $queryPieces;                            //    make the param = queryPieces  (means there is only one key value pair in the query from the url)
            }
            else                                                      //else: there are more then one element
            {
                for($i = 0; $i < count($queryPieces); $i++)           //    for each element, copy into params();
                {
                    $param[$i] = $queryPieces[$i];
                }
            }


            if(count($param) > 1)                                     // if there are more than 1 element in $param, meaning alot of paramaters in a key=>value pair
            {
                for($i = 0; $i < count($param); $i ++)
                {
                    $paramParts = explode('=', $param[$i]);
                    $paramID = $paramParts[0];
                    $paramValue = $paramParts[1];
                    $param[$i] = array($paramID => $paramValue);                //todo: this is incorrect, it grabs the id and value and puts it into an element, it should actually put the id into param[id] = key as opposed to param[#] = array(id => key);
                }

                $found = false;

                foreach($param as $key => $value)                     //check if the $paramNameToGet is in the assoc. array, and if found set $paramPair.
                {
                    if($key == $paramNameToGet)
                    {
                        $paramPair[$key] = $value;
                        $found = true;
                    }
                }

                if($found == false)
                {
                    //todo: throw exception because a lot of code was ran through but the paramNameToGet Wasnt Even There!
                }
            }
            else
            {
                $paramParts = explode('=', $param[0]);
                $paramID = $paramParts[0];
                $paramValue = $paramParts[1];
                $param = array($paramID => $paramValue);

                if(array_key_exists($paramNameToGet, $param))       //check if the $paramNameToGet is in the assoc. array and if found set $paramPair.
                {
                    $paramPair[$paramNameToGet] = $param[$paramNameToGet];
                }
            }
        }
        else
        {
            //todo: throw exception from the lack of query in the inputted url.
        }
        return $paramPair;
    }






}