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
            <?php echo $task['Task_Description'];?>
            <a href="<?php echo Core_XMLConfig::getBaseUrl() . 'task/update?id=' . $taskNumber?>"> <span class="glyphicon glyphicon-ok"></span> </a>
            <a href="<?php echo Core_XMLConfig::getBaseUrl() . 'task/delete?id=' . $taskNumber?>"> <span class="glyphicon glyphicon-trash"></span> </a>
        </div>

        <br />


        <?
        $taskNumber ++;
    }


//  original version of the above search and populate list loop.
//        while($row = mysqli_fetch_array($results))
//        {
//            ?>
<!---->
<!--           <div class="h3">-->
<!--               --><?php //echo $row['Task_Description'];?>
<!--               <a href="--><?php //echo Core_XMLConfig::getBaseUrl() . 'task/update/' . $index?><!--"> <span class="glyphicon glyphicon-ok"></span> </a>-->
<!--               <a href="--><?php //echo Core_XMLConfig::getBaseUrl() . 'task/delete/' . $index?><!--"> <span class="glyphicon glyphicon-trash"></span> </a>-->
<!--           </div>-->
<!---->
<!--           <br />-->
<!---->
<!---->
<!--           --><?//
//
//        }

    ?>
</div>
<h5 class="help-block">*Click the Checkmark to mark that task as completed or finished.</h5>
<h5 class="help-block">*Click the Trashcan to delete that task permanently.</h5>