





<div id="messagePanel" name="messagePanel">

    <div class="alert alert-success fade in" id="addTaskMessage" name="addTaskMessage" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>A task has now been ADDED.</h4>
    </div>

    <div class="alert alert-danger fade in" id="deleteTaskMessage" name="deleteTaskMessage" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>A task has now been DELETED.</h4>
    </div>

    <div class="alert alert-danger fade in" id="deleteAllTaskMessage" name="deleteAllTaskMessage" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>All of the tasks have now been DELETED.</h4>
    </div>

    <div class="alert alert-info fade in" id="updateTaskMessage" name="updateTaskMessage" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>That task has now been UPDATED.</h4>
    </div>
</div>




<script type="text/javascript">

    function showMessage(id)
    {
        document.getElementById(id).style.display = 'block';
    }

    function checkForLastTask()
    {
        return "<?php echo Task_Registry::get('last_task');?>";
    }

    function handleMessageVisibility()
    {
        var taskToShow = checkForLastTask();
        var messageToShow = null;

        if(taskToShow != null)
        {
            switch(taskToShow)
            {
                case 'add':
                {
                    messageToShow = 'addTaskMessage';
                    break;
                }
                case 'delete':
                {
                    messageToShow = 'deleteTaskMessage';
                    break;
                }
                case "deleteAll":
                {
                    messageToShow = 'deleteAllTaskMessage';
                    break;
                }
                case 'update':
                {
                    messageToShow = 'updateTaskMessage';
                    break;
                }
                default:
                {
                    messageToShow = null;
                    break;
                }
            }
        }

        if(messageToShow != null)
        {
            showMessage(messageToShow);
        }
    }


    handleMessageVisibility();
</script>