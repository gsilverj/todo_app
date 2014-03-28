<!-- this will be the panel that holds the to-do list that is pulled from the database...-->

<div id=cat class="container">
    <?php

    //this grabs the information in the database and returns it as an mysqli object(array) to $results...
    $taskList = $this->returnTodoListArray();
    $taskNumber = 1;

    foreach($taskList as $task)
    {
        ?>

        <div class="h3">
            <?php

                //if true, strike through the task description... (<del> is the strike-through tag)
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
            <a href="<?php echo Core_XMLConfig::getBaseUrl() . 'task/update?id=' . $taskNumber?>"> <span class="glyphicon glyphicon-ok"></span> </a>
            <a href="<?php echo Core_XMLConfig::getBaseUrl() . 'task/delete?id=' . $taskNumber?>"> <span class="glyphicon glyphicon-trash"></span> </a>
        </div>

        <br />

        <?
        $taskNumber ++;
    }

    ?>
</div>
