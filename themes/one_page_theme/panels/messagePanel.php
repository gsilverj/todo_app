<!-- This panel will hold all of the messages that will display after running a query. -->
<script type="text/javascript">
    function showStuff(id)
    {
        document.getElementById(id).style.display = 'block';
    }

    function checkForLastTask()
    {
        var task = null;
        task = <?php echo (Task_Registry::get('last_task'));?>;
        return task;
    }

    function handleMessageVisibility()
    {
        var itemShowing = checkForLastTask();

        switch(itemShowing)
        {
            case 'add':
            {
                showStuff('addTaskMessage');
                break;
            }
            case 'delete':
            {
                showStuff('deleteTaskMessage');
                break;
            }
            case 'deleteAll':
            {
                showStuff('deleteAllTaskMessage');
                break;
            }
            case 'update':
            {
                showStuff('updateTaskMessage');
                break;
            }
            default:
            {
                break;
            }
        }
    }
</script>


<div class="container" name="defineMessagePanel" onload="handleMessageVisibility()">

    <p class="hidden alert-success" name="addTaskMessage">A task has now been ADDED.</p>
    <p class="hidden alert-danger" name="deleteTaskMessage">A task has now been DELETED.</p>
    <p class="hidden alert-danger" name="deleteAllTaskMessage">All of the tasks have now been DELETED.</p>
    <p class="hidden alert-info" name="updateTaskMessage">That task have now been UPDATED.</p>

    <div onload"">

    </div>

    <?php  echo 'cat';?>


    <?php  echo 'dog';?>
</div>



    <p class="show alert-success" name="addTaskMessage">A task has now been ADDED.</p>
    <p class="getVisibilityStatus() alert-danger" name="deleteTaskMessage">A task has now been DELETED.</p>
    <p class="getVisibilityStatus() alert-danger" name="deleteAllTaskMessage">All of the tasks have now been DELETED.</p>
    <p class="getVisibilityStatus() alert-info" name="updateTaskMessage">That task have now been UPDATED.</p>

<!--    --><?php
//
//        $uri = $_SERVER['REQUEST_URI'];
//
//        $lastUriPiece = array_pop(explode(DS, trim($uri, DS)));
//
//        if($lastUriPiece == 'add')
//
//        elseif($lastUriPiece == 'delete')
//
//    elseif($lastUriPiece == )
//
//        //$wasQueryRun =
//
//    ?>