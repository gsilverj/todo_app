<!-- this will be the panel that holds the to-do list that is pulled from the database...-->

<div id=cat class="container">
    <?php

    //this grabs the information in the database and returns it as an mysqli object(array) to $results...
    $results = $this->returnTodoListArray();
    $index = 1;

        while($row = mysqli_fetch_array($results))
        {
            ?>

           <div class="h3">
               <?php echo $row['Task_Description'];?>
               <a href="<?php echo Core_XMLConfig::getBaseUrl() . 'task/update/' . $index?>"> <span class="glyphicon glyphicon-ok"></span> </a>
               <a href="<?php echo Core_XMLConfig::getBaseUrl() . 'task/delete/' . $index?>"> <span class="glyphicon glyphicon-trash"></span> </a>
           </div>

           <br />


           <?
           $index ++;
        }

    ?>
</div>
