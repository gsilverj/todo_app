<script type="text/javascript">

    function showStuff(id) {
        alert('before');
        document.getElementById(id).style.display = "none";
        alert('after');
    }


    function checkForLastTask()
    {
        var task = null;
        task = "<?php echo (Task_Registry::get('last_task'));?>";
        return task;
    }

    function handleMessageVisibility()
    {
        var taskToShow = checkForLastTask();

        switch(taskToShow)
        {
            case 'add':
            {
                showMessage('addTaskMessage');
                break;
            }
            case 'delete':
            {
                showMessage('deleteTaskMessage');
                break;
            }
            case 'deleteAll':
            {
                showMessage('deleteAllTaskMessage');
                break;
            }
            case 'update':
            {
                showMessage('updateTaskMessage');
                break;
            }
            default:
            {
                break;
            }
        }
    }
</script>




<div class="container" name="messagePanel" onload="showStuff('addTaskMessage')">

    <div class="alert alert-success fade in" id="addTaskMessage" name="addTaskMessage" onload="alert('cat');" >
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>A task has now been ADDED.</h4>
    </div>


    <div class="alert alert-danger fade in" name="deleteTaskMessage">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>A task has now been DELETED.</h4>
    </div>

    <div class="alert alert-danger fade in" name="deleteAllTaskMessage">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>All of the tasks have now been DELETED.</h4>
    </div>

    <div class="alert alert-info fade in" name="updateTaskMessage">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>That task has now been UPDATED.</h4>
    </div>
</div>



<!---->
<!--        <p class="alert-success" id="addTaskMessage" style="display: none">A task has now been ADDED.</p>-->
<!--        <p class="alert-danger" id="deleteTaskMessage">A task has now been DELETED.</p>-->
<!--        <p class="alert-danger" id="deleteAllTaskMessage">All of the tasks have now been DELETED.</p>-->
<!--        <p class="alert-info" id="updateTaskMessage">That task has now been UPDATED.</p>-->


