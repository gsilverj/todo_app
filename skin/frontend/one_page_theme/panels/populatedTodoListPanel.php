<!-- this will be the panel that holds the to-do list that is pulled from the database...-->
<div class="container">
    <?php

    //this grabs the information in the database and returns it as an mysqli object(array) to $results...
    $taskList = $this->returnTodoListArray();
    $taskNumber = 1;

    //if the number of rows in the result less than 1, show no tasks are in list otherwise list them
    if(mysqli_num_rows($taskList) < 1)
    {
        ?>
            <br />
            <h2>You Currently Have No Tasks In Your To Do List.</h2>
            <br />
        <?php
    }
    else
    {
        foreach($taskList as $task)
        {
            ?>

            <div class="h3 col-md-10" style="overflow-wrap: break-word">
                <?php

                    //if true, strike through the task description... (<del> is also a strike-through tag)
                    if($task['Task_Is_Completed'])
                    {
                        ?>
                            <del><?php echo $task['Task_Description']; ?></del>
                        <?
                    }
                    else
                    {
                       echo $task['Task_Description'];
                    }

                ?>
                <a href="<?php echo Core_XMLConfig::getBaseUrl() . 'task/update?id=' . $taskNumber?>" style="color:#FF0000;"> <span class="glyphicon glyphicon-ok"></span> </a>
                <a href="<?php echo Core_XMLConfig::getBaseUrl() . 'task/delete?id=' . $taskNumber?>" style="color:#FF0000;"> <span class="glyphicon glyphicon-trash"></span> </a>
            </div>

            <br />

            <?
            $taskNumber ++;
        }
    }

    ?>
</div>